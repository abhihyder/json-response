<?php

namespace Hyder\JsonResponse;

use Hyder\JsonResponse\Services\JsonResponseService;
use Illuminate\Support\ServiceProvider;

class JsonResponseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('json-response-service', function(){
            return new JsonResponseService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}