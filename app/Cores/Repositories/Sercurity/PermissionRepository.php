<?php namespace Penst\Cores\Repositories\Sercurity;


use Penst\Models\Sercurity\Permission;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;
use Penst\Cores\Repositories\CrudableInterface;
use Penst\Cores\Repositories\AbstractValidator as Validator;
use Penst\Cores\Repositories\RepositoryAbstract;

/**
 * Class SettingRepository
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class PermissionRepository extends RepositoryAbstract implements PermissionRepositoryInterface
{

    /*
     * @var \Setting
     */
    private $permission;

    /*
     * @param Setting $setting
     */
    public function __construct(Permission $permission)
    {

        $this->permission = $permission;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->permission->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->category->fill($attributes)->save();
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
        return $this->permission->query()->get();
    }

    public function table()

    {
        return $this->permission;
    }


}
