<?php

namespace Scaffolding\ExceptionReporter;

use Throwable;
use Scaffolding\ExceptionReporter\SlackErrorReporter;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class ExceptionMonitor extends ExceptionHandler
{
  /**
   * The Slack Webhook URL to send the notification to.
   *
   * @var string
   */
  protected string $slackWebhookUrl;

  /**
   * Create a new exception handler instance.
   * @param mixed $log
   * @param string $slackWebhookUrl
   * @return void
   */
  public function __construct(string $slackWebhookUrl)
  {
    $this->slackWebhookUrl = $slackWebhookUrl;
    parent::__construct(app());
  }

  /**
   * Report or log an exception.
   * @param  \Throwable  $e
   * @return void
   * @throws \Throwable
   */
  public function report(Throwable $exception): void
  {
    parent::report($exception);

    if ($this->shouldReport($exception)) {
      // Send notification to Slack
      $report = new SlackErrorReporter($exception, $this->slackWebhookUrl);

      $report->send();
    }
  }
}
