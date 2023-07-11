<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\HumanResourceScreen;
use App\Orchid\Screens\TaskScreen;

use App\Orchid\Screens\Medicine\MedicineCreateScreen;
use App\Orchid\Screens\Medicine\MedicineDashboard;
use App\Orchid\Screens\Medicine\MedicineListEditScreen;
use App\Orchid\Screens\Medicine\MedicineListScreen;


use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));



//-------------------------------------------------//
// Platform > HR
Route::screen('hr', HumanResourceScreen::class)
    ->name('platform.humanresource')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Human Resource');
    });


//-------------------------------------------------//

// Platform > Medicines > Dashboard

// Platform > Medicines
Route::screen('medicines/index', MedicineDashboard::class)
    ->name('platform.medicines')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Medicine Dashboard'), route('platform.medicines')));


// Platform > Medicines > All
Route::screen('medicines/list', MedicinelistScreen::class)
    ->name('platform.medicines.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.medicines')
        ->push(__('Medicine Listing'), route('platform.medicines.list')));


// Platform > Medicines > Create
Route::screen('medicines/create', MedicineCreateScreen::class)
    ->name('platform.medicines.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.medicines.list')
        ->push(__('Create'), route('platform.medicines.create')));






/*
Route::screen('medicines', MedicinelistScreen::class)
    ->name('platform.medicines')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Medicines'), route('platform.medicines')));
*/

//TODO: FIx breadcrumb
// Platform > MedicineList > Edit
Route::screen('medicine/{medicine?}', MedicineListEditScreen::class)
    ->name('platform.medicine.edit')
    ->breadcrumbs(fn (Trail $trail, $medicine) => $trail
        ->parent('platform.medicines.list')
        ->push($medicine->name, route('platform.medicine.edit', $medicine)));

/*
Route::screen('medicine/{medicine?}', MedicineListEditScreen::class)
    ->name('platform.medicine.edit')
    ->breadcrumbs(fn (Trail $trail, $medicine) => $trail
        ->parent('platform.medicines')
        ->push($medicine->name, route('platform.medicine.edit', $medicine)));
*/


//-------------------------------------------------//

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));




Route::screen('/form/examples/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/form/examples/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/form/examples/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/form/examples/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/layout/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/charts/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/cards/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');



Route::screen('task', TaskScreen::class)->name('platform.task');


//Route::screen('idea', Idea::class, 'platform.screens.idea');
