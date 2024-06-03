<?php

use App\Http\Controllers\Admin\StatisticsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StatisticsCreatorController;
use App\Http\Controllers\BlacklistUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\User\ProjectController;

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

// Routes which does not require any authentication 
Route::group(["namespace" => "App\Http\Controllers"], function () {
    Route::get('/', "HomeController@index")->name('home');
    Route::view('privacy-policy', "privacy-policy")->name('privacy-policy');
    Route::view('terms-condition', "terms-condition")->name('terms-condition');
    //Common Function Route
    Route::get('get-subparent-section/{id}', "CommonFunctionController@getSubSections")->name('get-sub-section');
    // Route::get('get-child-section/{id}', "CommonFunctionController@getChildSections")->name('get-child-section');
    Route::get('get-tags/{id}', "CommonFunctionController@getTags")->name('get-tags');
    Route::get('section/{level}/{slug}', "SectionController@index")->name('section.page');
    Route::get('search', "HomeController@search")->name('search');
    Route::get('poster/{slug}', "PostController@index")->name('post.details');
    // Follow unfollow 
    Route::post('poster/follow', "PostController@follow")->name('post.follow');
    //Purcahse Episode
    Route::post('poster/purchase/create', "PostController@createPurchase")->name('post.purchase.create');
    Route::post('poster/purchase/store', "PostController@storePurchase")->name('post.purchase.store');
    //Contact form
    Route::post('submit-query', "HomeController@SubmitQuery")->name('submit-query');
    // Route for change language
    Route::get('update-language/{locale}', function ($locale) {
        if (isset($locale) && in_array($locale, config('constant.language'))) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
            return  back()->with(["alert-type" => "success", "message" => trans('global.language_change_success')]);
        }
        return back()->with(["alert-type" => "error", "message" => trans('global.language_change_error')]);
    })->name("update-language");

    // Report Route 
    Route::post('report/create', "ReportController@create")->name('report.create');
    Route::post('report/store', "ReportController@store")->name('report.store');
});

// Delete episode image.
Route::post('/delete-episode-image', 'App\Http\Controllers\PosterController@deleteEpisodeImage')->name('delete-episode-image');

Route::resource('post', "App\Http\Controllers\PosterController")->middleware(["auth", "verified", "status"]);

Route::get('chat/screen', [ChatController::class, 'chatScreen'])->name('chat.screen');
Route::resource('chats', "App\Http\Controllers\ChatController")->middleware(["auth", "verified", "status"]);



Route::post('/message/send', [MessageController::class, 'storeMessage'])->name('message.send');


// Message routes 
Route::get('/message/{projectId}', [MessageController::class, 'index'])->name('message.index')->middleware(["auth", "verified", "status"]);
Route::get('messages/screen', [MessageController::class, 'messageScreen'])->name('message.screen');
Route::post('/lock-project', [ProjectController::class, 'lockedProject'])->name('lock.project');
Route::post('/finish-project', [ProjectController::class, 'finishedProject'])->name('finish.project');

Route::post('/delete-request-projects', 'ProjectController@deleteRequestProjects')->name('projects.request.delete');


// Route::get("post/edit/{param}","App\Http\Controllers\PosterController@edit")->name("post.edit")->middleware('auth');
Route::post('post/update-status', 'App\Http\Controllers\PosterController@updateStatus')->name('post.updateStatus')->middleware(["auth", "verified"]);
Route::post("post/remove-episode", "App\Http\Controllers\PosterController@removeEpisode")->name("post.remove-episode")->middleware(["auth", "verified"]);
Route::post("post/upload-image", "App\Http\Controllers\PosterController@uploadImage")->name("post.upload-image")->middleware(["auth", "verified"]);

// User and creator routes 
//Route::view('/create-post', "user.create_post")->name('create-post');
Route::group(["namespace" => "App\Http\Controllers\User", 'as' => 'user.', "prefix" => "user", 'middleware' => ["auth", "verified", "status"]], function () {
    // User Profile Related Route
    Route::get('/profile', "HomeController@index")->name('profile');
    Route::post('/profile/update', "ProfileController@updateProfile")->name('profile.update');
    Route::post('/profile/change-password', "ProfileController@changePassword")->name('profile.change-password');
    Route::view('/credit-history', "user.credit-history")->name('credit-history');
    Route::view('/post-history', "user.post-history")->name('post-history');
    //Point Related Routes
    Route::get('/self-top-up', "PointsController@selftopup")->name('self-top-up');
    Route::post('/self-top-up/submit', "PointsController@paymenttopup")->name('self-top-up.submit');

    // Project Controller routes

    // Creator route
    Route::get('/project/detail/{creator_id}/{project_id}', "ProjectController@getProjectDetail")->name('project.detail');
    Route::get('/project/confirm', "ProjectController@confirmProjectByCreator")->name('creator.project.confirm');
    Route::post('/add-project-bid', "ProjectController@addBidByCreator")->name('add.project.bid');

    //user routes    
    Route::get('/projects/confirm/{creator_id}/{project_id}', "ProjectController@confirmProject")->name('project.confirm');
    Route::get('/projects/cancel/{creator_id}/{project_id}', "ProjectController@cancelProjectByUser")->name('project.cancel');
    Route::get('/project/request', "ProjectController@getAllProjectRequest")->name('project.request');
    Route::resource('project', "ProjectController")->middleware('checkProjectAccess');
});


