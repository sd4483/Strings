<div class="my-4 border border-gray-300 bg-white rounded-md">
    <div class="pl-4 pt-4 text-base rounded-t">
        <strong>{{ $comment->user->name }}</strong>
    </div>
    <p class="p-4 text-sm">{{ $comment->content }}</p>

    <div class="text-right pb-4 pr-4">
        @auth
            <form method="POST" class="like-form inline-block" action="{{ route('comments.like', $comment) }}">
                @csrf
                <button type="submit" class="border border-black bg-blue-200 rounded-md text-sm inline-flex">
                    <div id="likes-count-{{ $comment->id }}" class="likes-count px-2 py-1 bg-blue-400 rounded-l-md">{{ $comment->likes }}</div>
                    <div class="border-l border-black px-2 py-1">Like</div>
                </button>
            </form>

            <form method="POST" class="dislike-form inline-block ml-2" action="{{ route('comments.dislike', $comment) }}">
                @csrf
                <button type="submit" class="border border-black bg-red-200 rounded-md text-sm inline-flex">
                    <div class="px-2 py-1">Dislike</div>
                    <div id="dislikes-count-{{ $comment->id }}" class="dislikes-count border-l border-black px-2 py-1 bg-red-400 rounded-r-md">{{ $comment->dislikes }}</div>
                </button>
            </form>
        @endauth
    </div>
    
</div>



<script>
    $(document).ready(function() {
        @auth
        // Likes form
        $(document).off('submit', '.like-form').on('submit', '.like-form', function(e) {
            e.preventDefault();

            var form = $(this);
            var button = form.find('button');
            var countElement = form.find('.likes-count');

            button.prop('disabled', true); // Disable the submit button

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    console.log('Success handler executed. Response: ', response);
                    countElement.text(response.likes);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
                complete: function() {
                    button.prop('disabled', false); // Enable the submit button
                }
            });
        });

        // Dislikes form
        $(document).off('submit', '.dislike-form').on('submit', '.dislike-form', function(e) {
            e.preventDefault();

            var form = $(this);
            var button = form.find('button');
            var countElement = form.find('.dislikes-count');

            button.prop('disabled', true); // Disable the submit button

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    console.log('Success handler executed. Response: ', response);
                    countElement.text(response.dislikes);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
                complete: function() {
                    button.prop('disabled', false); // Enable the submit button
                }
            });
        });
        @endauth
    });
</script>
    

