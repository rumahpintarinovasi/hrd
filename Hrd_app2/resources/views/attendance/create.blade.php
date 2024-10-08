<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Absensi Rumah Pintar</h1>

        @if(Session::has('employee_id'))
            <form method="POST" action="{{ route('attendance.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Upload Photo</label>
                    <input type="file" name="photo" class="block w-full text-gray-700 border rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="check_in" class="form-radio" required>
                            <span class="ml-2">Check In</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="check_out" class="form-radio" required>
                            <span class="ml-2">Check Out</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Logout
                </button>
            </form>
        @else
            <div class="mb-4 p-4 bg-red-200 text-red-800 rounded">You must be logged in to submit attendance.</div>
            <a href="{{ route('login') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center mb-4">Login</a>
        @endif


        @if(session('success'))
            <div class="mt-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mt-4 p-4 bg-red-200 text-red-800 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
