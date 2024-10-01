<?php

namespace Scaffolding\ExceptionMonitor\Tests\Unit;

use Throwable;
use Illuminate\Support\Facades\Http;
use Scaffolding\ExceptionMonitor\Tests\TestCase;
use Scaffolding\ExceptionMonitor\ExceptionMonitor;

class ExceptionMonitorTest extends TestCase
{
  /**
   * Test that the ExceptionMonitor handles an exception correctly.
   *
   * @return void
   */
  public function test_exception_monitor_handles_exception()
  {
    // Mock the Slack Webhook request
    Http::fake();

    // Simulate an exception
    try {
      throw new \RuntimeException("Test exception handling");
    } catch (Throwable $exception) {
      $handler = new ExceptionMonitor('https://hooks.slack.com/services/fake-url');
      $handler->report($exception);
    }

    // Assert that the Slack notification is sent
    Http::assertSent(function ($request) {
      return $request->url() === 'https://hooks.slack.com/services/fake-url';
    });
  }
}
