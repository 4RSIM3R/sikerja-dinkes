<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'assignment_id' => $this->assignment_id,
            'execution_task' => $this->execution_task,
            'rencana_hasil_kerja' => $this->execution_task,
            'report_period_start' => $this->report_period_start,
            'report_period_end' => $this->report_period_end
        ];
    }
}
