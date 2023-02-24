<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\TitleCollection;
use Illuminate\Http\Request;
use App\Http\Resources\TitleResource;
use App\Models\Title;


class TitleController extends Controller
{
    public function index()
    {
        return TitleCollection::make(Title::paginate(10));
    }

    public function show(Title $title)
    {
        return TitleResource::make($title);
    }

    public function search(SearchRequest $request)
    {
        return TitleResource::collection(Title::where('name', 'LIKE', "%$request->keyword%")->paginate(10));
    }

    public function trailer(Title $title)
    {
        return TitleResource::make($title);
    }
}
