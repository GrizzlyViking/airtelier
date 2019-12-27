<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Message;
use App\Models\Resource;
use App\Policies\ArticlePolicy;
use App\Policies\MessagePolicy;
use App\Policies\ResourcePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Resource::class => ResourcePolicy::class,
        Article::class  => ArticlePolicy::class,
        Message::class  => MessagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
