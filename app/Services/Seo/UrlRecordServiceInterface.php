<?php namespace Penst\Services\Seo;

use Illuminate\Database\Eloquent\Model;
use Penst\Models\Seo\UrlRecord;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 5:18 PM
 */
interface UrlRecordServiceInterface
{
    public function  deleteUrlRecord($id);

    public function  createUrlRecord($attributes);

    public function  updateUrlRecord($id, $attributes);

    public function   getUrlRecordById($id);

    public function   getBySlug($slug);

    public function  getAllUrlRecord($slug = null, $pageIndex = 0, $pageSize = 10000);

    public function  getActiveSlug($entityId, $entityName);

    public function  saveSlug(Model $entity, $slug);


}