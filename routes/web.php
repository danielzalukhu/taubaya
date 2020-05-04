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
Route::get('violation/chart', 'StudentController@returnDataViolationChart')->middleware('auth')->name('student.violationChart');
Route::get('student/{id}/profile', 'StudentController@profile')->middleware('auth')->name('student.profile');
Route::get('student/detailabsent' , 'StudentController@showDetailAbsent')->middleware('auth')->name('student.detailAbsent');
Route::get('student/mapelku', 'StudentController@mapelku')->middleware('auth')->name('student.mapelku');
Route::resource('student', 'StudentController')->middleware('auth');

// IMPORT
Route::get('subject/assesment', 'SubjectController@assesmentImport')->middleware('auth')->name('subject.assesment');
Route::post('student', 'ImportController@importStudent')->name('student.importStudent');
Route::post('subject/assesment/import', 'ImportController@importAssesment')->middleware('auth')->name('subject.importAssesment');

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
Route::get('incomplete/{id}/delete', 'SubjectController@destroyIncomplete')->name('subject.destroyIncomplete');
Route::resource('subject', 'SubjectController')->middleware('auth');

// EXTRACURRICULER 
Route::get('extracurricular/assesment', 'ExtracurricularController@ekskulAssesment')->middleware('auth')->name('extracurricular.assesment');
Route::post('extracurricular/assesment/input', 'ExtracurricularController@storeAssesment')->middleware('auth')->name('extracurricular.storeAssesment');
Route::get('extracurricular/assesment/edit/{id}', 'ExtracurricularController@editAssesment')->middleware('auth')->name('extracurricular.editAssesment');
Route::put('extracurricular/assesment/update/{id}', 'ExtracurricularController@updateAssesment')->middleware('auth')->name('extracurricular.updateAssesment');
Route::get('extracurricular/delete/{id}', 'ExtracurricularController@destroyAssesment')->middleware('auth')->name('extracurricular.destroyAssesment');
Route::resource('extracurricular', 'ExtracurricularController')->middleware('auth');

// AUTH
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
