<?php

Route::group(['prefix' => 'api','module' => 'DeliveryTimes', 'middleware' => ['api'], 'namespace' => 'App\Modules\DeliveryTimes\Controllers'], function() {

    Route::post('/delivery-times', 'DeliveryTimesController@create');

});
