<div>
    <p>Hello,</p>
    <p>You have received a new message from a user:</p>

    <blockquote>{{ $messageContent }}</blockquote>

    <p>Click the link below to view the chat:</p>
    <a href="{{ $chatUrl }}">View Chat</a>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</div>
