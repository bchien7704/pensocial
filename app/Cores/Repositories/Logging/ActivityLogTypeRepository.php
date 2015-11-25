<?php namespace Penst\Cores\Repositories\Logging;

use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Cores\Exceptions\ValidationException;
use Penst\Models\Logging\ActivityLogType;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/9/15
 * Time: 9:06 PM
 */
class ActivityLogTypeRepository extends RepositoryAbstract implements ActivityLogTypeRepositoryInterface
{
    protected static $rules = [
        'system_keyword' => 'required',
        'name' => 'required'

    ];
    /*
 * @var \Setting
 */
    private $activityLogType;

    /*
     * @param Setting $setting
     */
    public function __construct(ActivityLogType $activityLogType)
    {

        $this->activityLogType = $activityLogType;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->activityLogType->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->activityLogType->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('ActivityLogType validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        $attributes['enabled'] = isset($attributes['enabled']) ? true : false;
        $this->activityLogType = $this->find($id);

        if ($this->isValid($attributes)) {

            $this->activityLogType->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('ActivityLogType validation failed', $this->getErrors());
    }

    public function delete($id)
    {
        $this->activityLogType = $this->activityLogType->find($id);
        $this->activityLogType->delete();
    }

    public function all()
    {
        return $this->activityLogType->query()->get();
    }

    public function table()

    {
        return $this->activityLogType;
    }

}