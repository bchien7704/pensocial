<?php namespace Penst\Http\Controllers\Admin;
use Penst\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Redirect;
use View;
use Input;
use Notification;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/9/15
 * Time: 7:25 PM
 */
class LogViewerController extends Controller
{
    public function index()
    {
        if (Input::get('l')) {
            LaravelLogViewer::setFile(base64_decode(Input::get('l')));
        }

        if (Input::get('dl')) {
            return Response::download(storage_path() . '/logs/' . base64_decode(Input::get('dl')));
        } elseif (Input::has('del')) {
            File::delete(storage_path() . '/logs/' . base64_decode(Input::get('del')));
            return Redirect::to(Request::url());
        }

        $logs = LaravelLogViewer::all();

        return View::make("backend.logging.log", [
            'logs' => $logs,
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName()
        ]);
    }
}