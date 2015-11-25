<?php
namespace App\Html\Form;

use Lavender\Contracts\Entity;

class Html
{

    public function label($text, $options)
    {
        return '<label class="form-label"'.attr($options).'>'.$text.'</label>';
    }

    public function button($text, $options)
    {
        return '<button class="form-button"'.attr($options).'>'.$text.'</button>';
    }

    public function comment($text)
    {
        return '<span class="form-comment">'.$text.'</span>';
    }

    public function error($text)
    {
        return '<span class="form-error">'.$text.'</span>';
    }

}