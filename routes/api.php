<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\PortfolioCategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BlogCategoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\AdminNotificationController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('services', [ServiceController::class, 'index']);
Route::get('services/{slug}', [ServiceController::class, 'show']);

Route::get('portfolios', [PortfolioController::class, 'index']);
Route::get('portfolios/{slug}', [PortfolioController::class, 'show']);

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{slug}', [PostController::class, 'show']);

Route::get('testimonials', [TestimonialController::class, 'index']);
Route::get('faqs', [FaqController::class, 'index']);

    Route::post('contact', [LeadController::class, 'store']);
    Route::post('leads/{id}/convert-order', [LeadController::class, 'convertToOrder']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::get('client/projects', [ProjectController::class, 'clientProjects']);

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('services', ServiceController::class)
            ->except(['index', 'show'])
            ->scoped(['service' => 'slug']);
        Route::apiResource('portfolios', PortfolioController::class)
            ->except(['index', 'show'])
            ->scoped(['portfolio' => 'slug']);
        Route::apiResource('posts', PostController::class)
            ->except(['index', 'show'])
            ->scoped(['post' => 'slug']);
        Route::apiResource('testimonials', TestimonialController::class)->except(['index', 'show']);
        Route::apiResource('faqs', FaqController::class)->except(['index']);
        Route::apiResource('leads', LeadController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('orders', OrderController::class);
        Route::post('orders/{order}/payments', [PaymentController::class, 'store']);
        Route::put('orders/{order}/payments/{payment}', [PaymentController::class, 'update']);
        Route::delete('orders/{order}/payments/{payment}', [PaymentController::class, 'destroy']);
        Route::apiResource('blog-categories', BlogCategoryController::class)->except(['show']);
        Route::apiResource('portfolio-categories', PortfolioCategoryController::class)->except(['show']);
        Route::get('settings', [SettingController::class, 'show']);
        Route::put('settings', [SettingController::class, 'update']);
        Route::get('activity-log', [ActivityLogController::class, 'index']);
        Route::get('notifications', [AdminNotificationController::class, 'index']);
        Route::post('notifications/{notification}/read', [AdminNotificationController::class, 'markRead']);
        Route::apiResource('admin-users', AdminUserController::class)->except(['show']);
        Route::apiResource('clients', ClientController::class)->except(['show']);
    });
});
