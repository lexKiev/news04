<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->registerPolicies();
	
	    Gate::resource('post', 'App\Policies\ArticlePolicy');
	    Gate::define('post.tag', 'App\Policies\ArticlePolicy@tag');
	    Gate::define('post.category', 'App\Policies\ArticlePolicy@category');
	    Gate::define('post.category', 'App\Policies\ArticlePolicy@category');
	    Gate::define('admin.view', 'App\Policies\AdminPolicy@view');
	    Gate::define('post.commentaries', 'App\Policies\ArticlePolicy@commentaries');
	    
    }
}
