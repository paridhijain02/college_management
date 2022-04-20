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
Route::get('/','ProjectController@welcome')->name('register.welcome');

Route::get('/slogin','ProjectController@studentLogin')->name('register.slogin');
Route::post('/slogin','ProjectController@studentPostLogin');

Route::get('/tlogin','ProjectController@teacherLogin')->name('register.tlogin');
Route::post('/tlogin','ProjectController@teacherPostLogin');

Route::get('/alogin','ProjectController@adminLogin')->name('register.alogin');
Route::post('/alogin','ProjectController@adminPostLogin');

Route::get('/ssignup','ProjectController@studentRegistered')->name('sregister.signup');
Route::post('/ssignups','ProjectController@studentStore');

Route::get('/tsignup','ProjectController@teacherRegistered')->name('tregister.signup');
Route::post('/tsignups','ProjectController@teacherStore');

Route::get('/sview','ProjectController@studentView')->name('student.view');
Route::get('/tview','ProjectController@teacherView')->name('teacher.view');

Route::get('/notexist','ProjectController@notExist');
Route::get('/notloggedin','ProjectController@notLoggedIn');

Route::group(['middleware'=>'stu_guard'],function()
{
    Route::any('/sprofilee', 'ProjectController@studentProfile');
    Route::get('/sprofilee/assignment_write/{id}','ProjectController@assignmentWrite');
    Route::get('/student_assignment_view','ProjectController@studentAssignmentToTeacher');
});

Route::group(['middleware'=>'tea_guard'],function()
{
    Route::any('/tprofilee', 'ProjectController@teacherProfile');
    Route::get('/tprofilee/s_edit/{id}','ProjectController@studentEdit');
    Route::get('/tprofilee/t_edit/{id}','ProjectController@teacherEdit');
    Route::get('/create_assignment','ProjectController@createNewAssignment');
    Route::get('/my_assignments','ProjectController@teacherMyAsssignment');
    Route::get('/assignments_delete/{id}','ProjectController@assignmentDelete');
});

Route::group(['middleware'=>'adm_guard'],function()
{
    Route::any('/aprofilee', 'ProjectController@adminProfile');
    Route::get('/aprofilee/s_edit/{id}','ProjectController@studentEditbyadmin');
    Route::get('/aprofilee/t_edit/{id}','ProjectController@teacherEditbyadmin');
});

Route::get('/tprofilee/s_delete/{id}','ProjectController@studentDelete');
Route::post('/tprofilee/s_update/{id}','ProjectController@studentUpdate');

Route::get('/tprofilee/t_delete/{id}','ProjectController@teacherDelete');
Route::post('/tprofilee/t_update/{id}','ProjectController@teacherUpdate');

Route::get('/aprofilee/s_delete/{id}','ProjectController@studentDeletebyadmin');
Route::post('/aprofilee/s_update/{id}','ProjectController@studentUpdatebyadmin');

Route::get('/aprofilee/t_delete/{id}','ProjectController@teacherDeletebyadmin');
Route::post('/aprofilee/t_update/{id}','ProjectController@teacherUpdatebyadmin');

Route::post('/create_assignment','ProjectController@createNewAssignmentPost');
Route::post('/sprofilee/assignment_write_post/{id}','ProjectController@assignmentWritePost');

Route::get('/slogout','ProjectController@studentlogout');
Route::get('/tlogout','ProjectController@teacherlogout');
Route::get('/alogout','ProjectController@adminlogout');