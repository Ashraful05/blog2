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
*/
Route::get('/404','ErrorHandleController@error404');
Route::get('/405','ErrorHandleController@error405');

Route::get('/', [
    'uses'=>'Projectcontroller@index',
    'as'=>'/'
]);
Route::get('/category-blog/{id}/{name}',[
    'uses' => 'Projectcontroller@categoryBlog',
    'as'     => 'category-blog',
    'middleware' => 'visitor'
]);
Route::get('/blog-details/{id}',[
    'uses' => 'Projectcontroller@blogDetails',
    'as'   => 'blog-details'
]);
Route::get('/sign-up',[
    'uses' => 'SignUpController@signUp',
    'as'   => 'sign-up'
]);
Route::post('/new-sign-up',[
    'uses' => 'SignUpController@newsignUp',
    'as'   => 'new-sign-up'
]);
Route::post('/visitor-logout',[
    'uses' => 'SignUpController@visitorLogout',
    'as'   => 'visitor-logout'
]);
Route::get('/visitor-login',[
    'uses' => 'SignUpController@visitorLogin',
    'as'   => 'visitor-login'
]);
Route::post('/visitor-sign-in',[
    'uses' => 'SignUpController@visitorSignIn',
    'as'   => 'visitor-sign-in'
]);
Route::post('/new-comment',[
    'uses' => 'CommentController@newComment',
    'as'   => 'new-comment'
]);
Route::get('/email-check/{email}',[
    'uses' => 'SignUpController@emailCheck',
    'as'   => 'email-check'
]);

//Category routes are here

Route::group(['middleware' => 'superadmin'], function (){

    Route::get('/category/add-category',[
        'uses'      =>'CategoryController@addCategory',
        'as'        =>'add-category',
        'middleware'=> 'superadmin'
    ]);
    Route::post('/category/new-category',[
        'uses'=>'CategoryController@saveCategory',
        'as'=>'new-category'
    ]);

    Route::get('/category/manage-category',[
        'uses'=>'CategoryController@manageCategory',
        'as'=>'manage-category',
        'middleware' => 'superadmin'
    ]);

    Route::get('/category/edit-category/{id}',[
        'uses'=>'CategoryController@editCategory',
        'as'=>'edit-category'
    ]);

    Route::post('/category/update-category',[
        'uses'=>'CategoryController@updateCategory',
        'as'=>'update-category'
    ]);

    Route::post('/category/delete-category',[
        'uses'=>'CategoryController@deleteCategory',
        'as'=>'delete-category'
    ]);
});

//category routing ends here.......

//Blog routes start here....

Route::get('/blog/add-blog',[
   'uses'=>'BlogController@addBlog',
    'as'=>'add-blog'
]);

Route::post('/blog/new-blog',[
    'uses' => 'BlogController@newBlog',
    'as'    => 'new-blog'
]);

Route::get('/blog/manage-blog',[
    'uses'=>'BlogController@manageBlog',
    'as' => 'manage-blog'
]);

Route::get('/blog/edit-blog/{id}',[
    'uses' => 'BlogController@editBlog',
    'as' =>  'edit-blog'
]);

Route::post('/blog/update-blog',[
    'uses' => 'BlogController@updateBlog',
    'as' => 'update-blog'
]);
Route::post('/blog/delete-blog',[
    'uses' => 'BlogController@deleteBlog',
    'as'   => 'delete-blog'
]);
Route::get('/manage-comments',[
   'uses' => 'BlogController@manageComment',
    'as'  => 'manage-comments'
]);
Route::get('/published-comment/{id}',[
   'uses' => 'BlogController@publishedComment',
    'as'  => 'published-comment'
]);
Route::get('/unpublished-comment/{id}',[
   'uses' => 'BlogController@unpublishedComment',
    'as'  => 'unpublished-comment'
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
