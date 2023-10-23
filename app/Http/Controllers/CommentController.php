<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;
use App\Service\CommentService;

class CommentController extends Controller
{

    public function __construct(
        private readonly CommentService $commentService
    )
    {
    }

    public function index()
    {
        $comments = $this->commentService->getAllComments();
        return view('comments.index', ['comments' => $comments]);
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $this->commentService->storeOrReply($data);
        return redirect()->route('comments.store')->with('success', 'Comment posted successfully');
    }

    public function reply(StoreCommentRequest $request, int $parent_id)
    {
        $data = $request->validated();
        if($this->commentService->getCommentById($parent_id)) {
            $this->commentService->storeOrReply($data, $parent_id);
        }
        return redirect()->route('comments.index');
    }


    public function update(UpdateCommentRequest $request, int $id)
    {
        $data = $request->validated();
        if($this->commentService->getCommentById($id)){
            $this->commentService->update($id, $data);
        }
        return redirect()->route('comments.index');
    }

    public function destroy(int $id)
    {
        if($this->commentService->getCommentById($id)){
            $this->commentService->delete($id);
        }
        return redirect()->route('comments.index');
    }

}
