<?php

namespace Scaffolding\ExceptionReporter\Providers;

use Illuminate\Support\ServiceProvider;
use Scaffolding\ExceptionReporter\ExceptionMonitor;

class ExceptionMonitorServiceProvider extends ServiceProvider
{
  /**
   * Registers the exception monitor service.
   * This method merges the configuration file and ensures that
   * the service is correctly registered with Laravel's service container.
   * @return void
   */
  public function register(): void
  {
    // Merge the package configuration
    $this->mergeConfigFrom(__DIR__ . '/../../config/exception-monitor.php', 'exception-monitor');
  }

  /**
   * Bootstraps any package services.
   * This method is responsible for publishing the configuration file
   * and overriding the default exception handler in the application.
   * @return void
   */
  public function boot(): void
  {
    // Publish the config file if needed
    $this->publishes([
      __DIR__ . '/../../config/exception-monitor.php' => config_path('exception-monitor.php'),
    ]);

    // Override the default exception handler with the custom ExceptionMonitor
    $this->app->singleton('Illuminate\Contracts\Debug\ExceptionHandler', function ($app): ExceptionMonitor {
      return new ExceptionMonitor(config('exception-monitor.slack_webhook_url'));
    });
  }
}
