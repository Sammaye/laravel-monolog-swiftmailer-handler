<?php

namespace sammaye\MonologSwiftMailerHandler;

use Illuminate\Log\ParsesLogConfiguration;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Logger;

class Handler
{
    protected $app;

    use ParsesLogConfiguration;

    protected function getFallbackChannelName()
    {
        return $this->app->bound('env') ? $this->app->environment() : 'production';
    }

    public function __invoke(array $config)
    {
        $this->app = app();

        $mailer = app('mailer')->getSwiftMailer();
        $message = $mailer->createMessage()
            ->setSubject('Error')
            ->setFrom(
                $config['from']['address'],
                $config['from']['name']
            )
            ->setTo($config['to'])
            ->setContentType('text/html');

        $logger = new Logger(
            'email',
            [
                (new SwiftMailerHandler(
                    $mailer,
                    $message,
                    $this->level($config),
                    $config['bubble'] ?? true
                ))->setFormatter(new HtmlFormatter())
            ]
        );

        return $logger;
    }
}
