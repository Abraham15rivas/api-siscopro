<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes
};


class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'general_objective',
        'scope',
        'justification',
        'observations',
        'requested_amount',
        'execution_time',
        'actors',
        'productive_engine',
        'product_project',
        'project_taxes',
        'direct_benefits',
        'investment_line',
        'user_id',
        'institution_id',
        'type_project_id',
        'status_project_id'
    ];
}