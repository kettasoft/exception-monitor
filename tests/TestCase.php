<?php

namespace Scaffolding\ExceptionReporter\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Scaffolding\ExceptionReporter\Providers\ExceptionMonitorServiceProvider;

class TestCase extends Orchestra
{
  /**
   * Load the service provider for the package.
   *
   * @param \Illuminate\Foundation\Application $app
   * @return array
   */
  protected function getPackageProviders($app)
  {
    return [
      ExceptionMonitorServiceProvider::class,
    ];
  }

  /**
   * Define environment setup.
   *
   * @param \Illuminate\Foundation\Application $app
   * @return void
   */
  protected function getEnvironmentSetUp($app)
  {
    // Set up environment configuration, such as the Slack webhook URL.
    $app['config']->set('exception-monitor.slack_webhook_url', 'https://hooks.slack.com/services/fake-url');
  }
}
