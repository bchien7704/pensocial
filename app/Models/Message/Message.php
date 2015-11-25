<?php namespace Penst\Models\Message;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class Message extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';
    protected $fillable = array('from_id', 'to_id','subject','content','read','reply_to','from_deleted','to_deleted','read_reply');





}