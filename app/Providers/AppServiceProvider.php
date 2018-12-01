<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //string too long solver.
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $user = Auth::User();

            $account_manager_menu = ['manage-user','manage-client'];
            $relation_manager_menu = ['manage-supervisor-staff-relation','manage-staff-client-relation'];

            if($user->hasAccess($account_manager_menu)){
                $event->menu->add('ACCOUNT MANAGER',
                [
                    'text'        => 'User Manager',
                    'url'         => 'user/manage',
                    'icon'        => 'user',
                    'can'         => 'manage-user',
                ],
                [
                    'text'        => 'Client Manager',
                    'url'         => 'client/manage',
                    'icon'        => 'user',
                    'can'         => 'manage-client',
                ]);
            }
            if($user->hasAccess($relation_manager_menu)){
                $event->menu->add('RELATION MANAGER',
                [
                    'text'        => 'Relasi Supervisor-Staff',
                    'url'         => 'relation/supervisor/manage',
                    'icon'        => 'link',
                    'can'         => 'manage-supervisor-staff-relation',
                ],
                [
                    'text'        => 'Relasi Staff-Client',
                    'url'         => 'relation/staff/manage',
                    'icon'        => 'link',
                    'can'         => 'manage-staff-client-relation',
                ]);
            }
            $event->menu->add(
                [
                    'header' => 'ACCOUNT SETTINGS',
                    'can'    => 'manage-my-account'
                ],
                [
                    'text' => 'Profile',
                    'url'  => 'user/profile',
                    'icon' => 'user',
                    'can'  => 'manage-my-account',
                ],
                [
                    'text' => 'Change Password',
                    'url'  => 'user/password',
                    'icon' => 'lock',
                    'can'  => 'manage-my-account',
                ]
            );
            $event->menu->add(
                [
                    'header' => Auth::User()->name . " - " . Role::find(Auth::User()->role_id)->name,
                ]
            );
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
