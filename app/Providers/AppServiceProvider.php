<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootStrapFive();

        Validator::extend('unique_enrollment', function ($attribute, $value, $parameters, $validator) {
            // Retrieve the student ID based on the provided username
            $studentId = User::where('userName', $validator->getData()['studentName'])->value('id');

            // Retrieve the course ID based on the provided course name
            $courseId = Course::where('name', $value)->value('id');

            // Check if the student is already enrolled in the course
            return !CourseEnrollment::where('user_id', $studentId)->where('course_id', $courseId)->exists();
        });

    }
}
