<?php namespace Penst\Providers;

use Illuminate\Support\ServiceProvider;
use Penst\Cores\Repositories\Logging\ActivityLogRepository;
use Penst\Cores\Repositories\Logging\ActivityLogTypeRepository;
use Penst\Cores\Repositories\Logging\MessageRepository;
use Penst\Cores\Repositories\Message\EmailAccountRepository;
use Penst\Cores\Repositories\Message\MessageTemplateRepository;
use Penst\Cores\Repositories\Setting\SettingRepository;
use Penst\Cores\Repositories\Topic\TopicRepository;
use Penst\Cores\Repositories\Us\GroupRepository;
use Penst\Cores\Repositories\Us\UrlRecordRepository;
use Penst\Cores\Repositories\Us\UserRepository;
use Penst\Models\Logging\ActivityLog;
use Penst\Models\Logging\ActivityLogType;
use Penst\Models\Message\EmailAccount;
use Penst\Models\Message\Message;
use Penst\Models\Message\MessageTemplate;
use Penst\Models\Seo\UrlRecord;
use Penst\Models\Setting\Setting;
use Penst\Models\Topic\Topic;
use Penst\Models\Us\Group;
use Penst\Models\Us\User;


/**
 * Class RepositoryServiceProvider
 * @package Fully\Repositories
 * @author Sefa Karagöz
 */
class RepositoryServiceProvider extends ServiceProvider
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
        $app->bind('Penst\Cores\Repositories\Us\UserRepositoryInterface', function ($app) {

            $user = new UserRepository(
                new User()
            );

            return $user;
        });

        // setting
        $app->bind('Penst\Cores\Repositories\Us\GroupRepositoryInterface', function ($app) {

            $group = new GroupRepository(
                new Group()
            );

            return $group;
        });

        // setting
        $app->bind('Penst\Cores\Repositories\Setting\SettingRepositoryInterface', function ($app) {

            $setting = new SettingRepository(
                new Setting()
            );

            return $setting;
        });
        // setting
        $app->bind('Penst\Cores\Repositories\Logging\ActivityLogRepositoryInterface', function ($app) {

            $activityLog = new ActivityLogRepository(
                new ActivityLog()
            );

            return $activityLog;
        });
        // setting
        $app->bind('Penst\Cores\Repositories\Logging\ActivityLogTypeRepositoryInterface', function ($app) {

            $activityLogType = new ActivityLogTypeRepository(
                new ActivityLogType()
            );

            return $activityLogType;
        });
        // setting
        $app->bind('Penst\Cores\Repositories\Message\EmailAccountRepositoryInterface', function ($app) {

            $emailAccount = new EmailAccountRepository(
                new EmailAccount()
            );

            return $emailAccount;
        });
        $app->bind('Penst\Cores\Repositories\Message\MessageRepositoryInterface', function ($app) {

            $message = new MessageRepository(
                new Message()
            );

            return $message;
        });

        $app->bind('Penst\Cores\Repositories\Topic\TopicRepositoryInterface', function ($app) {

            $topic = new TopicRepository(
                new Topic()
            );

            return $topic;
        });
        $app->bind('Penst\Cores\Repositories\Seo\UrlRecordRepositoryInterface', function ($app) {

            $urlRecord = new UrlRecordRepository(
                new UrlRecord()
            );

            return $urlRecord;
        });
        $app->bind('Penst\Cores\Repositories\Message\MessageTemplateRepositoryInterface', function ($app) {

            $messageTemplate = new MessageTemplateRepository(
                new MessageTemplate()
            );

            return $messageTemplate;
        });
    }
}