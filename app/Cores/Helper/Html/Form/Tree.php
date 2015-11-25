<?php
namespace App\Html\Form;


class Tree
{
    public function tree($selected, $options, $resource)
    {
        unset($options['name']);

        return view('layouts.partials.tree', [
            'options'   => $options,
            'list'      => $this->buildList($selected, $resource)
        ]);
    }

    protected function buildList($selected, $resource)
    {
        $list = [];

        if(!isset($resource['children'])){

            foreach($resource as $res){

                $list[] = $this->values($selected, $res);

            }

        } else {

            $list[] = $this->values($selected, $resource);
        }

        return $list;
    }

    protected function values($selected, $resource)
    {
        if($resource){

            return [
                'content'  => $this->content($selected, $resource),
                'children' => $this->children($selected, $resource['children']),
            ];

        }

        return [];
    }

    protected function content($selected, $resource)
    {
        return view('layouts.partials.tree.item', [
            'label'   => $resource['label'],
            'name'    => $resource['name'],
            'value'   => $resource['value'],
            'checked' => in_array($resource['value'], (array)$selected),
        ])->render();
    }

    protected function children($selected, $children)
    {
        $results = [];

        foreach($children as $child){

            $results[] = $this->values($selected, $child);

        }

        return $results;
    }

}