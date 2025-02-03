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

    @if($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="/deepseek-query" method="POST">
        @csrf
        <textarea name="user_input" rows="4" cols="50">{{ old('user_input', $user_input ?? '') }}</textarea>
        <br>
        <button type="submit">Submit</button>
    </form>

    @if(isset($reply))
        <div>
            <h3>DeepSeek R1 Response:</h3>
            <p>{{ $reply }}</p>
        </div>
    @endif    
</body>
</html>