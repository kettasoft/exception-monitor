<?php

namespace Scaffolding\ExceptionReporter;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SlackErrorReporter
{
  protected string $webhook;
  protected Throwable $exception;

  /**
   * SlackErrorReporter __construct
   */
  public function __construct(Throwable $exception, string $webhook)
  {
    $this->webhook = $webhook;
    $this->exception = $exception;
  }

  /**
   * Sends a formatted Slack notification with exception details.
   * @return void
   */
  public function send(): void
  {
    if (! is_null($this->webhook)) {
      try {
        Http::post($this->webhook, $this->segnature($this->exception));
      } catch (\Exception $e) {
        Log::error('Failed to send Slack notification: ' . $e->getMessage());
      }
    }
  }

  /**
   * Return the exception segnature.
   * @param Throwable $exception
   * @return array
   */
  protected function segnature(Throwable $exception): array
  {
    return [
      'text' => sprintf(
        "Exception occurred in %s:\n%s\n\nFile: %s\nLine: %d",
        $exception->getFile(),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine()
      ),
    ];
  }
}
