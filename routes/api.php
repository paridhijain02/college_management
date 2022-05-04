<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/studentView','ApiController@studentView')->name('student.view');
Route::get('/teacherView','ApiController@teacherView')->name('teacher.view');

Route::get('/allPeopleView','ApiController@allView')->name('all.view');

