<?php

namespace Scaffolding\ExceptionReporter\Tests\Feature;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Exceptions\Handler;
use Scaffolding\ExceptionReporter\Tests\TestCase;

class SlackNotificationTest extends TestCase
{
  /**
   * Test that an exception triggers a Slack notification.
   *
   * @return void
   */
  public function test_exception_triggers_slack_notification()
  {
    // Mock the Slack Webhook request
    Http::fake();

    // Simulate throwing an exception
    try {
      throw new Exception("Test exception message");
    } catch (Throwable $e) {
      $handler = app(Handler::class);
      $handler->report($e);
    }

    // Assert that an HTTP POST request was made to the Slack webhook URL
    Http::assertSent(function ($request): bool {
      // Make sure the URL is correct
      return $request->url() === 'https://hooks.slack.com/services/fake-url';
    });
  }
}
