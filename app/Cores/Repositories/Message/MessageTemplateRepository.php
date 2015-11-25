<?php namespace Penst\Cores\Repositories\Message;

use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Exceptions\ValidationException;
use Penst\Models\Message\Message;
class MessageTemplateRepository extends RepositoryAbstract implements MessageTemplateRepositoryInterface
{

    /*
 * @var \Setting
 */
    private $messageTemplate;

    protected static $rules = [
        'name' => 'required',
        'body' => 'required'

    ];
    /*
     * @param Setting $setting
     */
    public function __construct(Message $message)
    {

        $this->messageTemplate = $message;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->messageTemplate->findOrFail($id);
    }

    /*
     * @param $attributes
     * @return bool|mixed
     * @throws \Penst\Cores\Exceptions\ValidationException
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->messageTemplate->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('Message template validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        $this->messageTemplate = $this->find($id);

        if ($this->isValid($attributes)) {

            $this->messageTemplate->fill($attributes)->save();
            return true;
        }

        throw new \Penst\Cores\Exceptions\ValidationException('Message template validation failed', $this->getErrors());
    }

    public function delete($id)
    {
        $this->messageTemplate = $this->messageTemplate->find($id);
        $this->messageTemplate->delete();
    }

    public function all()
    {
        return $this->messageTemplate->query()->get();
    }

    public function table()

    {
        return $this->messageTemplate;
    }

}