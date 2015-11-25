<?php namespace Penst\Cores\Repositories\Us;
use Penst\Cores\Repositories\CrudableInterface;
use Penst\Cores\Repositories\AbstractValidator as Validator;
use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Models\Seo\UrlRecord;

/**
 * Class SettingRepository
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class UrlRecordRepository extends RepositoryAbstract implements UrlRecordRepositoryInterface
{

    /*
     * @var \Setting
     */
    private $urlRecord;

    /*
     * @param Setting $setting
     */
    public function __construct(UrlRecord $urlRecord)
    {

        $this->urlRecord = $urlRecord;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->urlRecord->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->urlRecord->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('Setting validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function table()

    {
        return $this->urlRecord;
    }


}
