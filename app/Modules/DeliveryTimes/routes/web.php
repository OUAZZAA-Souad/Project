<?php

Route::group(['module' => 'DeliveryTimes', 'middleware' => ['web'], 'namespace' => 'App\Modules\DeliveryTimes\Controllers'], function() {

    Route::resource('DeliveryTimes', 'DeliveryTimesController');

});
