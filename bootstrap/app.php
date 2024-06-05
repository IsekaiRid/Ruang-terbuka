<?php

use App\Http\Middleware\CekAuthlogin;
use App\Http\Middleware\CekRoleUsert;
use App\Http\Middleware\CekUserSosial;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'loginaAuth' => CekAuthlogin::class,
            'checkRole' => CekRoleUsert::class,
            'checkSosial' => CekUserSosial::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
