<?php

use Illuminate\Support\Facades\Response;

Route::get('api/{path?}', function ($path = null) {
    return Response::json(['status' => 'OK']);
})->where('path', '.*');
