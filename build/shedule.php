#!/usr/bin/php
<?php
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$kernel->handle(
    $request = Illuminate\Http\Request::createFromBase(SymfonyRequest::create('/cron'))
);

VisitCounter::notificate('Вася', 'vasily@mail.ru');
