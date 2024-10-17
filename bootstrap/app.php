<?php

use App\Http\Middleware\StoreMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ProfileComplete;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('admin',[AdminMiddleware::class]);
        $middleware->appendToGroup('store',[StoreMiddleware::class]);
        $middleware->appendToGroup('profile',[ProfileComplete::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
