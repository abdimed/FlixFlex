<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($title_id): JsonResponse
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        $title = Title::findOrFail($title_id);

        if ($user->favorites->contains($title_id)) {
            return response()->Json([
                'status' => 'fail',
                'message' => 'you already have this title on your favorite list',
            ]);
        }

        $user->favorites()->attach($title_id);

        return response()->Json([
            'status' => 'success',
            'message' => $title->name . ' was successfuly added to ' . $user->username . 'favorite list',
        ], 201);
    }
}
