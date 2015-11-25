<?php
namespace App\Html\Form;

class Input
{
    public function checkbox($value, $options)
    {
        $options['type'] = 'checkbox';

        return $this->input($value, $options);
    }

    public function radio($value, $options)
    {
        $options['type'] = 'radio';

        return $this->input($value, $options);
    }

    public function file($value, $options)
    {
        $options['type'] = 'file';

        return $this->input($value, $options);
    }

    public function image($value, $options)
    {
        $options['type'] = 'image';

        return $this->input($value, $options);
    }

    public function number($value, $options)
    {
        $options['type'] = 'number';

        return $this->input($value, $options);
    }

    public function submit($value, $options)
    {
        $options['type'] = 'submit';

        $options['value'] = $value;

        return $this->input($value, $options);
    }

    public function reset($value, $options)
    {
        $options['type'] = 'reset';

        $options['value'] = $value;

        return $this->input($value, $options);
    }

    public function url($value, $options)
    {
        $options['type'] = 'url';

        return $this->input($value, $options);
    }

    public function email($value, $options)
    {
        $options['type'] = 'email';

        return $this->input($value, $options);
    }

    public function password($value, $options)
    {
        $options['type'] = 'password';

        return $this->input($value, $options);
    }

    public function hidden($value, $options)
    {
        $options['type'] = 'hidden';

        return $this->input($value, $options);
    }

    public function text($value, $options)
    {
        $options['type'] = 'text';

        return $this->input($value, $options);
    }

    protected function input($value, $options)
    {
        return '<input'.attr($options + ['value' => $value]).'/>';
    }

    public function textarea($value, $options)
    {
        return '<textarea'.attr($options).'>'.$value.'</textarea>';
    }

}