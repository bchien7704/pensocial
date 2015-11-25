<?php namespace Penst\Cores\Repositories\Message;

use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Exceptions\ValidationException;
use Penst\Models\Message\Message;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/9/15
 * Time: 9:06 PM
 */
class MessageRepository extends RepositoryAbstract implements MessageRepositoryInterface
{

    /*
 * @var \Setting
 */
    private $message;

    protected static $rules = [
        'content' => 'required',
        'subject' => 'required'

    ];
    /*
     * @param Setting $setting
     */
    public function __construct(Message $message)
    {

        $this->message = $message;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->message->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->message->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('ActivityLogType validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        $this->message = $this->find($id);

        if ($this->isValid($attributes)) {

            $this->message->fill($attributes)->save();
            return true;
        }

        throw new \Penst\Cores\Exceptions\ValidationException('Message validation failed', $this->getErrors());
    }

    public function delete($id)
    {
        $this->message = $this->message->find($id);
        $this->message->delete();
    }

    public function all()
    {
        return $this->message->query()->get();
    }

    public function table()

    {
        return $this->message;
    }

}