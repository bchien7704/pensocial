<?php namespace Penst\Services\Message;

use Penst\Cores\Cache\CacheInterface;
use Penst\Cores\Repositories\Message\EmailAccountRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: hien
 * Date: 11/11/15
 * Time: 6:04 PM
 */
class EmailAccountService implements EmailAccountServiceInterface
{
    private $emailAccountRepository;
    private $cache;

    public function __construct(EmailAccountRepositoryInterface $emailAccountRepository, CacheInterface $cache)
    {
        $this->emailAccountRepository = $emailAccountRepository;
        $this->cache = $cache;

    }

    public function  insertEmailAccount($attributes)
    {
        return $this->emailAccountRepository->create($attributes);
    }

    public function  updateEmailAccount($id, $attributes)
    {
        return $this->emailAccountRepository->update($id, $attributes);
    }

    public function  deleteEmailAccount($id)
    {
        return $this->emailAccountRepository->delete(id);
    }

    public function  getEmailAccountById($id)
    {
        return $this->emailAccountRepository->find($id);
    }

    public function  getAllEmailAccounts()
    {
        return $this->emailAccountRepository->all();
    }
}