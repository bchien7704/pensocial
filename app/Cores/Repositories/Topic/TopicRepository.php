<?php namespace Penst\Cores\Repositories\Topic;

use Penst\Exceptions\ValidationException;
use Penst\Cores\Repositories\AbstractValidator as Validator;
use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Models\Topic\Topic;

/**
 * Class SettingRepository
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class TopicRepository extends RepositoryAbstract implements TopicRepositoryInterface
{


    /**
     * @var \Setting
     */
    protected $topic;

    protected static $rules = [
//        'name'   => 'required'

    ];
    /**
     * @param Setting $setting
     */
    public function __construct(Topic $topoc)
    {

        $this->topic = $topoc;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->topic->findOrFail($id);
    }

    /**
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->topic->fill($attributes)->save();

            return $this->topic;
        }

        throw new ValidationException('Topic validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        $this->message = $this->find($id);

        if ($this->isValid($attributes)) {

            $this->message->fill($attributes)->save();
            return $this->message;
        }

        throw new \Penst\Cores\Exceptions\ValidationException('Topic validation failed', $this->getErrors());
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
        return $this->topic;
    }

}
