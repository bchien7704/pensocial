<?php namespace Penst\Providers;

use Illuminate\Cache\CacheManager;
use Illuminate\Support\ServiceProvider;
use Penst\Cores\Cache\FullyCache;
use Penst\Cores\Contexts\WorkContext;
use Penst\Cores\Cookies\NativeCookie;
use Penst\Cores\Hashing\NativeHasher;
use Penst\Cores\Repositories\Logging\ActivityLogRepository;
use Penst\Cores\Repositories\Logging\ActivityLogTypeRepository;
use Penst\Cores\Repositories\Message\MessageRepository;
use Penst\Cores\Repositories\Message\EmailAccountRepository;
use Penst\Cores\Repositories\Message\MessageTemplateRepository;
use Penst\Cores\Repositories\Sercurity\PermissionRepository;
use Penst\Cores\Repositories\Setting\SettingRepository;
use Penst\Cores\Repositories\Topic\TopicRepository;
use Penst\Cores\Repositories\Us\GroupRepository;
use Penst\Cores\Repositories\Us\UrlRecordRepository;
use Penst\Cores\Repositories\Us\UserRepository;
use Penst\Cores\Sessions\NativeSession;
use Penst\Models\Logging\ActivityLog;
use Penst\Models\Logging\ActivityLogType;
use Penst\Models\Message\EmailAccount;
use Penst\Models\Message\Message;
use Penst\Models\Message\MessageTemplate;
use Penst\Models\Seo\UrlRecord;
use Penst\Models\Sercurity\Permission;
use Penst\Models\Setting\Setting;
use Penst\Models\Topic\Topic;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;
use Penst\Services\Logging\UserActivityService;
use Penst\Services\Message\EmailAccountService;
use Penst\Services\Message\EmailSender;
use Penst\Services\Message\MessageService;
use Penst\Services\Message\MessageTemplateService;
use Penst\Services\Seo\UrlRecordService;
use Penst\Services\Sercurity\PermissionService;
use Penst\Services\Setting\SettingService;
use Penst\Services\Topic\TopicService;
use Penst\Services\User\UserService;


/**
 * Class RepositoryServiceProvider
 * @package Fully\Repositories
 * @author Sefa Karagöz
 */
class RegisterServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $app = $this->app;

        //dd($app['config']->get('fully.cache'));


        // setting
        $app->bind('Penst\Services\User\UserServiceInterface', function ($app) {

            $user = new UserService(
                new UserRepository(new User()),
                new GroupRepository(new Group()),
                new FullyCache(new CacheManager($app), "Penst.cache", 60),
                new NativeSession(),
                new NativeCookie(),
                new NativeHasher(),
                new WorkContext()
            );

            return $user;
        });

        $app->bind('Penst\Cores\Hashing\HasherInterface', function ($app) {

            $hasher = new NativeHasher();

            return $hasher;
        });

        // setting
        $app->bind('Penst\Cores\Cache\CacheInteface', function ($app) {

            $cache = new FullyCache(new CacheManager($app), "penst_cache", 60);

            return $cache;
        });

        // setting
        $app->bind('Penst\Cores\Sessions\SessionInterface', function ($app) {

            $session = new NativeSession();

            return $session;
        });

        // setting
        $app->bind('Penst\Cores\Cookies\CookieInterface', function ($app) {

            $cookie = new NativeCookie();

            return $cookie;
        });

        // setting
        $app->bind('Penst\Cores\Contexts\WorkContextInterface', function ($app) {

            $workContext = new WorkContext();

            return $workContext;
        });
        // setting
        $app->bind('Penst\Services\Sercurity\PermissionServiceInterface', function ($app) {

            $permissionService = new PermissionService(
                new PermissionRepository(new Permission()),
                new FullyCache(new CacheManager($app), "Penst.cache", 60),
                new WorkContext()
            );

            return $permissionService;
        });

        // setting
        $app->bind('Penst\Services\Setting\SettingServiceInterface', function ($app) {

            $settingService = new SettingService(
                new SettingRepository(new Setting()),
                new FullyCache(new CacheManager($app), "Penst.cache", 60)

            );

            return $settingService;
        });

        // setting
        $app->bind('Penst\Services\Logging\UserActivityServiceInterface', function ($app) {

            $userActivityService = new UserActivityService(
                new ActivityLogRepository(new ActivityLog()),
                new ActivityLogTypeRepository(new ActivityLogType()),
                new FullyCache(new CacheManager($app), "Penst.cache", 60)

            );

            return $userActivityService;
        });
        // email account
        $app->bind('Penst\Services\Message\EmailAccountServiceInterface', function ($app) {

            $emailAccountService = new EmailAccountService(
                new EmailAccountRepository(new EmailAccount()),
                new FullyCache(new CacheManager($app), "Penst.cache", 60)

            );

            return $emailAccountService;
        });
        $app->bind('Penst\Services\Message\EmailSenderInterface', function ($app) {

            $emailSender = new EmailSender();

            return $emailSender;
        });
        $app->bind('Penst\Services\Message\MessageServiceInterface', function ($app) {

            $messageService = new MessageService(
                new MessageRepository(new Message())

            );

            return $messageService;
        });
        $app->bind('Penst\Services\Topic\TopicServiceInterface', function ($app) {

            $topicService = new TopicService(
                new TopicRepository(new Topic())

            );

            return $topicService;
        });

        $app->bind('Penst\Services\Seo\UrlRecordServiceInterface', function ($app) {

            $urlRecordService = new UrlRecordService(
                new UrlRecordRepository(new UrlRecord()),
                new FullyCache(new CacheManager($app), "Penst.cache", 60)
            );

            return $urlRecordService;
        });
        $app->bind('Penst\Services\Message\MessageTemplateServiceInterface', function ($app) {

            $messageTemplateService = new MessageTemplateService(
                new MessageTemplateRepository(new MessageTemplate())

            );

            return $messageTemplateService;
        });
    }
}