<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Dictionary;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\DictionaryPolicy;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => ProfilePolicy::class,
        Comment::class => CommentPolicy::class,
        Dictionary::class => DictionaryPolicy::class
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
