<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Taskmanagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'estimate_hours',
        'assign_id'
    ];

    public function taskProject() {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function user() {
        return $this->hasMany(User::class,'id');
    }  
}
