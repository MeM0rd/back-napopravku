<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        $tags = Tag::all();

        return response()->json($tags);
    }
}
