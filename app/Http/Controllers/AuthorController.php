<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = User::with('profile')->findOrFail($id);

        $articles = $author->articles()
            ->published()
            ->latestPublished()
            ->paginate(12);

        return view('author', compact('author', 'articles'));
    }
}
