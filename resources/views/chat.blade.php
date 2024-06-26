<!DOCTYPE html>
<html>
<head>
    <title>BotMan Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <chat-widget></chat-widget>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
</body>
</html>
