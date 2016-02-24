<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/editorial', function () {
    return view('pages.editorial');
});

Route::get('/career', function () {
    return view('pages.career');
});

Route::get('/faq', function () {
    return view('pages.faq');
});

Route::get('/privacy', function () {
    return view('pages.privacy');
});

Route::get('/disclaimer', function () {
    return view('pages.disclaimer');
});

Route::get('/terms', function () {
    return view('pages.terms');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    // Group of administrator feature...
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
        // Authentication routes...
        Route::get('/', ['as' => 'admin.login.form', 'uses' => 'AuthController@showLoginForm']);
        Route::post('login', ['as' => 'admin.login.attempt', 'uses' => 'AuthController@login']);
        Route::get('logout', ['as' => 'admin.login.destroy', 'uses' => 'AuthController@logout']);

        // Basic admin routes...
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdministratorController@index']);
        Route::get('/setting', ['as' => 'admin.setting', 'uses' => 'AdministratorController@setting']);
        Route::match(['put', 'patch'], '/setting', ['as' => 'admin.setting', 'uses' => 'AdministratorController@update']);
        Route::get('/about', ['as' => 'admin.about', 'uses' => 'AdministratorController@about']);

        // Admin module routes...
        Route::resource('contributor', 'ContributorController', ['except' => ['show', 'create', 'store']]);
        Route::resource('article', 'ArticleController', ['except' => ['show']]);
        Route::resource('category', 'CategoryController', ['except' => ['show', 'create', 'edit']]);
        Route::resource('subcategory', 'SubcategoryController', ['only' => ['store', 'update', 'destroy']]);
        Route::resource('feedback', 'SubcategoryController', ['only' => ['index', 'destroy']]);
        Route::post('/feedback/reply', ['as' => 'admin.feedback.reply', 'uses' => 'FeedbackController@reply']);
        Route::post('/feedback/important', ['as' => 'admin.feedback.important', 'uses' => 'FeedbackController@important']);
        Route::post('/feedback/archive', ['as' => 'admin.feedback.archive', 'uses' => 'FeedbackController@archive']);
    });

    // Index routes...
    Route::get('/', ['as' => 'index', 'uses' => 'PageController@index']);

    // Searching routes...
    Route::get('/search', ['as' => 'search', 'uses' => 'PageController@search']);
    Route::get('/search/people', ['as' => 'search.people', 'uses' => 'PageController@searchPeople']);
    Route::get('/search/article', ['as' => 'search.article', 'uses' => 'PageController@searchArticle']);

    // Authentication routes...
    Route::get('auth/login', ['as' => 'login.form', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::post('auth/login', ['as' => 'login.attempt', 'uses' => 'Auth\AuthController@login']);
    Route::get('account/logout', ['as' => 'login.destroy', 'uses' => 'Auth\AuthController@logout']);

    // Registration routes...
    Route::get('auth/register', ['as' => 'register.form', 'uses' => 'Auth\AuthController@showRegistrationForm']);
    Route::post('auth/register', ['as' => 'register.attempt', 'uses' => 'Auth\AuthController@register']);

    // Contact / feedback routes...
    Route::resource('feedback', 'FeedbackController', ['only' => ['store']]);

    // Group of article routes...
    Route::group(['as' => 'article.'], function () {
        Route::get('/{slug}', ['as' => 'show', 'uses' => 'ArticleController@show']);
        Route::get('/category/{category}', ['as' => 'category', 'uses' => 'CategoryController@index']);
        Route::get('/category/{category}/{subcategory}', ['as' => 'subcategory', 'uses' => 'SubcategoryController@index']);
        Route::get('/featured/latest', ['as' => 'latest', 'uses' => 'ArticleController@latest']);
        Route::get('/featured/headline', ['as' => 'headline', 'uses' => 'ArticleController@headline']);
        Route::get('/featured/trending', ['as' => 'trending', 'uses' => 'ArticleController@trending']);
        Route::get('/featured/random', ['as' => 'random', 'uses' => 'ArticleController@random']);
        Route::get('/archive', ['as' => 'archive', 'uses' => 'ArticleController@archive']);
        Route::post('/rate/{id}', ['as' => 'rate', 'uses' => 'ArticleController@rate']);
        Route::post('/hit/{id}', ['as' => 'hit', 'uses' => 'ArticleController@hit']);
    });

    // Group of contributor view profile routes...
    Route::group(['as' => 'contributor.', 'prefix' => 'contributor/{username}'], function () {
        Route::get('/', ['as' => 'stream', 'uses' => 'ContributorController@show']);
        Route::get('/detail', ['as' => 'detail', 'uses' => 'ContributorController@detail']);
        Route::get('/article', ['as' => 'article', 'uses' => 'ContributorController@article']);
        Route::get('/follower', ['as' => 'follower', 'uses' => 'ContributorController@follower']);
        Route::get('/following', ['as' => 'following', 'uses' => 'ContributorController@following']);
    });

    // Group of logged in account profile routes...
    Route::group(['as' => 'account.', 'prefix' => 'account', 'middleware' => ['auth']], function () {
        Route::get('/', ['as' => 'stream', 'uses' => 'ArticleController@stream']);

        Route::group(['as' => 'message.', 'prefix' => 'message'], function () {
            Route::get('/', ['as' => 'list', 'uses' => 'MessageController@index']);
            Route::post('/{id}', ['as' => 'send', 'uses' => 'MessageController@send']);
            Route::delete('/{id}', ['as' => 'delete', 'uses' => 'MessageController@destroy']);
            Route::get('/conversation/{username}', ['as' => 'conversation', 'uses' => 'MessageController@conversation']);
        });

        Route::get('/article', ['as' => 'article', 'uses' => 'ArticleController@index']);
        Route::get('/follower', ['as' => 'follower', 'uses' => 'FollowerController@follower']);
        Route::get('/following', ['as' => 'following', 'uses' => 'FollowerController@following']);

        Route::post('/follow', ['as' => 'follow', 'uses' => 'FollowerController@follow']);
        Route::delete('/unfollow/{id}', ['as' => 'unfollow', 'uses' => 'FollowerController@unfollow']);

        Route::get('/setting', ['as' => 'setting', 'uses' => 'ContributorController@setting']);
        Route::match(['put', 'patch'], '/setting', ['as' => 'update', 'uses' => 'ContributorController@update']);
    });

    // Group of API for external devices...
    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
        Route::resource('article', 'ArticleController', ['except' => [
            'create', 'edit'
        ]]);
        Route::post('article/hit', ['as' => 'api.article.hit', 'uses' => 'ArticleController@hit']);

        Route::get('/category/{category}', ['as' => 'api.category', 'uses' => 'CategoryController@index']);
        Route::get('/category/{category}/{subcategory}', ['as' => 'api.subcategory', 'uses' => 'SubcategoryController@index']);

        Route::post('/register', ['as' => 'api.register', 'uses' => 'ContributorController@register']);
        Route::post('/login', ['as' => 'api.login', 'uses' => 'ContributorController@login']);

        Route::post('/follow', ['as' => 'api.follow', 'uses' => 'FollowerController@follow']);
        Route::delete('/unfollow/{$id}', ['as' => 'api.unfollow', 'uses' => 'FollowerController@unfollow']);

        Route::group(['as' => 'api.contributor.', 'prefix' => 'contributor/{id}'], function () {
            Route::get('/', ['as' => 'show', 'uses' => 'ContributorController@show']);
            Route::get('/article', ['as' => 'article', 'uses' => 'ContributorController@article']);
            Route::get('/follower', ['as' => 'follower', 'uses' => 'ContributorController@follower']);
            Route::get('/following', ['as' => 'following', 'uses' => 'ContributorController@following']);
            Route::match(['put', 'patch'], '/', ['as' => 'update', 'uses' => 'ContributorController@update']);
        });
    });

});
