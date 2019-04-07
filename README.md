# laravel-monolog-swiftmailer-handler

A handler to bridge Laravel, Monolog and Swiftmailer.

To use it simply include it as a log channel:

```php
'email' => [
    'driver' => 'custom',
    'via' => \sammaye\MonologSwiftMailerHandler\Handler::class,
    'from' => [
        'address' => env('MAIL_LOG_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_LOG_FROM_NAME', 'Example'),
    ],
    'to' => env('MAIL_LOG_EMAIL_ADDRESS', 'hello@example.com'),
],
```

As simple as that.
