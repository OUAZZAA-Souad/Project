<?php

Route::group(['module' => 'Cities', 'middleware' => ['web'], 'namespace' => 'App\Modules\Cities\Controllers'], function() {

    Route::resource('Cities', 'CitiesController');

});
