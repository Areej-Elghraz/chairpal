<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RefreshTokenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResendOtpController;
use App\Http\Controllers\Auth\ResendVerificationCodeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\Socialite\ProviderCallbackController;
use App\Http\Controllers\Auth\Socialite\ProviderRedirectController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyOtpController;
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\UpdateDataController;
use App\Http\Controllers\ChatBot\MessageController;
use App\Enums\TokenAbilityEnum;
use Illuminate\Support\Facades\Route;

// authentication
Route::post('/signup', RegisterController::class)->name('auth.register');
Route::post('/login', LoginController::class)->name('auth.login');
Route::post('/refresh-token', RefreshTokenController::class)->name('auth.refresh-token')->middleware(['auth:sanctum', 'ability:' . TokenAbilityEnum::REMEMBER_TOKEN->value]);

Route::post('/support', [\App\Http\Controllers\SupportController::class, 'store'])->name('support.store');

Route::middleware(['auth:sanctum', 'ability:' . TokenAbilityEnum::ACCESS_TOKEN->value])->group(function () {
  // authentication
  Route::post('/logout', LogoutController::class)->name('auth.logout');
  Route::put('/profile/update', UpdateDataController::class)->name('auth.profile.updata_data');
  Route::put('/profile/change-password', ChangePasswordController::class)->name('auth.profile.change_password');
  Route::delete('/profile', [\App\Http\Controllers\Profile\DeleteAccountController::class, 'destroy'])->name('profile.destroy');
  Route::put('/profile/language', [\App\Http\Controllers\Profile\LanguageController::class, 'update'])->name('profile.language.update');
  Route::get('/profile/favorites', [\App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');

  // Categories
  Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);

  // Organization
  Route::apiResource('organizations', \App\Http\Controllers\OrganizationController::class);
  Route::post('/organizations/{organization}/reviews', [\App\Http\Controllers\ReviewController::class, 'storeOrganization'])->name('organizations.reviews.store');
  Route::post('/organizations/{organization}/favorite', [\App\Http\Controllers\FavoriteController::class, 'toggleOrganization'])->name('organizations.favorites.toggle');
  Route::post('/organizations/{organization}/visit', [\App\Http\Controllers\OrganizationController::class, 'visit'])->name('organizations.visit');

  // Places
  Route::apiResource('places', \App\Http\Controllers\PlaceController::class);
  Route::post('/places/{place}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
  Route::post('/places/{place}/favorite', [\App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
  Route::post('/places/{place}/visit', [\App\Http\Controllers\PlaceController::class, 'visit'])->name('places.visit');

  Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');

  // Locations
  Route::apiResource('countries', \App\Http\Controllers\CountryController::class);
  Route::apiResource('cities', \App\Http\Controllers\CityController::class);

  // Emergency Contacts & SOS
  Route::apiResource('emergency-contacts', \App\Http\Controllers\EmergencyContactController::class)->except(['show', 'update', 'edit', 'create']);
  Route::post('/sos', [\App\Http\Controllers\SosController::class, 'trigger'])->name('sos.trigger');
  Route::post('/sos/cancel', [\App\Http\Controllers\SosController::class, 'cancel'])->name('sos.cancel');

  // E-Chair
  Route::post('/echair/verify', [\App\Http\Controllers\EChairController::class, 'verify'])->name('echair.verify');
  Route::post('/echair/status', [\App\Http\Controllers\EChairController::class, 'status'])->name('echair.status');

  // Community
  Route::apiResource('posts', \App\Http\Controllers\Community\PostController::class)->except(['create', 'edit']);
  Route::post('/posts/{post}/share', [\App\Http\Controllers\Community\PostController::class, 'share'])->name('posts.share');
  Route::get('/posts/{post}/likes', [\App\Http\Controllers\Community\PostController::class, 'likes'])->name('posts.likes');
  Route::get('/posts/{post}/shares', [\App\Http\Controllers\Community\PostController::class, 'shares'])->name('posts.shares');
  Route::post('/posts/{post}/like', [\App\Http\Controllers\Community\LikeController::class, 'toggleLike'])->name('posts.like');
  Route::post('/posts/{post}/hide', [\App\Http\Controllers\Community\PostController::class, 'hide'])->name('posts.hide');
  Route::get('/community/users/{user}', [\App\Http\Controllers\Community\ProfileController::class, 'show'])->name('community.profile');

  // Comments CRUD and engagement
  Route::post('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'storePost'])->name('posts.comments.store');
  Route::get('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'indexPost'])->name('posts.comments.index');
  Route::put('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
  Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
  Route::post('/comments/{comment}/like', [\App\Http\Controllers\Community\LikeController::class, 'toggleCommentLike'])->name('comments.like');
  Route::get('/comments/{comment}/likes', [\App\Http\Controllers\CommentController::class, 'likes'])->name('comments.likes');

  // Chats
  Route::get('/chats', [\App\Http\Controllers\ChatController::class, 'index'])->name('chats.index');
  Route::get('/chats/{user}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chats.show');
  Route::post('/chats/{user}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chats.store');
  Route::delete('/chats/{user}', [\App\Http\Controllers\ChatController::class, 'destroy'])->name('chats.destroy');

  Route::put('/messages/{message}', [\App\Http\Controllers\ChatController::class, 'updateMessage'])->name('messages.update');
  Route::delete('/messages/{message}', [\App\Http\Controllers\ChatController::class, 'deleteMessage'])->name('messages.destroy');

  Route::get('/chatbot/sessions', [\App\Http\Controllers\ChatBot\MessageController::class, 'index'])->name('chatbot.sessions.index');
  Route::post('/chatbot/sessions', [\App\Http\Controllers\ChatBot\MessageController::class, 'storeSession'])->name('chatbot.sessions.store');
  Route::get('/chatbot/sessions/{session}', [\App\Http\Controllers\ChatBot\MessageController::class, 'showSession'])->name('chatbot.sessions.show');
  Route::delete('/chatbot/sessions/{session}', [\App\Http\Controllers\ChatBot\MessageController::class, 'destroySession'])->name('chatbot.sessions.destroy');
  
  Route::post('/chatbot/sessions/{session}/chat', [\App\Http\Controllers\ChatBot\MessageController::class, 'chat'])->name('chatbot.chat');
  Route::post('/chatbot/messages/{message}/reaction', [\App\Http\Controllers\ChatBot\MessageController::class, 'reactToMessage'])->name('chatbot.messages.reaction');

  // AI / HW Communication
  Route::apiResource('trips', \App\Http\Controllers\TripController::class);
  Route::post('/trips/{trip}/updates', [\App\Http\Controllers\TripController::class, 'addUpdate'])->name('trips.updates.add');

  Route::prefix('ai-hw')->group(function () {
    Route::post('/telemetry', [\App\Http\Controllers\AIHWCommunicationController::class, 'telemetry'])->name('ai-hw.telemetry');
    Route::post('/events', [\App\Http\Controllers\AIHWCommunicationController::class, 'events'])->name('ai-hw.events');
    Route::post('/ai-logs', [\App\Http\Controllers\AIHWCommunicationController::class, 'aiLogs'])->name('ai-hw.ai-logs');
    Route::post('/device-status', [\App\Http\Controllers\AIHWCommunicationController::class, 'deviceStatus'])->name('ai-hw.device-status');
    Route::post('/obstacle-logs', [\App\Http\Controllers\AIHWCommunicationController::class, 'obstacleLogs'])->name('ai-hw.obstacle-logs');
    Route::post('/health-telemetry', [\App\Http\Controllers\AIHWCommunicationController::class, 'healthTelemetry'])->name('ai-hw.health-telemetry');
    Route::post('/health-predictions', [\App\Http\Controllers\AIHWCommunicationController::class, 'healthPredictions'])->name('ai-hw.health-predictions');
    Route::post('/emergency', [\App\Http\Controllers\AIHWCommunicationController::class, 'emergency'])->name('ai-hw.emergency');
  });
});

