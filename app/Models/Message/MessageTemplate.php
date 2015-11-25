<?php namespace Penst\Models\Message;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class MessageTemplate extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_template';
    protected $fillable = array('id', 'name','bcc_email_address','subject','body','is_active','email_account_id');





}