<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'assignment_id', 'submission_file'];

    protected $dates=['submitted_at'];
}
