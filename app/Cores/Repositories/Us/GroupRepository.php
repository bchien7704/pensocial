<?php namespace Penst\Cores\Repositories\Us;


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
class GroupRepository extends RepositoryAbstract implements GroupRepositoryInterface
{

    /*
     * @var \Setting
     */
    private $group;

    /*
     * @param Setting $setting
     */
    public function __construct(Group $group)
    {

        $this->group = $group;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->user->findOrFail($id);
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
        // TODO: Implement all() method.
    }

    public function table()

    {
        return $this->group;
    }


}
