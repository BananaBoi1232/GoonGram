<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Message Requests</title>
    @include('navbar')
</head>
<body>
    <!-- Compose Message Form -->
    <form action={{ url('/send-message') }} method="post" class="flex-column justify-content-center text-align-center">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $post->id }}">
        <input type="text" name="message" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>

    <!-- Disable/Enable message requests -->
    <div>
        <h4>Disable/Enable message requests</h4>
        <form action="{{ route('update.message.status') }}" method="post">
            @csrf
            <label for="disable">Disable: </label>
            <input type="radio" name="status" value="0" {{ $messageStatus == 0 ? 'checked' : '' }}>
            <label for="enable">Enable: </label>
            <input type="radio" name="status" value="1" {{ $messageStatus == 1 ? 'checked' : '' }}>
            <button type="submit">Update Status</button>
        </form>
    </div>

    <!-- Pending Messages -->
    @if($pendingMessages->isNotEmpty())
        <h3>Pending Messages:</h3>
        <ul>
            @foreach($pendingMessages as $directMessage)
                @foreach($directMessage->messages as $message)
                    <li>{{ $message->message }}</li>
                @endforeach
                <form action="{{ route('approve.message', $directMessage) }}" method="post">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
            @endforeach
        </ul>
    @endif

    <!-- Conversations -->
    @if($approvedMessages->isNotEmpty())
        <h3>Conversation:</h3>
        <ul>
            @foreach($approvedMessages as $directMessage)
                @foreach($directMessage->messages as $message)
                    <li>{{ $message->message }}</li>
                @endforeach
            @endforeach
        </ul>
    @endif
</body>
</html>