<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;

class StreamPageController extends Controller
{
    public function __invoke(): View
    {
        $comments = Comment::with('user')->latest()->get();

        if ($comments->isNotEmpty()) {
            session(['last_comment_read' => $comments->first()->id]);
        }

        return view('stream', ['comments' => $comments]);
    }
}
