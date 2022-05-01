<?php

Route::get('/','ProjectController@welcome')->name('register.welcome');

Route::get('/studentLogin','StudentController@studentLogin')->name('register.studentLogin');
Route::post('/studentLogin','StudentController@studentPosteacherLogin');

Route::get('/teacherLogin','TeacherController@teacherLogin')->name('register.teacherLogin');
Route::post('/teacherLogin','TeacherController@teacherPosteacherLogin');

Route::get('/adminLogin','AdminController@adminLogin')->name('register.adminLogin');
Route::post('/adminLogin','AdminController@adminPosteacherLogin');

Route::get('/studentSignup','StudentController@studentRegistered')->name('sregister.signup');
Route::post('/studentSignups','StudentController@studentStore');

Route::get('/teacherSignup','TeacherController@teacherRegistered')->name('tregister.signup');
Route::post('/teacherSignups','TeacherController@teacherStore');

Route::get('/notexist','ProjectController@notExist');
Route::get('/notloggedin','ProjectController@notLoggedIn');

Route::group(['middleware'=>'stu_guard'],function()
{
    Route::any('/studentProfile', 'StudentController@studentProfile');
    Route::get('/studentProfile/assignment_write/{id}','StudentController@assignmentWrite');
    Route::get('/student_assignment_view','TeacherController@studentAssignmentToTeacher');
});

Route::group(['middleware'=>'tea_guard'],function()
{
    Route::any('/teacherProfile', 'TeacherController@teacherProfile');
    Route::patch('/teacherProfile/studentEdit/{id}','TeacherController@studentEdit');
    Route::patch('/teacherProfile/teacherEdit/{id}','TeacherController@teacherEdit');
    Route::get('/create_assignment','TeacherController@createNewAssignment');
    Route::get('/my_assignments','TeacherController@teacherMyAsssignment');
    Route::get('/assignmentstudentDelete/{id}','TeacherController@assignmentDelete');
});

Route::group(['middleware'=>'adm_guard'],function()
{
    Route::any('/adminProfile', 'AdminController@adminProfile');
    Route::get('/adminProfile/studentEdit/{id}','AdminController@studentEditbyadmin');
    Route::get('/adminProfile/teacherEdit/{id}','AdminController@teacherEditbyadmin');
});

//Route::get('/teacherProfile/studentDelete/{id}','TeacherController@studentDelete');
Route::delete('/teacherProfile/studentDelete/{id}','TeacherController@studentDelete');
Route::post('/teacherProfile/studentUpdate/{id}','TeacherController@studentUpdate');

Route::delete('/teacherProfile/teacherDelete/{id}','TeacherController@teacherDelete');
Route::post('/teacherProfile/teacherUpdate/{id}','TeacherController@teacherUpdate');

Route::delete('/adminProfile/studentDelete/{id}','AdminController@studentDeletebyadmin');
Route::post('/adminProfile/studentUpdate/{id}','AdminController@studentUpdatebyadmin');

Route::delete('/adminProfile/teacherDelete/{id}','AdminController@teacherDeletebyadmin');
Route::post('/adminProfile/teacherUpdate/{id}','AdminController@teacherUpdatebyadmin');

Route::post('/create_assignment','TeacherController@createNewAssignmentPost');
Route::post('/studentProfile/assignment_write_post/{id}','StudentController@assignmentWritePost');

Route::get('/studentLogout','StudentController@studentLogout');
Route::get('/teacherLogout','TeacherController@teacherlogout');
Route::get('/adminLogout','AdminController@adminlogout');