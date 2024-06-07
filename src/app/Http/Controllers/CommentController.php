<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Models\DefaultComment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show(Item $item)
    {
        $item->getDetailItem();

        $item->favorites_count = $item->favorites()->count();

        $comments = Comment::where('item_id', $item->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $item->comments_count = $comments->count();

        $defaultComments = DefaultComment::all();

        return view('comment', compact('item', 'comments', 'defaultComments'));
    }
    public function store(CommentRequest $request, Item $item)
    {
        $comment = [
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'comment' => $request->input('comment'),
        ];
        Comment::create($comment);
        return redirect()->back();
    }
    public function destroy(Item $item)
    {
        Comment::where('user_id', Auth::id())->where('item_id', $item->id)->delete();
        return redirect()->back();
    }
}
