<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'course_id', 'completed_modules','course_status', 'completion_percentage'];

}
