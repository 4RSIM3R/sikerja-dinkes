<?php

namespace App\Http\Controllers;

use App\Contract\ActivityContract;
use App\Http\Requests\Web\ActivityWebRequest;
use App\Models\Attendance;
use App\Models\WebSetting;
use App\Utils\DateUtils;
use App\Utils\StringUtils;
use App\Utils\WordUtils;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    protected ActivityContract $service;

    public function __construct(ActivityContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('activity.index');
    }

    public function grid(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);
        $search = $request->get("search");
        $where = $search ? [["title", "like", "%" . $search . "%"]] : [];

        $data = $this->service->all(
            page: $page,
            dataPerPage: $perPage,
            paginate: true,
            relations: [],
            relationCount: ['attendances'],
            whereConditions: $where,
        );
        return response()->json($data);
    }

    public function form()
    {
        return view('activity.form');
    }

    public function store(ActivityWebRequest $request)
    {
        $payload = $request->validated();

        $result = $this->service->create($payload);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('activity.index');
        }
    }

    public function report($id)
    {
        $template = base_path('report.docx');
        $output_name = 'output_' . time() . '.docx';
        $data = $this->service->findById($id);
        $setting = WebSetting::query()->first();

        $thumbnails = [];

        $data = [
            '${report_period}' => sprintf(
                "%s \n %s - %s",
                DateUtils::week_count($data->report_period_start),
                DateUtils::date_format($data->report_period_start),
                DateUtils::date_format($data->report_period_end)
            ),
            '${execution_task}' => $data->execution_task,
            '${result_plan}' => $data->result_plan,
            '${action_plan}' => $data->action_plan,
            '${output}' => $data->output,
            '${budget}' => $data->budget,
            '${budget_source}' => $data->budget_source,
            '${chief_name}' => $setting->chief_name,
            '${chief_nip}' => $setting->chief_nip,
        ];

        $attendances = Attendance::query()->where('activity_id', $id)
            ->where('status', 'present')
            ->where('show_in_report', true)
            ->take(2)
            ->get();


        foreach ($attendances as $attendance) {
            // dd($attendance->getMedia('image')[0]->getPath());
            foreach ($attendance->getMedia('image') as $media) {
                $thumbnails[] = $media->getPath();
            }
        }

        if (count($thumbnails) == 0) return redirect()->back()->withErrors(["error" => "Belum ada yang melakukan absensi perserta."]);

        if (count($thumbnails) < 2) {
            $data['Gambar1'] = [
                'type' => 'image',
                'path' => StringUtils::normalize_path($thumbnails[0]),
                'width' => 150,
                'height' => 150,
            ];

            $data['${Gambar2}'] = "";
        } else {
            foreach ($thumbnails as $key => $value) {
                $data[sprintf('Gambar%s', $key + 1)] =  [
                    'type' => 'image',
                    'path' => StringUtils::normalize_path($value),
                ];
            }
        }

        try {
            WordUtils::process($template, $output_name, $data);
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function detail($id)
    {
        $data = $this->service->findById($id, relations: ['attendances', 'assignment']);
        return view('activity.detail', compact('data'));
    }
}
