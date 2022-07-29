<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsergroupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('getusers/{id}', [UserController::class, 'getusers']);
Route::get('getusers/{status}', [UserController::class, 'getUser']);
Route::get('getuserbyid/{id}', [UserController::class, 'getUserById']);
require __DIR__ . '/auth.php';
Route::resources([
    'users' => UserController::class,
    'guests_settings' => GuestsSettingsController::class,
    'usergroups' => UsergrouusergroupspController::class,
    'profile' => ProfileController::class,
    'films' => FilmController::class,
    'demogroups' => DemographicGroupController::class,
    'clusters' => ClusterController::class,
    'accgroups' => AccountabilityGroupController::class,
    'members' => MemberController::class,
    'weekly_attendances' => WeeklyAttendanceController::class,
]);
// Auth::routes();
