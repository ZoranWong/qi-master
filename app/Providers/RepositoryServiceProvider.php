<?php

namespace App\Providers;

use App\Repositories\ComplaintRepository;
use App\Repositories\ComplaintRepositoryEloquent;
use App\Repositories\MasterCommentRepository;
use App\Repositories\MasterCommentRepositoryEloquent;
use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryEloquent;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
        $this->app->bind(ComplaintRepository::class, ComplaintRepositoryEloquent::class);
        $this->app->bind(MessageRepository::class, MessageRepositoryEloquent::class);
        $this->app->bind(MasterCommentRepository::class, MasterCommentRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
