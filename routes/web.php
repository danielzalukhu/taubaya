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
// DASHBOARD
Route::get('/', 'DashboardController@index')->middleware('auth')->name('dashboard.index');

// STUDENT
Route::get('achievement/chart', 'StudentController@returnDataAchievementChart')->middleware('auth')->name('student.achievementChart');
Route::get('/student/{id}/profile', 'StudentController@profile')->middleware('auth')->name('student.profile');
Route::get('/student/detailabsent' , 'StudentController@showDetailAbsent')->middleware('auth')->name('student.detailAbsent');
Route::resource('student', 'StudentController')->middleware('auth');
Route::post('student', 'ImportController@importStudent')->name('student.importStudent');

// ACHIEVEMENT & ACHIEVEMENT RECORD
Route::resource('achievement', 'AchievementController')->middleware('auth');
Route::resource('achievementrecord', 'AchievementRecordController')->middleware('auth');
Route::get('ar/academicyear', 'AchievementRecordController@ajaxChangeAchievementRecord')->middleware('auth')->name('achievement.academicYearAjax');

// VIOLATION & VIOLATION RECORD
Route::resource('violation', 'ViolationController')->middleware('auth');
Route::resource('violationrecord', 'ViolationRecordController')->middleware('auth');
Route::get('vr/academicyear', 'ViolationRecordController@ajaxChangeViolationRecord')->middleware('auth')->name('violationrecord.academicYearAjax');

// ABSENT
Route::get('absent/academicyear', 'AbsentController@ajaxChangeAbsentRecord')->middleware('auth')->name('absent.academicYearAjax');
Route::resource('absent', 'AbsentController')->middleware('auth');

// SUBJECT (INCOMPLETE, ASSESMENT)
Route::get('incomplete', 'SubjectController@incomplete')->middleware('auth')->name('subject.incomplete');
Route::post('incomplete', 'SubjectController@storeIncomplete')->name('subject.storeIncomplete');
Route::get('incomplete/{id}/edit', 'SubjectController@editIncomplete')->name('subject.editIncomplete');
Route::post('incomplete/{id}/update', 'SubjectController@updateIncomplete')->name('subject.updateIncomplete');
Route::get('incomplete{id}/delete', 'SubjectController@destroyIncomplete')->name('subject.destroyIncomplete');

Route::get('assesment', 'SubjectController@assesmentimport')->middleware('auth')->name('subject.assesment');
Route::post('assesment', 'ImportController@importAssesment')->name('subject.importAssesment');

Route::resource('subject', 'SubjectController')->middleware('auth');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
