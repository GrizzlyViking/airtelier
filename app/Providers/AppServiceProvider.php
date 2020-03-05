<?php

namespace App\Providers;

use App\Models\Schedule;
use App\Observers\ScheduleObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('columns', function (array $headers): Collection {
            return $this->map(function (Model $row) use ($headers): array {
                $return = [];

                foreach ($headers as $th) {
                    if (strpos($th, '.')) {
                        list($relation, $attr) = explode('.', $th);

                        $related = $row->getAttribute($relation);

                        Arr::set($return, $relation, $related->getAttribute($attr));
                    } else {

                        Arr::set($return, $th, $row->getAttribute($th));
                    }
                }

                return $return;
            });
        });

        Schedule::observe(ScheduleObserver::class);
    }
}
