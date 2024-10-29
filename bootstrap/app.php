<?php

use App\Http\Middleware\StoreMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\WelcomeMiddleware;
use App\Http\Middleware\GuestOrderMiddleware;
use App\Http\Middleware\ProfileCompleteMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('admin',[AdminMiddleware::class]);
        $middleware->appendToGroup('store',[StoreMiddleware::class]);
        $middleware->appendToGroup('welcome',[WelcomeMiddleware::class]);
        $middleware->appendToGroup('guest-order', [GuestOrderMiddleware::class]);
        $middleware->appendToGroup('profile', [ProfileCompleteMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
