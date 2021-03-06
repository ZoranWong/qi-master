<?php

namespace App\Providers;

use App\Repositories\ComplaintRepository;
use App\Repositories\ComplaintRepositoryEloquent;
use App\Repositories\MasterCommentRepository;
use App\Repositories\MasterCommentRepositoryEloquent;
use App\Repositories\MasterRepository;
use App\Repositories\MasterRepositoryEloquent;
use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryEloquent;
use App\Repositories\OfferOrderRepository;
use App\Repositories\OfferOrderRepositoryEloquent;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryEloquent;
use App\Repositories\RefundOrderRepository;
use App\Repositories\RefundOrderRepositoryEloquent;
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
        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(RefundOrderRepository::class, RefundOrderRepositoryEloquent::class);
        $this->app->bind(MasterRepository::class, MasterRepositoryEloquent::class);
        $this->app->bind(OfferOrderRepository::class, OfferOrderRepositoryEloquent::class);
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
