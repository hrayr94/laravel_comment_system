<?php

namespace App\Service;

use App\Models\Comment;

class CommentService
{

    public function getAllComments(): object
    {
        return Comment::query()
            ->with('parent')
            ->withCount('parent as count')
            ->get();
    }

    public function storeOrReply(array $attributes, $parent_id = null)
    {
        Comment::query()->create([
            'content' => $attributes['content'],
            'parent_id' => $parent_id,
        ]);
    }

    public function getCommentByParentId(int $parentId): object|null
    {
        return Comment::query()->where('parent_id', $parentId)->first();
    }

    public function getCommentById(int $id): object|null
    {
        return Comment::query()->find($id);
    }

    public function update(int $id, array $attributes): bool
    {
        return Comment::query()->where('id', $id)->update($attributes);
    }

    public function delete(int $id): bool
    {
        return Comment::query()->where('id', $id)->delete();
    }

}
