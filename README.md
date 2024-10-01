# Laravel Exception Monitor

**Laravel Exception Monitor** is a package for monitoring exceptions in your Laravel application and sending notifications to Slack. It provides a simple and efficient way to stay informed about errors occurring in your application, helping you to respond quickly and maintain high application reliability.

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [License](#license)

## Introduction

In modern web applications, monitoring exceptions is crucial for maintaining a seamless user experience. **Laravel Exception Monitor** allows you to capture exceptions and send alerts directly to your Slack channel. This package streamlines error handling, enabling developers to address issues proactively.

## Installation

To install the **Laravel Exception Monitor** package, follow these steps:

1. **Install the package via Composer**:

   ```bash
   composer require kettasoft/exception-monitor
   ```
2. Publish the configuration file:
After installation, you need to publish the configuration file using the following command:

   ```dash
   php artisan vendor:publish --provider="YourNamespace\ExceptionMonitor\ExceptionMonitorServiceProvider"
   ```

3. Configure the package:

Open the published configuration file located at config/exception-monitor.php and set your Slack webhook URL:

```dash
return [
    'slack_webhook_url' => env('SLACK_WEBHOOK_URL', 'https://hooks.slack.com/services/your/slack/webhook/url'),
];
```
Make sure to replace `'https://hooks.slack.com/services/your/slack/webhook/url'` with your actual Slack webhook URL. You can also set the environment variable `SLACK_WEBHOOK_URL` in your `.env` file.

## Usage
To use the Laravel Exception Monitor, you simply need to ensure that your application's exception handler is set up correctly. The package integrates seamlessly with Laravel's existing exception handling.

1. Modify your exception handler:

    In your app/Exceptions/Handler.php file, you can customize the report method to include the exception monitoring logic:

    ```php
    public function report(Throwable $exception)
    {
        parent::report($exception);
        
        // Notify Slack about the exception
        app(\Scaffolding\ExceptionMonitor\ExceptionMonitor::class)->report($exception);
    }
    ```

## License

This package is open-source and available under the MIT License.
