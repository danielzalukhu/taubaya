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

Route::group(['middleware' => 'auth'], function(){

    // DASHBOARD
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    
    // STUDENT
    Route::get('achievement/chart', 'StudentController@returnDataAchievementChart')->name('student.achievementChart');
    Route::get('violation/chart', 'StudentController@returnDataViolationChart')->name('student.violationChart');
    Route::get('absent/chart', 'StudentController@returnDataAbsentChart')->name('student.absentChart');

    Route::get('student/{id}/profile', 'StudentController@profile')->name('student.profile');
    Route::get('student/detailabsent' , 'StudentController@showDetailAbsent')->name('student.detailAbsent');
    Route::get('student/mapelku', 'StudentController@mapelku')->name('student.mapelku');
    Route::get('student/subject/{id}/{kodekelas}', 'StudentController@teacherGetStudentSubject')->name('subject.studentSubject');
    Route::get('student/subject/detail/{siswaid}/{mapelid}', 'StudentController@getStudentSubjectDetail')->name('subject.studentDetailSubject');

    Route::get('subject/detail/{id}', 'SubjectController@subjectDetail')->name('subject.detail');

    Route::get('vr/academicyear', 'ViolationRecordController@ajaxChangeViolationRecord')->name('violationrecord.academicYearAjax');
    Route::get('ar/academicyear', 'AchievementRecordController@ajaxChangeAchievementRecord')->name('achievement.academicYearAjax');
    Route::get('absent/academicyear', 'AbsentController@ajaxChangeAbsentRecord')->name('absent.academicYearAjax');

    Route::get('incompleteku', 'SubjectController@incompleteku')->name('subject.incompleteku');
    
    Route::get('extracurricular/ekskulku', 'ExtracurricularController@showEkskulKu')->name('extracurricular.ekskulKu');
});

Route::group(['middleware' => 'cekrole'], function(){

    // AJAX
    Route::get('vr/violation-item-by-category', 'AjaxController@showViolationItemByCategory')->name('violationrecord.violationItem');
    Route::get('vr/show-violation-record', 'AjaxController@getViolationRecord')->name('violationrecord.showViolationRecord');
    Route::get('vr/show-student-violation-detail', 'AjaxController@studentDetailViolation')->name('violationrecord.studentDetailViolation');

    Route::get('ar/achievement-item-by-grade', 'AjaxController@showAchievementItemByGrade')->name('achievementrecord.achievementItem');
    Route::get('ar/show-achievement-record', 'AjaxController@getAchievementRecord')->name('achievementrecord.showAchievementRecord');
    Route::get('ar/show-student-achievement-detail', 'AjaxController@studentDetailAchievement')->name('achievementrecord.studentDetailAchievement');

    Route::get('absent/show-absent-each-grade', 'AjaxController@absentEachGrade')->name('absent.absentEachGrade');
    Route::get('absent/show-detail-absent-each-type', 'AjaxController@detailAbsentEachType')->name('absent.detailAbsentEachType');

    Route::get('student/mapelguru', 'StudentController@mapelguru')->name('student.mapelguru');
    Route::resource('student', 'StudentController');

    // IMPORT
    Route::get('subject/assesment', 'SubjectController@assesmentImport')->name('subject.assesment');
    Route::get('subject/assesment/{id}/edit', 'SubjectController@editAssesment')->name('subject.editAssesment');
    Route::post('subject/assesment/{id}/update', 'SubjectController@updateAssesment')->name('subject.updateAssesment');
    Route::get('subject/assesment/{id}/delete', 'SubjectController@destroyAssesment')->name('subject.destroyAssesment');
    Route::get('subject/assesment/status', 'SubjectController@setStatus')->name('subject.setStatus');
    Route::post('student', 'ImportController@importStudent')->name('student.importStudent');
    Route::post('subject/assesment/import', 'ImportController@importAssesment')->name('subject.importAssesment');

    // ACHIEVEMENT & ACHIEVEMENT RECORD
    Route::resource('achievement', 'AchievementController');
    Route::resource('achievementrecord', 'AchievementRecordController');

    // VIOLATION & VIOLATION RECORD
    Route::resource('violation', 'ViolationController');
    Route::resource('violationrecord', 'ViolationRecordController');

    // ABSENT
    Route::resource('absent', 'AbsentController');

    // SUBJECT (INCOMPLETE, ASSESMENT)
    Route::get('incomplete', 'SubjectController@incomplete')->name('subject.incomplete');
    Route::get('incomplete/create', 'SubjectController@createIncomplete')->name('subject.createIncomplete');
    Route::post('incomplete', 'SubjectController@storeIncomplete')->name('subject.storeIncomplete');
    Route::get('incomplete/{id}/edit', 'SubjectController@editIncomplete')->name('subject.editIncomplete');
    Route::post('incomplete/{id}/update', 'SubjectController@updateIncomplete')->name('subject.updateIncomplete');
    Route::get('incomplete/{id}/delete', 'SubjectController@destroyIncomplete')->name('subject.destroyIncomplete');
    Route::resource('subject', 'SubjectController');

    // EXTRACURRICULER 
    Route::get('extracurricular/assesment', 'ExtracurricularController@ekskulAssesment')->name('extracurricular.assesment');
    Route::post('extracurricular/assesment/input', 'ExtracurricularController@storeAssesment')->name('extracurricular.storeAssesment');
    Route::get('extracurricular/assesment/edit/{id}', 'ExtracurricularController@editAssesment')->name('extracurricular.editAssesment');
    Route::put('extracurricular/assesment/update/{id}', 'ExtracurricularController@updateAssesment')->name('extracurricular.updateAssesment');
    Route::get('extracurricular/delete/{id}', 'ExtracurricularController@destroyAssesment')->name('extracurricular.destroyAssesment');
    Route::get('extracurricular/ekskul', 'ExtracurricularController@showEkskul')->name('extracurricular.ekskul');
    Route::resource('extracurricular', 'ExtracurricularController');
});

// AUTH
Auth::routes();
