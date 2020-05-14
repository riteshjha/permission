<?php

namespace Rkj\Permission;

use Illuminate\Support\ServiceProvider;
use Rkj\Permission\Commands\SyncAbility;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCommands();

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom($this->getViewPath(), 'permission');

        $this->publishConfig();

        $this->publishMigrations();

        $this->publishViews();
    }

    /**
     * Publish package config
     *
     * @return void
     */
    protected function publishConfig()
    {
        $path = $this->getConfigPath();

        $this->publishes([$path => config_path('permission.php')], 'config');
    }

    /**
     * Publish package migrations
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $path = $this->getMigrationsPath();

        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    /**
     * Publish package migrations
     *
     * @return void
     */
    protected function publishViews()
    {
        $path = $this->getViewPath();
        
        $this->publishes([$path => resource_path('views/vendor/permission')], 'views');
    }

    /**
     * Get package config path
     *
     * @return void
     */
    protected function getConfigPath()
    {
        return __DIR__ . '/config/permission.php';
    }

    /**
     * Get package migrations path
     *
     * @return void
     */
    protected function getMigrationsPath()
    {
        return __DIR__ . '/database/migrations/';
    }

    /**
     * Get package view path
     *
     * @return void
     */
    protected function getViewPath()
    {
        return __DIR__.'/views/permission';
    }

    /**
     * Register package commands
     *
     * @return void
     */
    protected function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncAbility::class,
            ]);
        }    
    }
}