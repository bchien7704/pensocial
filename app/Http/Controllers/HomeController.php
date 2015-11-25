<?php namespace Penst\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/14/15
 * Time: 9:01 AM
 */
use Auth;
use Redirect;
class HomeController extends Controller
{
 public  function  index()
 {
     if(Auth::check())
     {
         return Redirect::route('account.wall',array(Auth::user()->getSeName()));
     }
       return view('frontend.home.index_login');
 }
}