// Admin  routes
Route::group(["namespace" => "App\Http\Controllers\Admin", 'as' => 'admin.', "prefix" => "admin", "middleware" => ["auth", "isadmin", "status"]], function () {
    // Home Page Routes 
    Route::get('dashboard', "DashboardController@index")->name('dashboard');
    Route::get('profile', "ProfileController@profile")->name('profile');
    Route::post('update-profile/{id}', "ProfileController@updateProfile")->name('update_profile');
    Route::get('change-password', "ProfileController@showChangePasswordForm")->name('changePasswordForm');
    Route::post('change-password', "ProfileController@changePassword")->name('changePassword');
    Route::post('email-template-update-status', "EmailTemplateController@updateStatus")->name('email-templates.updateStatus');
    Route::post('user-update-status', 'UserController@updateStatus')->name('users.updateStatus');
    Route::post('parent-section/update-status', 'SectionController@updateStatus')->name('section.parent-section.updateStatus');
    Route::post('sub-section/update-status', 'SubSectionController@updateStatus')->name('section.sub-section.updateStatus');
    // Route::post('child-section/update-status', 'ChildSectionController@updateStatus')->name('section.child-section.updateStatus');
    Route::post('tag-type/update-status', 'TagTypeController@updateStatus')->name('tag-management.tag-type.updateStatus');
    Route::post('tag/update-status', 'TagsController@updateStatus')->name('tag-management.tag.updateStatus');
    Route::post('advertisement/update-status', 'AdvertisementController@updateStatus')->name('advertisement.updateStatus');
    Route::post('plan/update-status', 'PlanController@updateStatus')->name('plan.updateStatus');
    Route::post('projects/update-status', 'ProjectAdminController@updateStatus')->name('projects.updateStatus');
    Route::get('projects/read-chat/{projectId}', 'ProjectAdminController@readChat')->name('projects.readChat');


    // Site statistics Graph Filteration Admin routes start
    Route::get('member-registration/{range?}', 'StatisticsController@membersRegistrationGraph')->name('statistics.members-registration');
    Route::get('number-of-posts/{range?}', 'StatisticsController@numberPostsGraph')->name('statistics.number-posters');
    Route::get('visit-users/{range?}', 'StatisticsController@visitingUsersGraph')->name('statistics.visiting-users');
    Route::get('popular-posters/{range?}', 'StatisticsController@popularPostersGraph')->name('statistics.popular-posters');
    Route::get('mobile-access/{range?}', 'StatisticsController@mobileAccessGraph')->name('statistics.mobile-access');
    // Site statistics Graph Filteration routes end

    // Resourse Routes
    Route::resource('settings', "SettingController")->only(['create', 'store']);
    Route::resource('users', "UserController");
    Route::resource('email-templates', "EmailTemplateController");
    Route::resource('advertisement', "AdvertisementController");
    Route::resource('plan', "PlanController");
    Route::resource('query', "QueriesController");
    Route::resource('report', "ReportController");
    Route::resource('projects', "ProjectAdminController")->middleware('projectAccessToAdmin');
    Route::group(["prefix" => "section"], function () {
        Route::resource('parent-section', "SectionController");
        Route::resource('sub-section', "SubSectionController");
        // Route::resource('child-section', "ChildSectionController");
    });
    // Tag management routes
    Route::group(["prefix" => "tags"], function () {
        Route::resource('tag-type', "TagTypeController");
        Route::resource('tag', "TagsController");
    });

    // Blacklist Tag management routes
    Route::post('blacklist-tag/update-status', 'BlacklistTagController@updateStatus')->name('blacklist_tag.updateStatus');
    Route::resource('blacklist-tag', "BlacklistTagController");
});

Route::get('site-statistics', [StatisticsController::class, 'index'])->name('site-statistics')->middleware('checkUserRole');
// Site statistics Graph Filteration creator routes start
Route::get('member-registration/{range?}', [StatisticsCreatorController::class, 'membersRegistrationGraph'])->name('statistics.members-registration');
Route::get('number-of-posts/{range?}', [StatisticsCreatorController::class, 'numberPostsGraph'])->name('statistics.number-posters');
Route::get('visit-users/{range?}', [StatisticsCreatorController::class, 'visitingUsersGraph'])->name('statistics.visiting-users');
Route::get('popular-posters/{range?}', [StatisticsCreatorController::class, 'popularPostersGraph'])->name('statistics.popular-posters');
Route::get('mobile-access/{range?}', [StatisticsCreatorController::class, 'mobileAccessGraph'])->name('statistics.mobile-access');
// Site statistics Graph Filteration routes end


// Blacklist users routes start
Route::group(["middleware" => ["auth", "status"]], function () {
    Route::get('blacklist/users', [BlacklistUserController::class, 'index'])->name('blacklist.user');
    Route::post('blacklist/user/store', [BlacklistUserController::class, 'store'])->name('blacklist.user.store');
    Route::get('blacklist/user/show/{id}', [BlacklistUserController::class, 'show'])->name('blacklist.user.show');
    Route::get('blacklist/user/edit/{id}', [BlacklistUserController::class, 'edit'])->name('blacklist.user.edit');
    Route::post('blacklist/user/update', [BlacklistUserController::class, 'update'])->name('blacklist.user.update');
    Route::post('blacklist/user/import', [BlacklistUserController::class, 'importExcel'])->name('blacklist.user.import');
});
// Blacklist users routes start end




// Login Registeres releted routes 
Auth::routes();
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
