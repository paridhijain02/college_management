<?php

Route::get('/','ProjectController@welcome')->name('register.welcome');

Route::get('/studentLogin','StudentController@studentLogin')->name('register.studentLogin');
Route::post('/studentLoginPost','StudentController@studentPostLogin');

Route::get('/teacherLogin','TeacherController@teacherLogin')->name('register.teacherLogin');
Route::post('/teacherLoginPost','TeacherController@teacherPosteacherLogin');

Route::get('/adminLogin','AdminController@adminLogin')->name('register.adminLogin');
Route::post('/adminLoginPost','AdminController@adminPosteacherLogin');

Route::get('/studentSignup','StudentController@studentRegistered')->name('sregister.signup');
Route::post('/studentSignupPost','StudentController@studentStore');

Route::get('/teacherSignup','TeacherController@teacherRegistered')->name('tregister.signup');
Route::post('/teacherSignupPost','TeacherController@teacherStore');

Route::get('/notExist','ProjectController@notExist');
Route::get('/notLoggedIn','ProjectController@notLoggedIn');

Route::group(['middleware'=>'stu_guard'],function()
{
    Route::get('/studentProfile', 'StudentController@studentProfile');
    Route::get('/studentProfile/assignmentWrite/{id}','StudentController@assignmentWrite');
    Route::get('/studentAssignmentView','TeacherController@studentAssignmentToTeacher');
});

Route::group(['middleware'=>'tea_guard'],function()
{
    Route::get('/teacherProfile', 'TeacherController@teacherProfile');
    Route::get('/teacherProfile/studentEdit/{id}','TeacherController@studentEdit');
    Route::get('/teacherProfile/teacherEdit/{id}','TeacherController@teacherEdit');
    Route::get('/createAssignment','TeacherController@createNewAssignment');
    Route::get('/myAssignments','TeacherController@teacherMyAsssignment');
    Route::get('/assignmentstudentDelete/{id}','TeacherController@assignmentDelete');
});

Route::group(['middleware'=>'adm_guard'],function()
{
    Route::get('/adminProfile', 'AdminController@adminProfile');
    Route::get('/adminProfile/studentEdit/{id}','AdminController@studentEditbyadmin');
    Route::get('/adminProfile/teacherEdit/{id}','AdminController@teacherEditbyadmin');
});

Route::delete('/teacherProfile/studentDelete/{id}','TeacherController@studentDelete');
Route::put('/teacherProfile/studentUpdate/{id}','TeacherController@studentUpdate');

Route::delete('/teacherProfile/teacherDelete/{id}','TeacherController@teacherDelete');
Route::put('/teacherProfile/teacherUpdate/{id}','TeacherController@teacherUpdate');

Route::delete('/adminProfile/studentDelete/{id}','AdminController@studentDeletebyadmin');
Route::put('/adminProfile/studentUpdate/{id}','AdminController@studentUpdatebyadmin');

Route::delete('/adminProfile/teacherDelete/{id}','AdminController@teacherDeletebyadmin');
Route::put('/adminProfile/teacherUpdate/{id}','AdminController@teacherUpdatebyadmin');

Route::post('/createAssignment','TeacherController@createNewAssignmentPost');
Route::post('/studentProfile/assignmentWritePost/{id}','StudentController@assignmentWritePost');

Route::get('/studentLogout','StudentController@studentLogout');
Route::get('/teacherLogout','TeacherController@teacherlogout');
Route::get('/adminLogout','AdminController@adminlogout');

