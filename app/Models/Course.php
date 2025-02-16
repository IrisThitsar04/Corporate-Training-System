<?php

namespace App\Models;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['name', 'description', 'instructor_id', 'start_date', 'end_date', 'duration', 'course_profile'];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'course_enrollments', 'course_id', 'user_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
