<?php namespace Penst\Cores\Repositories\Message;
use Penst\Cores\Exceptions\ValidationException;
use Penst\Cores\Repositories\CrudableInterface;
use Penst\Cores\Repositories\AbstractValidator as Validator;
use Penst\Cores\Repositories\RepositoryAbstract;
use Penst\Models\Message\EmailAccount;

/**
 * Class SettingRepository
 * @package Fully\Repositories\Setting
 * @author Sefa Karagöz
 */
class EmailAccountRepository extends RepositoryAbstract implements EmailAccountRepositoryInterface
{
    protected static $rules = [
        'email' => 'required|email',
        'display_name' => 'required',
        'host' => 'required',
        'port' => 'required',
        'username' => 'required',
        'password' => 'required'

    ];
    /*
     * @var \Setting
     */
    private $emailAccount;

    /*
     * @param Setting $setting
     */
    public function __construct(EmailAccount $emailAccount)
    {

        $this->emailAccount = $emailAccount;
    }

    /*
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->emailAccount->findOrFail($id);
    }

    public function create($attributes)
    {
        if ($this->isValid($attributes)) {

            $this->emailAccount->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('Email account validation failed', $this->getErrors());
    }

    public function update($id, $attributes)
    {
        $attributes['email_ssl'] = isset($attributes['email_ssl']) ? true : false;
        $attributes['use_default_credentials'] = isset($attributes['use_default_credentials']) ? true : false;
        $this->emailAccount = $this->find($id);

        if ($this->isValid($attributes)) {

            $this->emailAccount->fill($attributes)->save();
            return true;
        }

        throw new ValidationException('Email account validation failed', $this->getErrors());
    }

    public function delete($id)
    {
        $this->emailAccount = $this->emailAccount->find($id);
        $this->emailAccount->delete();
    }

    public function all()
    {
        return $this->emailAccount->query()->get();
    }

    public function table()

    {
        return $this->emailAccount;
    }

}