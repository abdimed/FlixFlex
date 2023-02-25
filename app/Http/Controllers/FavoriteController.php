<?php

namespace App\Http\Controllers;

use App\Http\Resources\TitleResource;
use App\Models\Title;
use App\Models\User;

class FavoriteController extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;

        $user = User::with('favorites')->findOrFail($user_id);

        return TitleResource::collection($user->favorites);
    }

    public function store(Title $title)
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        if ($user->favorites->contains($title)) {
            return response()->Json([
                'status' => 'fail',
                'message' => 'you already have this title on your favorite list',
            ]);
        }

        $user->favorites()->attach($title);

        return response()->Json([
            'status' => 'success',
            'message' => 'title  was successfuly added to ' . $user->username . 'favorite list',
        ], 201);
    }

    public function delete(Title $title)
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        if (!$user->favorites->contains($title)) {
            return response()->Json([
                'status' => 'fail',
                'message' => 'you do not have this title on your favorite list',
            ]);
        }

        $user->favorites()->detach($title);

        return response()->Json([
            'status' => 'success',
            'message' => 'title was successfuly removed from ' . $user->username . 'favorite list',
        ], 201);
    }
}
