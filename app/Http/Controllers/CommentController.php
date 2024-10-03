<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store($user_id,$post_id)
    {
        request()->validate([
            'content_of_comment'=>['required','min:5']
        ]);
        Comment::create([
            'content'=>request()->content_of_comment,
            'user_id'=>$user_id,
            'post_id'=>$post_id
        ]);
        return to_route('posts.show',[$user_id,$post_id]);
    }

    public function update($comment_id)
    {
        $edited_content = request()->edited_content;
        request()-> validate([
            'edited_content' => ['required','min:5'],
        ]); 
        $singleCommentFromDb = Comment::find($comment_id);
        $singleCommentFromDb->update([
            'content'=>$edited_content
        ]);
        // dd($singleCommentFromDb->post);
        return to_route('posts.show',[$singleCommentFromDb->user_id,$singleCommentFromDb->post]);
    }

    public function destroy($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment-> delete();
        return to_route('posts.show',[$comment->user_id,$comment->post]);
    }
}
