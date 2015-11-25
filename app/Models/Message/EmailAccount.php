<?php namespace Penst\Models\Message;


use Penst\Models\BaseModel;

/**
 * Class Setting
 * @author Sefa Karagöz
 */
class EmailAccount extends BaseModel
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_account';

    protected $fillable = array('email', 'display_name','host','port', 'username','password','email_ssl','use_default_credentials');



}