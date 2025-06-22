<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
   protected $policies = [
    \App\Models\Post::class => \App\Policies\PostPolicy::class,
        \App\Models\Comment::class => \App\Policies\CommentPolicy::class,

];


    public function boot(): void
    {
        $this->registerPolicies();
    }
}
