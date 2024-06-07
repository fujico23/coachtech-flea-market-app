<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show(Item $item)
    {
        $item->getDetailItem();
        $item->favorites_count = $item->favorites()->count();
        $item->comments_count = $item->comments()->count();
        return view('comment', compact('item'));
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
