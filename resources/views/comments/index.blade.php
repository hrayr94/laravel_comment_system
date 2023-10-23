@if ($errors->any())
    <div style="background-color: #ff6b6b; color: #fff; padding: 10px; border-radius: 5px;" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div style="background-color: #28a745; color: #fff; padding: 10px; border-radius: 5px;" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="comment-form">
    <form method="post" action="{{ route('comments.store') }}">
        @csrf
        <textarea name="content" placeholder="Leave a comment" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" rows="4" cols="50"></textarea>
        <br>
        <input type="submit" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" value="Leave Comment">
    </form>
</div>

<p>Comments</p>
@foreach ($comments as $comment)
    <div class="comment" style="border: 3px solid #007bff;">
        <p>{{ $comment->content }}</p>
        <div>
            <span>{{ $comment->count }} Comments</span><br><br>
            <div>
                @foreach ($comment->parent as $i => $value)
                    {{ $i + 1 }}.{{ $value->content }}<br>
                @endforeach
            </div>
            <!-- Add a reply form for this comment -->
            <div class="reply-form">
                <form method="post" action="{{ route('comments.reply', ['id' => $comment->id]) }}">
                    @csrf
                    <textarea name="content" placeholder="Reply to this comment" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" rows="3" cols="50"></textarea>
                    <br>
                    <input type="submit" style="background-color: #007bff; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;" value="Leave Comment">
                </form>
            </div>
        </div>
    </div>
    <br>
@endforeach
