<?php

Route::get('/', 'DashboardController@index');

# People
Route::get('people/orphans', 'PeopleController@orphans');
Route::post('people/{id}/attach-to-family', 'PeopleController@attachToFamily');
Route::resource('people', 'PeopleController');

# Family
Route::get('/families/available-positions', 'FamiliesController@availablePositions');
Route::post('/families/potential-mothers', 'FamiliesController@potentialMothers');
Route::get('families/empty', 'FamiliesController@empty');
Route::resource('families', 'FamiliesController');

Route::auth();

