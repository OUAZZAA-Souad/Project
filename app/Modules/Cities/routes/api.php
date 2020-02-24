<?php

Route::group(['prefix' => 'api','module' => 'Cities', 'middleware' => ['api'], 'namespace' => 'App\Modules\Cities\Controllers'], function() {

    Route::post('/cities', 'CitiesController@create');
    Route::post('/cities/{id_city}/delivery-times', 'CitiesController@attach');
    Route::post('/cities/{id_city}/holiday', 'CitiesController@holiday');
    Route::get('/cities/{city_id}/delivery-dates-times/{number_of_days}', 'CitiesController@get');

     
});
