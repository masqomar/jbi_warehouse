<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'users.create',
            'users.edit',
        ], function ($view) {
            return $view->with(
                'roles',
                Role::get()
            );
        });

        View::composer([
            'coming-products.create',
            'coming-products.edit',
        ], function ($view) {
            return $view->with(
                'products',
                \App\Models\Product::select('id', 'name')->get()
            );
        });

        View::composer([
            'coming-products.create',
            'coming-products.edit',
        ], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer([
            'coming-products.create',
            'coming-products.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'coming-products.create',
            'coming-products.edit',
        ], function ($view) {
            return $view->with(
                'suppliers',
                \App\Models\Supplier::select('id', 'name')->get()
            );
        });

        View::composer([
            'buildings.create',
            'buildings.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'rooms.create',
            'rooms.edit',
        ], function ($view) {
            return $view->with(
                'buildings',
                \App\Models\Building::select('id', 'name')->get()
            );
        });

        View::composer([
            'rooms.create',
            'rooms.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'devisions.create',
            'devisions.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'products.create',
            'products.edit',
        ], function ($view) {
            return $view->with(
                'units',
                \App\Models\Unit::select('id', 'name')->get()
            );
        });

        View::composer([
            'products.create',
            'products.edit',
        ], function ($view) {
            return $view->with(
                'categories',
                \App\Models\Category::select('id', 'code', 'name')->get()
            );
        });

        View::composer([
            'products.create',
            'products.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'products.create',
            'products.edit',
        ], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer([
            'programs.create',
            'programs.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });


        View::composer([
            'members.create',
            'members.edit',
        ], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer([
            'members.create',
            'members.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'assets.create',
            'assets.edit',
        ], function ($view) {
            return $view->with(
                'units',
                \App\Models\Unit::select('id', 'name')->get()
            );
        });

        View::composer([
            'assets.create',
            'assets.edit',
        ], function ($view) {
            return $view->with(
                'categories',
                \App\Models\Category::select('id', 'code', 'name')->get()
            );
        });

        View::composer([
            'assets.create',
            'assets.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'placements.create',
            'placements.edit',
        ], function ($view) {
            return $view->with(
                'rooms',
                \App\Models\Room::select('id', 'name')->get()
            );
        });

        View::composer([
            'placements.create',
            'placements.edit',
        ], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer([
            'placements.create',
            'placements.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code')->get()
            );
        });

        View::composer([
            'mutations.create',
            'mutations.edit',
        ], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer([
            'asset-maintenances.create',
            'asset-maintenances.edit',
        ], function ($view) {
            return $view->with(
                'assetItems',
                \App\Models\AssetItem::select('id', 'code', 'full_code')->get()
            );
        });

        View::composer([
            'procurements.create',
            'procurements.edit',
        ], function ($view) {
            return $view->with(
                'suppliers',
                \App\Models\Supplier::select('id', 'name')->get()
            );
        });

        View::composer([
            'procurements.create',
            'procurements.edit',
        ], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer([
            'procurements.create',
            'procurements.edit',
        ], function ($view) {
            return $view->with(
                'companies',
                \App\Models\Company::select('id', 'code', 'name')->get()
            );
        });

        View::composer([
            'electricities.create',
            'electricities.edit',
        ], function ($view) {
            return $view->with(
                'buildings',
                \App\Models\Building::select('id', 'name')->get()
            );
        });

        // don`t remove this comment, it will generate view composer
    }
}
