<?php namespace Penst\Cores\Repositories\Setting;

use Penst\Exceptions\ValidationException;
use Penst\Cores\Repositories\AbstractValidator as Validator;
use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Models\Setting\Setting;

/**
 * Class SettingRepository
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class SettingRepository extends RepositoryAbstract implements SettingRepositoryInterface
{

    /**
     * @var \Setting
     */
    protected $setting;

    protected static $rules = [
        'name'   => 'required'

    ];
    /**
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {

        $this->setting = $setting;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->setting->findOrFail($id);
    }

    /**
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->setting->fill($attributes)->save();
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
        return $this->setting;
    }

}
