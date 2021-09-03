<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Igd_infoController;
use App\Http\Controllers\Cate_igdController;

use App\Http\Controllers\FoodController;
use App\Http\Controllers\Cate_foodController;
use App\Http\Controllers\UserHomeController;

use App\Http\Controllers\UserNutritionController;

use App\Http\Controllers\FoodRatingController;

Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('checklogin', [LoginController::class, 'login'])->name('checklogin');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('createregister', [RegisterController::class, 'register'])->name('createregister');

    Route::get('/admin/register', [RegisterController::class, 'admin_from'])->name('admin_register');
    Route::post('/admin/createregister', [RegisterController::class, 'admin_register'])->name('admin_createregister');
});

Route::group(['middleware' => ['isAdmin', 'auth']], function () {

    Route::get('/igd-info/index', [Igd_infoController::class, 'index'])->name('admin_index');
    Route::get('/igd-info/create', [Igd_infoController::class, 'show_addIgd_info']);
    Route::post('/igd-info/add', [Igd_infoController::class, 'addIgd_info']);
    Route::get('/igd-info/edit/{id}', [Igd_infoController::class, 'show_editIgd_info']);
    Route::post('/igd-info/update', [Igd_infoController::class, 'editIgd_info']);
    Route::get('/igd-info/search/', [Igd_infoController::class, 'search']);

    Route::get('/igd-info/cate/index', [Cate_igdController::class, 'show_Igd_info_cate']);
    Route::get('/igd-info/cate/create', [Cate_igdController::class, 'show_addIgd_info_cate']);
    Route::post('/igd-info/cate/add', [Cate_igdController::class, 'addIgd_info_cate']);
    Route::get('/igd-info/cate/edit/{id}', [Cate_igdController::class, 'show_editIgd_info_cate']);
    Route::post('/igd-info/cate/update', [Cate_igdController::class, 'editIgd_info_cate']);
    Route::post('/igd-info/cate/delete/{id}', [Cate_igdController::class, 'desIgd_info_cate']);


    Route::get('/food/index', [FoodController::class, 'index'])->name('admin_index2');
    Route::get('/food/create', [FoodController::class, 'show_addFood']);
    Route::post('/food/add', [FoodController::class, 'addFood']);
    Route::get('/food/search/', [FoodController::class, 'search']);
    Route::get('/food/show/{id}', [FoodController::class, 'show']);
    Route::get('/food/show/edit/{id}', [FoodController::class, 'show_editFood']);
    Route::post('/food/show/update', [FoodController::class, 'editFood']);
    Route::get('/food/show/create/igd/{id}', [FoodController::class, 'show_addigd']);
    Route::get('/food/search/igd', [FoodController::class, 'search_igd']);
    Route::post('/food/show/add/igd', [FoodController::class, 'addigd']);
    Route::post('/food/show/igd/delete/{id}', [FoodController::class, 'deIgd']);
    Route::get('/food/show/create/step/{id}', [FoodController::class, 'show_addstep']);
    Route::post('/food/show/add/step', [FoodController::class, 'addstep']);
    Route::post('/food/show/step/delete/{id}', [FoodController::class, 'deStep']);

    Route::get('/food/cate/index', [Cate_foodController::class, 'show_Food_cate']);
    Route::get('/food/cate/create', [Cate_foodController::class, 'show_addFood_cate']);
    Route::post('/food/cate/add', [Cate_foodController::class, 'addFood_cate']);
    Route::get('/food/cate/edit/{id}', [Cate_foodController::class, 'show_editFood_cate']);
    Route::post('/food/cate/update', [Cate_foodController::class, 'editFood_cate']);
    Route::post('/food/cate/delete/{id}', [Cate_foodController::class, 'desFood_cate']);

    Route::get('test-responsive', function () {
        return view('test-responsive');
    });
    Route::get('test', [FoodController::class, 'test']);
});

Route::get('/user/home', [UserHomeController::class, 'home'])->name('user_home');

// หน้าของข้อมูลส่วนตัว user
Route::get('/setting/profile/', function() {
    return view('Users.User_nutrition');
});

// add Data to MySqlAdmin
Route::post('/add_data_nutrition',[UserNutritionController::class, 'Edit_data']);



// Route::get('/menu_rating', function(){
//     return view('Users.Menu_rating');
// });

// menu rating
Route::get('/rating_menu',[FoodRatingController::class, 'show_food']); 
// add menu rating to page menu rating
// Route::post('/add_data_rating',[FoodRatingController::class, 'addfood_data']);
// search menu in menu totle
Route::get('/show_food_data',[FoodRatingController::class, 'search_food']);
// show menu rating add profile 
Route::get('/show_data_rating',[FoodRatingController::class, 'show_menu_rating']);



Route::get('/menu/rating/{id}',[FoodRatingController::class, 'show']);

Route::post('/ViewMenu_AddRating',[FoodRatingController::class, 'addfood_data']);

// Route::get('/test', function(){
//     return view('test');
// });