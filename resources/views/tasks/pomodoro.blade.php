<x-layout>
    <!DOCTYPE html>
    <html class="dark" style="color-scheme: dark;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@200&display=swap" rel="stylesheet">
        
        @stack('styles')
        <link rel="stylesheet" href="{{ asset('css/general.css') }}">
        <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <title>Pomodoro Timer</title>
    </head>
    <body>
        <div class="pomodoro-part">
            <div class="web-title">
                <div>Pomodoro - Made by <a href="https://github.com/PeterBaptista" target="_blank">WebPro Team 3</a></div>
            </div>
            <div class="container">
                <div class="type-section">
                    <button class="type-button" id="pomodoro-button">Pomodoro</button>
                    <button class="type-button" id="short-break-button">Short Break</button>
                    <button class="type-button" id="long-break-button">Long Break</button>
                </div>
                <div id="timer">
                    25:00
                </div>
                <div class="control-section">
                    <button id="control-button">Start</button>
                </div>
            </div>
        </div>

        @push('scripts')
        <script src="{{ asset('js/pomodoro.js') }}"></script>
        @endpush
    </body>
    </html>
</x-layout>