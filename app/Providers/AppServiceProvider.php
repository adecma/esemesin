<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar.sendSms', function($view) {
            $view->with([
                    'balance' => \App\Message::balance(),
                    'routeName' => \Route::currentRouteName(),
                    'dataContacts' => \App\Contact::orderBy('name', 'asc')
                                    ->get(['phoneNumber as no', 'name']),
                    'dataGroups' => \App\Group::orderBy('name', 'asc')
                                    ->get(['id as no', 'name']),
                    'urlForm' => [
                            'contact' => route('contact.sendSms'),
                            'group' => route('group.sendSms'),
                        ]
                ]);
        });

        view()->composer('layouts.sidebar.search', function($view) {
            $view->with([
                    'routeName' => \Route::currentRouteName(),
                    'urlForm' => [
                            'contact' => route('contact.index'),
                            'group' => route('group.index'),
                            'message' => route('message.index'),
                        ]
                ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
