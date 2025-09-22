<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/dashboard', [AuthController::class, 'dashboard']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Events\ChatMessage;

Route::get('/test', function () {
    $message = 'Hello, WebSocket!';
    event(new ChatMessage($message)); // Broadcast the event

    return response()->json(['status' => 'Message broadcasted', 'response' => "ChatMessage Event Triggered with message: {$message}"]);
});

use App\Http\Controllers\OpenAIController;
use Illuminate\Support\Facades\Auth;

Route::post('/openai/chat', [OpenAIController::class, 'chat']);

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;

Route::get('/launch-chat/{token}/{id}', function ($token, $id) {
     try {
        $decrypted = Crypt::decryptString($token);
        [$userPart, $timestampPart] = explode('|', $decrypted);
        $userIdFromToken = explode(':', $userPart)[1];

        if ((int) $userIdFromToken !== (int) $id) {
            return response()->json(['error' => 'Token mismatch'], 403);
        }

        return redirect("https://chat.hillbcs.com/?chat={$token}&id={$id}");

    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid token'], 403);
    }
});


Route::post('/chat/permission', function (Request $request) {
    $token = $request->bearerToken();
    $id = $request->input('id');

    try {
        $decrypted = Crypt::decryptString($token);
        [$userPart, $timestampPart] = explode('|', $decrypted);
        $userIdFromToken = explode(':', $userPart)[1];

        if ((int) $userIdFromToken !== (int) $id) {
            return response()->json(['error' => 'Token/user mismatch'], 403);
        }

        $currentUser = App\Models\User::where('id', $id)->first();
        $contacts = App\Models\User::where('id', '<>', $id)->where('role', '<>', 'Sub-Client')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->profile_photo_path ? asset('storage/' . ltrim($user->profile_photo_path, '/')) : asset('user.png'),
                'status' => 'online', // or implement real presence logic
            ];
        })->values(); 

        return response()->json([
            'currentUser' => [
                'id' => $currentUser->id,
                'name' => $currentUser->name,
                'email' => $currentUser->email,
                'avatar' => $currentUser->profile_photo_path ? asset('storage/' . ltrim($currentUser->profile_photo_path, '/')) : asset('user.png'),
                'status' => 'online'
            ],
            'contacts' => $contacts
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid or expired token'], 403);
    }
});
