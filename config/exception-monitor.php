<?php

return [
  /**
   * The Slack Webhook URL where notifications will be sent.
   * This URL is generated from Slack's Incoming Webhooks integration.
   *
   * Example:
   * 'https://hooks.slack.com/services/XXXX/YYYY/ZZZZ'
   */
  'slack_webhook_url' => env('SLACK_WEBHOOK_URL'),
  'slack_webhook_enable' => false,
];
