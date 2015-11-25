<?php

namespace Penst\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Penst\Http\Middleware\EmailConfirmed;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Penst\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Penst\Http\Middleware\VerifyCsrfToken::class,
        \Krucas\Notification\Middleware\NotificationMiddleware::class,
        \Penst\Http\Middleware\SlugMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'before' => \Penst\Http\Middleware\BeforeMiddleware::class,
        'auth.admin' => \Penst\Http\Middleware\Admin\AdminAuthenticate::class,
        'Admin.guest' =>  \Penst\Http\Middleware\Admin\RedirectAdminIfAuthenticated::class,
        'auth' => \Penst\Http\Middleware\Authenticate::class,
        'guest' =>  \Penst\Http\Middleware\RedirectIfAuthenticated::class,
        'confirmed' => EmailConfirmed::class,



    ];
}
