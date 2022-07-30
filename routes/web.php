<?php

use App\Http\Controllers\AuditLogsController;
use App\Http\Controllers\DeclinedController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GuestsSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\MRaterController;
use App\Http\Controllers\MuserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatedController;
use App\Http\Controllers\RatersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UnratedController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'redirect']);
Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('getusers/{id}', [UserController::class, 'getusers']);
Route::get('getusers/{status}', [UserController::class, 'getUser']);
Route::get('getuserbyid/{id}', [UserController::class, 'getUserById']);

//Films Routes
Route::get('films/get_list', [FilmController::class, 'getFilmsList']);
Route::get('films/get_examiners', [FilmController::class, 'getFilmsExaminers']);
Route::get('reports/get_list', [FilmController::class, 'getFilmsList']);
Route::get('films/synopsis', [FilmController::class, 'filmSynopsis']);
Route::get('assignexaminers', [FilmController::class, 'assignExaminers']);
Route::get('examiner/{id}', [FilmController::class, 'filmsExaminers']);
Route::get('examiner/get_films_examiners/{id}', [FilmController::class, 'getFilmsExaminersByID']);
Route::post('examiner/remove', [FilmController::class, 'removeExaminer']);
Route::post('storefilmexaminer', [FilmController::class, 'storeFilmExaminer']);
Route::delete('removefilmexaminer', [FilmController::class, 'removeFilmExaminer']);
//Films Routes

Route::get('/mrater/', [MRaterController::class, 'index']);
Route::get('/mrate/{id}', [MRaterController::class, 'rate']);
Route::get('/mposter/', [MRaterController::class, 'rate_poster']);
Route::get('/get_m_films_to_rate/', [MRaterController::class, 'getFilmsList']);
Route::get('/reports/detailed/{id}', [ReportController::class, 'detailed']);
Route::get('ratedfilms', [FilmController::class, 'ratedfilms']);
Route::match(['get', 'post'], 'client/password', [SettingsController::class, 'clientPassword']);
Route::get('rater/profile', [SettingsController::class, 'raterProfile']);
Route::post('profile/post', [SettingsController::class, 'raterProfilePost']);
Route::get('settings/themes', [SettingsController::class, 'themes']);
Route::get('settings/themes/{id}', [SettingsController::class, 'themesbyID']);
Route::post('settings/themes', [SettingsController::class, 'savethemes']);
Route::put('settings/themes/{id}', [SettingsController::class, 'updatethemes']);
Route::get('settings/parameters', [SettingsController::class, 'parameters']);
Route::post('settings/parameters', [SettingsController::class, 'saveparameters']);
Route::get('get/parameters', [SettingsController::class, 'getParameters']);
Route::get('get/themes', [SettingsController::class, 'getThemes']);
Route::get('/reviewrate/{id}', [ModeratorController::class, 'reviewrate']);
Route::get('/getnonratedfilms', [ModeratorController::class, 'getnonratedfilms']);
Route::get('/getnonratedfilmnosynopser', [ModeratorController::class, 'getnonratedfilmnosynopser']);
Route::get('/getfilmthemeoccurance/{id}', [ModeratorController::class, 'getfilmthemeoccurance']);
Route::get('/moderator/new', [ModeratorController::class, 'unrated']);
Route::put('choose_examiner/{id}', [ModeratorController::class, 'chooseExaminer']);
Route::get('/getraters_reviews/{id}', [ModeratorController::class, 'getraters_reviews']);
Route::get('/getuseraters/{id}', [ModeratorController::class, 'getuseraters']);
Route::get('getfilm/{id}', [FilmController::class, 'getEditData']);
Route::get('getParameter/{id}', [RatersController::class, 'getParameter']);
Route::get('history', [RatersController::class, 'history']);
Route::get('get_my_rating_history', [RatersController::class, 'getMyRatingHistory']);
Route::post('rate/{id}', [RatersController::class, 'store']);
Route::post('storeTimeOccurance', [RatersController::class, 'storeTimeOccurance']);
Route::get('rate/{id}', [RatersController::class, 'rate']);
Route::get('get_temp_param/{filmID}', [RatersController::class, 'get_temp_param']);
Route::get('get_theme_time_occurance/{filmID}', [RatersController::class, 'get_theme_time_occurance']);
Route::get('getlogs', [AuditLogsController::class, 'getLogs']);
Route::get('films/get_list', [FilmController::class, 'getFilmsList']);
Route::get('films/get_examiners', [FilmController::class, 'getFilmsExaminers']);
Route::get('reports/get_list', [ReportController::class, 'getFilmsList']);
Route::get('films/synopsis', [FilmController::class, 'filmSynopsis']);
Route::get('assignexaminers', [FilmController::class, 'assignExaminers']);
Route::get('examiner/{id}', [FilmController::class, 'filmsExaminers']);
Route::get('examiner/get_films_examiners/{id}', [FilmController::class, 'getFilmsExaminersByID']);
Route::post('examiner/remove', [FilmController::class, 'removeExaminer']);
Route::post('poster', [FilmController::class, 'poster']);
Route::post('video', [FilmController::class, 'video']);
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/reports_dasboard', [HomeController::class, 'reportsDasboard']);
Route::get('/lock', [ProfileController::class, 'lock']);
Route::get('/unrated/get_list/', [UnratedController::class, 'getFilmsList']);
Route::get('/rated/get_list/', [RatedController::class, 'getFilmsList']);
Route::get('/get_films_to_rate/', [RatersController::class, 'getFilmsList']);
Route::get('/viewrate/{id}', [RatersController::class, 'getFilmsRatrPerUser']);
Route::get('/get_films_posters_to_rate/', [RatersController::class, 'getFilmsPostersList']);
Route::get('/rate_poster/', [RatersController::class, 'rate_poster']);
Route::get('/poster_rate/{id}', [RatersController::class, 'poster_rate']);

require __DIR__ . '/auth.php';
Route::resources([
    'users' => UserController::class,
    'guests_settings' => GuestsSettingsController::class,
    'profile' => ProfileController::class,
    'films' => FilmController::class,
    '/musers' => MuserController::class,

    '/reports' => ReportController::class,
    '/auditlogs' => AuditLogsController::class,
    'genre' => GenreController::class,
    '/usergroups' => GroupController::class,
    '/moderator' => ModeratorController::class,
    '/rater' => RatersController::class,
    '/unrated' => UnratedController::class,
    '/rated' => RatedController::class,
    '/declined' => DeclinedController::class,
]);
// Auth::routes();
