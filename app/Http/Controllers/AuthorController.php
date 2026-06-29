<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = User::with('profile')->findOrFail($id);

        $articles = $author
            ->articles()
            ->published()
            ->with(['author', 'category', 'media'])
            ->latestPublished()
            ->paginate(12)
            ->withQueryString();

        return view('author', compact('author', 'articles'));
    }
}
