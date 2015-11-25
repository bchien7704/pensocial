<?php namespace Penst\Services\Seo;

use Illuminate\Database\Eloquent\Model;
use Penst\Cores\Cache\CacheInterface;
use Penst\Cores\Repositories\Us\UrlRecordRepositoryInterface;
use Penst\Cores\Seo\SlugableInterface;
use Penst\Models\Seo\UrlRecord;


/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/6/15
 * Time: 5:19 PM
 */
class UrlRecordService implements UrlRecordServiceInterface
{
    private $cache;
    private $urlRecordRepository;


    public function __construct(UrlRecordRepositoryInterface $urlRecordRepositoryInterface, CacheInterface $cache)
    {
        $this->urlRecordRepository = $urlRecordRepositoryInterface;
        $this->cache = $cache;


    }

    public function  deleteUrlRecord($id)
    {
        // TODO: Implement deleteUrlRecord() method.
    }

    public function  createUrlRecord($attributes)
    {
        // TODO: Implement createUrlRecord() method.
    }

    public function  updateUrlRecord($id, $attributes)
    {
        // TODO: Implement updateUrlRecord() method.
    }

    public function   getUrlRecordById($id)
    {
        // TODO: Implement getUrlRecordById() method.
    }

    public function   getBySlug($slug)
    {
        if (strlen($slug) == 0)
            return null;

        $urlRecord = $this->urlRecordRepository->table()->query()->where('slug', $slug)->first();
        return $urlRecord;
    }

    public function  getAllUrlRecord($slug = null, $pageIndex = 0, $pageSize = 10000)
    {
        // TODO: Implement getAllUrlRecord() method.
    }

    public function  getActiveSlug($entityId, $entityName)
    {
        $query=$this->urlRecordRepository->table()->query()->where('entity_id',$entityId)
            ->where('entity_name',$entityName)
            ->where('is_active','1')
            ->orderBy('id', 'desc')
            ->select('slug');
        $slug=$query->first();
        return $slug;

    }

    public function  saveSlug(Model $entity, $slug)
    {
//        // TODO: Implement saveSlug() method.
//        $entityName = class_basename($entity);
//        if (strlen($entityName) == 0)
//            throw new \Exception("");
//        $model = new UrlRecord();
//        $query = $model->query();
//        $query = $query->where("entity_id", $entity->id)->where('entity_name', $entityName)->orderBy('id', 'desc');
//        $urlRecords = $query->get();
//        $activeUrlRecord = $urlRecords->where('active', '1')->first();
//        if ($activeUrlRecord == null && strlen($slug) > 0) {
//            $nonActiveRecordWithSpecifiedSlug = $urlRecords->where('slug', 'slug') . where('active', '0')->first();
//            if ($nonActiveRecordWithSpecifiedSlug != null) {
//
//
//            }
//            else{
//
//            }
//        }


    }
}