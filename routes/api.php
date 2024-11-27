<?php

use App\Http\Controllers\EmailLogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WebsiteController;
use App\Mail\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::apiResource('websites', WebsiteController::class);
Route::apiResource('posts', PostController::class)->except(['store']);
Route::post('websites/{websiteId}/posts', [PostController::class, 'store']);
Route::apiResource('subscriptions', SubscriptionController::class)->except(['store', 'update']);
Route::post('websites/{websiteId}/subscriptions', [SubscriptionController::class, 'store']);
Route::apiResource('email-logs', EmailLogController::class);

Route::get('/preview-email', function () {
    $post = (object)[
        'title' => 'Exciting News!',
        'description' => 'We just published a new post on our blog.',
        'website' => 'google.com'
    ];

    return new PostNotification($post);
});