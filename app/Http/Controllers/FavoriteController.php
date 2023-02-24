<?php

namespace App\Http\Controllers;

use App\Http\Resources\TitleResource;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;

        $user = User::with('favorites')->findOrFail($user_id);

        return TitleResource::collection($user->favorites);
    }

    public function store($title_id): JsonResponse
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        $title = Title::findOrFail($title_id);

        if ($user->hasFavoriteTitle($title_id)) {
            return response()->Json([
                'message' => 'you already have this title on your favorite list',
            ]);
        }

        $user->favorites()->attach($title_id);

        return response()->Json([
            'status' => 'success',
            'message' => $title->name . ' was successfuly added to ' . $user->username . 'favorite list',
        ], 201);
    }

    public function delete($title_id)
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        $title = Title::findOrFail($title_id);

        if (!$user->hasFavoriteTitle($title_id)) {
            return response()->Json([
                'message' => 'you do not have this title on your favorite list',
            ]);
        }

        $user->favorites()->detach($title_id);

        return response()->Json([
            'status' => 'success',
            'message' => $title->name . ' was successfuly removed from ' . $user->username . 'favorite list',
        ], 201);
    }
}
