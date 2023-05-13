<x-mail::message>
# Introduction

The body of your message.

# New Comment

You have a new comment on your blog post from {{ $comment->user->name }}:

{{ $comment->content }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
