<?php namespace Penst\Services\Seo;

use Illuminate\Database\Eloquent\Model;
use Penst\Models\Seo\UrlRecord;
Use App;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/7/15
 * Time: 9:01 AM
 */
trait UrlTrait
{
    public function  saveSlug(Model $entity, $slug)
    {

        $entityName = class_basename($entity);
        if (strlen($entityName) == 0)
            throw new \Exception("");
        $model = new UrlRecord();
        $query = $model->query();
        $query = $query->where("entity_id", $entity->id)->where('entity_name', $entityName)->orderBy('id', 'desc');
        $urlRecords = $query->get();
        $activeUrlRecord = $urlRecords->where('active', '1')->first();
        if ($activeUrlRecord == null && strlen($slug) > 0) {
            $nonActiveRecordWithSpecifiedSlug = $urlRecords->where('slug', 'slug')->where('is_active', '0')->first();
            if ($nonActiveRecordWithSpecifiedSlug != null) {
                $nonActiveRecordWithSpecifiedSlug->active = 1;
                $nonActiveRecordWithSpecifiedSlug->save();
            } else {
                $model->entity_name = $entityName;
                $model->entity_id = $entity->id;
                $model->slug = $slug;
                $model->is_active = 1;
                $model->save();
            }
        }
        if ($activeUrlRecord != null && strlen($slug) == 0) {
            $activeUrlRecord->is_active = 0;
            $activeUrlRecord->save();
        }
        if ($activeUrlRecord != null && strlen($slug) > 0) {
            if ($activeUrlRecord->slug = $slug) {
                //yes. do nothing
                //P.S. wrote this way for more source code readability
            } else {
                $nonActiveRecordWithSpecifiedSlug = $urlRecords->where('slug', $slug)->where('is_active', '0')->first();
                if ($nonActiveRecordWithSpecifiedSlug != null) {
                    $nonActiveRecordWithSpecifiedSlug->is_active = 1;
                    $nonActiveRecordWithSpecifiedSlug->save();
                    $activeUrlRecord->is_active = 0;
                    $activeUrlRecord - save();
                } else {
                    $model->entity_name = $entityName;
                    $model->entity_id = $entity->id;
                    $model->slug = $slug;
                    $model->is_active = 1;
                    $model->save();
                    $activeUrlRecord->is_active = 0;
                    $activeUrlRecord - save();
                }
            }
        }

    }

    public function validateSeName(Model $entity, $seName, $name, $ensureNotEmpty)
    {
        if ($entity == null)
            return false;
        if (strlen($seName) == 0 && strlen($name) > 0) {
            $seName = $name;
        }
        $seName = $this->getSeName($seName);
        if (strlen($seName)==0) {
            if ($ensureNotEmpty)
                $seName = $entity->id;
            else
                return $seName;
        }
        $entityName = class_basename($entity);
        $i = 2;
        $tempSeName = $seName;
        $urlRecordService = App::make('Penst\Services\Seo\UrlRecordServiceInterface');
        while (true) {
            $urlRecord = $urlRecordService->getBySlug($tempSeName);
            $reserved1 = $urlRecord != null && !($urlRecord->entity_id == $entity->id && $urlRecord->entity_name == $entityName);
            if (!$reserved1)
                break;
            $tempSeName=$seName.'-'.$i;
            $i++;
        }
        $seName=$tempSeName;
        return $seName;

    }

    public function  getSeName($name)
    {
        if (strlen($name) == 0)
            return $name;
        $name = strtolower($name);
        $okChars = "abcdefghijklmnopqrstuvwxyz1234567890 _-";
        $sb = "";
        foreach (str_split($name) as $c) {
            $c2 = $c;
            $sb .= $c2;
        }
        $name2 = $sb;
        $name2 = str_replace(' ', '-', $name2);
        if (strpos($name2, '--') > 0)
            $name2 = str_replace('--', '-', $name2);
        if (strpos($name2, '__') > 0)
            $name2 = str_replace('__', '_', $name2);
        return $name2;
    }

    public  function getEntityIdBySeName($slug,$entityName)
    {
        if(strlen($slug)==0)
            return null;
        $model = new UrlRecord();
        $urlRecord=$model->query()->where('is_active','1')->where('slug',strtolower($slug))->where('entity_name',$entityName)->first();
        if($urlRecord==null)
            return null;
        return $urlRecord->entity_id;
    }
}