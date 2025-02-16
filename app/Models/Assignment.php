<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable=['title','notes', 'course_id','due','max_score','pass_score','assignment_file'];

     public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
