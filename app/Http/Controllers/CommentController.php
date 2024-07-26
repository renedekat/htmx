<?php

namespace App\Http\Controllers;

use App\Events\CommentSent;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('user')
            ->where('id', '>', session('last_comment_read', 0))
            ->latest()
            ->get();

        if ($comments->isEmpty()) {
            return response()->noContent();
        }

        session(['last_comment_read' => $comments->first()->id]);

        return view('stream', ['comments' => $comments])->fragment('comments');
}

    public function store(Request $request)
    {
        $validated = $request->validate(['text' => 'string|required']);
        $request->user()->comments()->create($validated);
        event(new CommentSent);

        if ($request->hasHeader(key: 'hx-request')) {
            return view(view: 'stream')->fragment(fragment: 'comment-form');
        }

        return back();
    }
}
