<?php namespace Penst\Cores\Seo;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 5:06 PM
 */
interface SlugableInterface
{
    public function saveSlug(Model $entity,$slug);
}