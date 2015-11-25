<?php

namespace Penst\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $title = '';

    protected function redirectTo($url, $statusCode = 302)
    {
        return Redirect::to($url, $statusCode);
    }

    protected function redirectAction($action, $data = [])
    {
        return Redirect::action($action, $data);
    }

    protected function redirectRoute($route, $data = [])
    {
        return Redirect::route($route, $data);
    }

    protected function redirectBack($data = [], $input = [])
    {
        return Redirect::back()->withInput($input)->with($data);
    }

    protected function redirectIntended($default = null)
    {
        if ($intended = Session::get('auth.intended_redirect_url')) {
            return $this->redirectTo($intended);
        }

        return Redirect::to($default);
    }
}
