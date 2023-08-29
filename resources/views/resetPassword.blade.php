<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        
    @endif

    <form action="" method="POST">
        @csrf
        <input type="hidden" name="id" id="" value="{{$user->id}}">
        <input type="password" name="password" id="" placeholder="New Password">
        <br>
        <input type="password" name="password_confirmation" id="" placeholder="Confirm new password">
        <br>
        <input type="submit" name="" id="">

    </form>
</body>
</html>