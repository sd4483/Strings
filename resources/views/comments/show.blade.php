<!-- Comment Form -->
@auth
    <form id="comment-form" method="POST" action="{{ route('comments.store', $blog) }}">
        @csrf
        <textarea name="content" rows="3" required class="w-full rounded-md border border-gray-300"></textarea>
        <button type="submit" class="px-3 py-2 rounded-md text-white bg-blue-700 mt-2 mb-12">Submit Comment</button>
    </form>
@else
    <p><a href="{{ route('login') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4 rounded">
        Login or register to make a comment</a></p>
@endauth

<!-- Display Comments -->
<div id="comments-content">
    <p class="text-lg text-blue-700 font-bold pl-1 underline decoration-dotted">Comments</p>
    @foreach ($blog->comments as $comment)
        @include('comments.comment', ['comment' => $comment])
    @endforeach
</div>

<script>
    $(document).ready(function() {
        $('#comment-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    // Assuming the server returns the new comment HTML
                    $('#comments-content').prepend(response);

                    // Clear the textarea
                    $('#comment-form textarea[name="content"]').val('');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });
    });
</script>
