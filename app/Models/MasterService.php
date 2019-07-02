<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterService extends Model
{
    protected $fillable = [
        'master_id', 'classification_id', 'service_type_ids', 'core_area', 'key_areas', 'other_areas', 'work_days',
        'team_nums', 'truck_nums', 'truck_type', 'truck_tonnage', 'self_rate'
    ];

    protected $casts = [
        'service_type_ids' => 'array',
        'key_areas' => 'array',
        'other_areas' => 'array',
        'work_days' => 'array',
    ];
}
