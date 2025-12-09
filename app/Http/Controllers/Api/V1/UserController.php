<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get the authenticated user's profile.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'credit' => (float) $user->credit,
                'email_verified_at' => $user->email_verified_at?->toISOString(),
                'two_factor_enabled' => (bool) $user->two_factor_confirmed_at,
                'created_at' => $user->created_at->toISOString(),
            ],
        ]);
    }

    /**
     * Get the authenticated user's credit balance.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function credit(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'credit' => (float) $user->credit,
                'formatted_credit' => number_format($user->credit, 2),
            ],
        ]);
    }
}
