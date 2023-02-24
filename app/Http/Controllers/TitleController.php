<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TitleResource;
use App\Models\Title;

use function PHPUnit\Framework\isEmpty;

class TitleController extends Controller
{
    public function index()
    {
        return  TitleResource::collection(Title::paginate(10));
    }

    public function show(Title $title)
    {
        return TitleResource::make($title);
    }

    public function search(Request $request)
    {
        $request->validate(['name' => 'required']);

        $titles = TitleResource::collection(Title::where('name', 'LIKE', '%' . $request->name . '%')->paginate(10));

        $titles->isEmpty() ? $response = response()->json(['message' => 'no records found']) : $response = $titles;

        return $response;
    }
}
