<?php namespace Penst\Http\Controllers;
use Penst\Services\User\UserServiceInterface;
use DB;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/14/15
 * Time: 9:01 AM
 */
class CommonController extends Controller
{


    public  function  getGetUserFly()
    {
        return view('frontend.user.fly_out_user');
    }
    public function searchAllAutoComplete()
    {
        $q = strtolower($_GET["term"]);
        if (!$q) return;
        $users = DB::select('CALL search_all_item(?)',array($q));

        foreach($users as $item)
        {
            $link = 'professor/' . $item->item_id . '-' . parse_link($item->title);

            //$items[str_replace("'", "", (my_substr($row['title'], 50))) . ' [' . $row['mtype'] . ']'] = SITE_URL . $link;
            $items[$item->title] ='localhost:8000/' . $link;
        }
        $result = array();
        foreach ($items as $key=>$value) {
            if (strpos(strtolower($key), $q) !== false) {
                array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
            }
            if (count($result) > 11)
                break;
        }
        return array_to_json($result);

    }
}