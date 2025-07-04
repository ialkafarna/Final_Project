<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Models\Category;
use App\Policies\CategoryPolicy;


class AuthServiceProvider extends ServiceProvider
{
   protected $policies = [
    \App\Models\Post::class => \App\Policies\PostPolicy::class,
        \App\Models\Comment::class => \App\Policies\CommentPolicy::class,
            \App\Models\Post::class => \App\Policies\PostPolicy::class,
                \App\Models\Category::class => \App\Policies\CategoryPolicy::class,



];



    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('manage-users', function ($user) {
    return $user->role === 'admin';
});

    }
}
