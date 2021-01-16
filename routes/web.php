<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HeadlineController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Site;
use App\Http\Controllers\siteController;
use App\Models\Content;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;

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

Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
});

Route::get('/', function () {
    $jsonurl= "data.json";
    $json = file_get_contents($jsonurl);
    $data = json_decode($json);
    $blogs=Content::whereType(1)->whereStatus('accepted')->paginate(3);
    $testimonials= Testimonial::all();
    return view('welcome',compact('blogs','data','testimonials'));
});

Route::get('berita/tag/{tag}/', 'Site@newsTagLink')->name('newsTagLink');
Route::get('blog/tag/{tag}/', 'Site@blogTagLink')->name('blogTagLink');
Route::get('blog/show/{id}',[siteController::class,'show'])->name('show');
Route::get('berita/show/{id}',[Site::class,'show'])->name('shownews');
Route::post('blog/search/', 'Site@blogSearchPost')->name('blogSearchPost');
Route::get('blog/search/{search}', 'Site@blogSearch')->name('blogSearch');
Route::post('berita/search/', 'Site@beritaSearchPost')->name('beritaSearchPost');
Route::get('berita/search/{search}', 'Site@beritaSearch')->name('beritaSearch');
Route::get('about',[siteController::class,'about'])->name('about');
Route::get('contact',[siteController::class,'contact'])->name('contact');
Route::get('blog',[siteController::class,'blog'])->name('blog');
Route::get('berita',[siteController::class,'berita'])->name('berita');
Route::get('singleblog',[siteController::class,'singleblog'])->name('singleblog');
Route::resource('comment', CommentController::class)->only(['index']);
Route::post('blog/comment/{id}/',[CommentController::class,'store'])->name('comment-store-blog');
Route::post('berita/comment/{id}/',[CommentController::class,'store'])->name('comment-store-news');
Route::post('blog/comment/{id}/{blog}/',[CommentController::class,'destroy'])->name('comment-destroy-blog');
Route::post('news/comment/{id}/{berita}/',[CommentController::class,'destroy'])->name('comment-destroy-news');

Route::name('admin.')->prefix('admin')->middleware(['auth:sanctum','web', 'verified'])->group(function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');
    Route::get('/welcome', function () {
        $jsonurl= "data.json";
        $json = file_get_contents($jsonurl);
        $data = json_decode($json);
        $blogs=Content::whereType(1)->whereStatus('accepted')->paginate(3);
        $testimonials= Testimonial::all();
        return view('welcome',compact('blogs','data','testimonials'));
    });

    Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
        Route::group(['middleware' => ['auth', 'verified']], function () {
            // User & Profile...
            Route::get('/user/profile', [UserProfileController::class, 'show'])
                ->name('profile.show');

            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
            }
        });
    });

    Route::resource('tag',TagController::class)->only(['index','create','edit']);
    Route::resource('blog',BlogController::class)->only(['index','create','edit','list']);
    Route::resource('faq',FaqController::class)->only(['index','create','edit']);
    Route::resource('headline',HeadlineController::class)->only(['index','create','edit']);
    Route::resource('user',UserController::class)->only(['index','create','edit']);
    Route::resource('event',EventController::class)->only(['index','create','edit']);
    Route::resource('news',NewController::class)->only(['index','create','edit']);
    Route::resource('testimonial', TestimonialController::class)->only(['index','create','edit']);
    Route::resource('comment', CommentController::class)->only(['index','destroy']);

});

