<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/login_wallpaper.jpg') }}'); background-size: cover; background-position: center;">

    <form method="POST" action="{{ route('login') }}" class="bg-gray-200 bg-opacity-55 p-6 rounded-lg shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h1>
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" placeholder="Enter your name" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  bg-white bg-opacity-60" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" placeholder="Enter your password" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white bg-opacity-60" required>
        </div>

        <button type="submit" class="bg-blue-900 bg-opacity-90 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg w-full">
            Login
        </button>

        @if($errors->any())
            <div class="mt-4 p-4 bg-red-200 text-red-800 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

</body>
</html>
