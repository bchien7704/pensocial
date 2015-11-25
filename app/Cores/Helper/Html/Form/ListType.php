<?php
namespace App\Html\Form;

class ListType
{
    public function multiple($selected, $options, $resource)
    {
        return $this->handle($selected, $options, $resource, 'checkbox');
    }

    public function single($selected, $options, $resource)
    {
        return $this->handle($selected, $options, $resource, 'radio');
    }

    public function handle($selected, $options, $resource, $type)
    {
        unset($options['name']);

        return view('layouts.partials.list', [
            'options'   => $options,
            'values'    => $this->buildList($selected, $resource),
            'type' => $type,
        ]);
    }

    protected function buildList($selected, $resource)
    {
        $list = [];

        foreach($resource as $res){

            $list[] = $this->values($selected, $res);

        }

        return $list;
    }

    protected function values($selected, $resource)
    {
        if(!$resource) return [];

        return $this->content($selected, $resource);
    }

    protected function content($selected, $resource)
    {
        return [
            'label'   => $resource['label'],
            'name'    => $resource['name'],
            'value'   => $resource['value'],
            'checked' => in_array($resource['value'], (array)$selected),
        ];
    }

}