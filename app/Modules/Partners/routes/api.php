<?php

Route::group(['module' => 'Partners', 'middleware' => ['api'], 'namespace' => 'App\Modules\Partners\Controllers'], function() {

    Route::resource('Partners', 'PartnersController');

});
