<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->string('hash_method',10)->nullable();;
            $table->string('photo')->nullable();;;
            $table->string('title')->nullable();;;
            $table->string('location')->nullable();;;
            $table->text('about')->nullable();;;
            $table->enum('gender',array('u','m','f'))->default('u');
            $table->integer('count_visits')->default(0);
            $table->integer('count_invitations')->default(0);
            $table->integer('count_notifications')->default(0);
            $table->integer('invite_user_id');
            $table->timestamp('set_invitation_date')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->timestamp('date_first_visit')->nullable();
            $table->timestamp('date_last_active')->nullable();
            $table->string('last_ip_address',39)->nullable();
            $table->boolean('verified')->default(0);
            $table->boolean('banned')->default(0);
            $table->boolean('deleted')->default(0);
            $table->boolean('activated')->default(0);
            $table->string('activation_code');
            $table->string('persist_code');
            $table->string('reset_password_code');
            $table->integer('count_unread_conversations')->default(0);
            $table->integer('count_discussions')->default(0);
            $table->integer('ccount_unread_discussions')->default(0);
            $table->integer('count_comments')->default(0);
            $table->timestamps();

            // We'll need to ensure that MySQL uses the InnoDB engine to
            // support the indexes, other engines aren't affected.
            $table->engine = 'InnoDB';
            $table->unique('email');
            $table->index('activation_code');
            $table->index('reset_password_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
