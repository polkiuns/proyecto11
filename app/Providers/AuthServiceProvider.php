<?php

namespace App\Providers;

use App\Course;
use App\Policies\CoursePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        
        'App\Course' => 'App\Policies\CoursePolicy',
        'App\Subject' => 'App\Policies\SubjectPolicy',
        'App\Lesson' => 'App\Policies\LessonPolicy',
        'App\Clase' => 'App\Policies\ClasePolicy',
        'App\Student' => 'App\Policies\StudentPolicy',
        'App\Teacher' => 'App\Policies\TeacherPolicy',
        'App\File' => 'App\Policies\FilePolicy',
        'App\Delivery' => 'App\Policies\DeliveryPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
