<?php

use App\Http\Controllers\Admin\DictionaryAdminController;
use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Artisan;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('user.pages.index');
})->name('main');

Route::get('/learn', function () {
    return view('user.pages.learn.learn');
})->name('learn');

Route::get('/training', function () {
    return view('user.pages.training.training');
})->name('training');

Route::get('/rating', function () {
    return view('user.pages.rating.rating');
})->name('rating');

Route::get('/profile/{name}', [ProfileController::class, 'index'])->name('profile.index');
//Route::get('/profile/{name}/stats', [ProfileController::class, 'index'])->name('profile.stats');
Route::get('/profile/{name}/stats', [ProfileController::class, 'showStats'])->name('profile.stats');
Route::get('/profile/{name}/history', [ProfileController::class, 'showHistory'])->name('profile.history');
Route::get('/profile/{name}/settings', [ProfileController::class, 'edit'])->name('profile.settings');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/training', [GameController::class, 'index'])->name('training.index');
Route::get('/training/{dictionary}', [GameController::class, 'show'])->name('training.show');
Route::post('/training/getDictionary', [GameController::class, 'getDictionary'])->name('training.getDictionary');
Route::post('/training', [GameController::class, 'store'])->name('training.store');
//Route::resource('training', GameController::class);

Route::get('/dictionaries/sorting', [DictionaryController::class, 'sorting'])->name('dictionaries.sorting');
//Route::post('/dictionaries/{id}', [DictionaryController::class, 'sendComment'])->name('dictionaries.comment');
Route::get('/dictionaries/{dictionary}/records', [DictionaryController::class, 'showRecords'])->name('dictionaries.showRecords');
Route::get('/dictionaries/{dictionary}/comments', [DictionaryController::class, 'showComments'])->name('dictionaries.showComments');
Route::resource('dictionaries', DictionaryController::class);
Route::get('/user/{username}', [ProfileController::class, 'getProfile'])->name('profile.id');

Route::resource('comment', CommentController::class);


Route::resource('favorites', FavoriteController::class);
Route::resource('grade', GradeController::class);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::resource('dictionaries',  DictionaryAdminController::class, [
        'names' => [
            'index' => 'admin.dictionaries.index'
        ],
        'as' => 'dictionaries'
    ]);
    Route::get('/reports/{report}/getReport', [ReportAdminController::class, 'getReport'])->name('admin.reports.getReport');
    Route::resource('reports', ReportAdminController::class, [
        'names' => [
            'update' => 'admin.reports.update'
        ]
    ]);
});

//Для хостинга для создания линка ком артизан
//Route::get('/linkstorage', function () {
//    Artisan::call('storage:link');
//});
