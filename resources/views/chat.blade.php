<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project DeepSeek</title>
</head>

<body>
    <h2>Project DeepSeek</h2>
    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form id="chat-form" action="/deepseek-query" method="POST">
        @csrf
        <textarea name="user_input" rows="4" cols="50">{{ old('user_input', $user_input ?? '') }}</textarea>
        <br>
        <button type="submit">Submit</button>
    </form>

    <div id="response-tab">
        <div>
            <h3>DeepSeek R1 Response:</h3>
            <div id="response">
                @if (isset($reply))
                    <p>{{ $reply }}</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#chat-form').on('submit', function(event) {
                event.preventDefault();
                $('#response').html('<div id="loading"><p>Loading...</p></div>'); // Show loading animation
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#loading').remove(); // Remove loading animation
                        $('#response').html('<p>' + response.reply + '</p>');
                    },
                    error: function(xhr) {
                        $('#loading').remove(); // Remove loading animation
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
