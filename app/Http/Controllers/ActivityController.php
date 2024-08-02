<?php

namespace App\Http\Controllers;

use App\Contract\ActivityContract;
use App\Http\Requests\Web\ActivityWebRequest;
use App\Models\WebSetting;
use App\Utils\DateUtils;
use App\Utils\WordUtils;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            relations: ['assignment'],
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

        try {
            WordUtils::process($template, $output_name, $data);
        } catch (Exception $e) {
            redirect()->back()->withErrors($e->getMessage());
        }
    }
}
