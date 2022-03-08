<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class AssignProject extends Model
{
    use HasFactory;

    protected $table = 'assign_project';
    
    protected $fillable = [
        'user_id',
        'project_id'
    ];

    public function taskProject() {
        return $this->belongsTo(Project::class,'project_id');
    } 
    
}
