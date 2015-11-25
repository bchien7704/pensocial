<?php namespace Penst\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/14/15
 * Time: 9:01 AM
 */
use Auth;
use Penst\Services\Seo\UrlTrait;
use Penst\Services\User\UserServiceInterface;

class WallController extends Controller
{
    use UrlTrait;

    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public  function  wall($slug)
    {
        $userId=$this->getEntityIdBySeName($slug,'User');
        $user=$this->userService->getUserById($userId);
        return view('frontend.wall.show_wall',compact('user'));
    }
}