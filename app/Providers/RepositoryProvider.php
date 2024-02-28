<?php

namespace App\Providers;

use App\Repository\InterFace\HistoryRepoInterface;
use App\Repository\RepoClass\backend\PlaneRepo;
use App\Repository\InterFace\PlaneRepoInterface;
use App\Repository\RepoClass\backend\ClientRepo;
use App\Repository\RepoClass\backend\HistoryRepo;
use App\Repository\RepoClass\backend\MarketingRepo;
use App\Repository\RepoClass\backend\ProgrammingRepo;
use App\Repository\RepoClass\backend\VideoRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         //  Repository Plane
         $this->app->bind(
             PlaneRepoInterface::class ,
             PlaneRepo::class,

        );
         //  Repository Client
         $this->app->bind(
             PlaneRepoInterface::class ,
             ClientRepo::class,

        );
         //  Repository Marketing
         $this->app->bind(
             PlaneRepoInterface::class ,
             MarketingRepo::class,

        );

         //  Repository Programming
         $this->app->bind(
             PlaneRepoInterface::class ,
             ProgrammingRepo::class,
        );
         //  Repository Video
         $this->app->bind(
             PlaneRepoInterface::class ,
             VideoRepo::class,
        );
         //  Repository History
         $this->app->bind(
            HistoryRepoInterface::class ,
            HistoryRepo::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}