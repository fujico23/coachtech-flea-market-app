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

        $defaultComments = DefaultComment::where('user_id', Auth::id())
            ->orWhere('user_id', null)
            ->get();


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
    public function destroy(Comment $comment)
    {
        Comment::where('id', $comment->id)->delete();
        return redirect()->back();
    }

    public function addDefaultComment(Request $request)
    {
        DefaultComment::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'あなた専用のコメントが追加されました!');
    }

    public function updateDefaultComment(Request $request, DefaultComment $defaultComment)
    {
        $defaultComment->update([
            'title' => $request->input('title'),
            'comment' => $request->input('comment'),
        ]);
        return redirect()->back()->with('success', 'あなた専用のコメントが更新されました!');
    }
}
