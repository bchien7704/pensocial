<?php namespace Penst\Cores\Repositories\Logging;

use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Exceptions\ValidationException;
use Penst\Models\Logging\ActivityLog;
use Penst\Models\Logging\ActivityLogType;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/9/15
 * Time: 9:06 PM
 */
class ActivityLogRepository extends RepositoryAbstract implements ActivityLogRepositoryInterface
{

    /*
 * @var \Setting
 */
    private $activityLog;

    /*
     * @param Setting $setting
     */
    public function __construct(ActivityLog $activityLog)
    {

        $this->activityLog = $activityLog;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->activityLog->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->activityLog->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('ActivityLog validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        $this->activityLog = $this->find($id);

        if($this->isValid($attributes)) {

            $this->activityLog->resluggify();
            $this->activityLog->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('ActivityLog validation failed', $this->getErrors());
    }

    public function delete($id)
    {
        $this->activityLog = $this->activityLog->find($id);
        $this->activityLog->delete();
    }

    public function all()
    {
        return $this->activityLog->query()->get();
    }

    public function table()

    {
        return $this->activityLog;
    }

}