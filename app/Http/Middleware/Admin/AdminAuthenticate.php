<?php

namespace Penst\Http\Middleware\Admin;

use Closure;
use Redirect;
use Illuminate\Contracts\Auth\Guard;
use Penst\Services\Sercurity\PermissionServiceInterface;
use Penst\Services\Sercurity\StandardPermissionProvider;
use Penst\Services\User\UserServiceInterface;

class AdminAuthenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $permissionService;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth,PermissionServiceInterface $permissionService)
    {
        $this->auth = $auth;
        $this->permissionService=$permissionService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!$this->auth->check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }
            else {
                return redirect()->guest('admin/login');
            }
        }
        else
        {
            $standardProviderPermission = new StandardPermissionProvider();
            if (!$this->permissionService->authorize($standardProviderPermission->accessAdminPanel)) {
                return redirect()->guest('admin/login');
            }

        }

        return $next($request);
    }
}
