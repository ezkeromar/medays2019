<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

Route::get('/create-dummy-user', 'WelcomeController@createDummyUser');

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    // Route::get('/', 'WelcomeController@welcome')->name('welcome');
});

// Authentication Routes
// Auth::routes();

// Authentication Routes...
Route::get('login', function () {
    return redirect('/');
});
Route::get('nimda-manager', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('nimda-manager', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    Route::get('profile/role-permissions','ProfilesController@rolePermission');
    Route::get('profile/change-password','ProfilesController@changePassword');
    Route::put('profile/update-password','ProfilesController@updatePassword');

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});


// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {


    Route::get('import', 'ImportController@index');
    Route::post('import', 'ImportController@store');
    Route::get('export', 'ExportController@index');
    Route::post('export', 'ExportController@store');
    Route::post('export-by-hotel', 'ExportController@exportByHotel');


    // User Profile and Account Routes

    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );


    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);

    // Participants
    Route::post('/participant/{id}/update-prestation', 'ParticipantsController@storePrestation');
    Route::post('/hotel/{hotelid}/room-cats', 'ParticipantsController@getRoomCats');
    Route::get('participants', 'ParticipantsController@index');
    Route::get('formations', 'ParticipantsController@showformation');
    Route::get('participant/{id}', 'ParticipantsController@show');
    Route::post('participant/{id}/update', 'ParticipantsController@storeData');
    Route::get('participant/{id}/prestations', 'ParticipantsController@prestation');
    Route::get('participant/{id}/delegation', 'ParticipantsController@delegation');
    Route::get('participant/{id}/historique', 'ParticipantsController@history');
    Route::get('participant/{id}/commentaire', 'ParticipantsController@comments');
    Route::post('participant/{id}/add/comment', 'ParticipantsController@storecomment');
    Route::get('participant/{id}/edit', 'ParticipantsController@edit');
    Route::get('add/participant/{deleguation?}', 'ParticipantsController@store');
    Route::get('participant/multiple/{action}/{id}', 'ParticipantsController@multiActionFunc');
    Route::get('participant/{id}/{action}/{params?}', 'ParticipantsController@actionFunc');

    // Actions
    Route::post('add/participant/{deleguation?}', 'ParticipantsController@storeData');

    Route::get('hebergements', 'ParticipantsController@hebergementShow');
    Route::get('transferts/arrivees', 'ParticipantsController@transfertsArrivees');
    Route::get('transferts/departs', 'ParticipantsController@transfertsDepart');
    Route::get('comments', 'ParticipantsController@commentsList');
    

});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');

    Route::resource('hotels', 'HotelsController');
    Route::get('types', 'TypesController@index')->name('types.index');
    Route::post('types/update', 'TypesController@update')->name('types.update');
});

Route::redirect('/php', '/phpinfo', 301);


//Participant FRONT
Route::get('/{lang?}', 'ParticipantsController@registerfront')->where('lang', 'fr|en');
Route::get('/success/{lang?}/{type?}', function ($lang, $type) {
    return view('front.laststep', ['lang' => $lang, 'type_id' => $type]);
})->name('successregister')->where('lang', 'fr|en');;
Route::get('/steptow/{lang?}', 'ParticipantsController@registerfronttow')->where('lang', 'fr|en');
Route::get('/changelang/{lang?}/{id?}', 'ParticipantsController@changelangofpartic')->where('lang', 'fr|en');
Route::post('/steptow/store', 'ParticipantsController@registerfronttowstore');
Route::post('/steptow/{lang?}', 'ParticipantsController@registerfrontonestore')->where('lang', 'fr|en');
Route::get('/email/exists/{email}/{id?}', 'ParticipantsController@emailalreadyexists');
Route::get('/incompatiblenavigateur', function () {
    return view('front.catchpage');
});
Route::get('/incompatiblebrowser', function () {
    return view('front.catchpageen');
});