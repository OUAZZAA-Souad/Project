<?php

Route::group(['module' => 'Partners', 'middleware' => ['web'], 'namespace' => 'App\Modules\Partners\Controllers'], function() {

    Route::resource('Partners', 'PartnersController');

});
