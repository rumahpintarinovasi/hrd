<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Employee Attendance</title>
</head>
<body style="position: relative; overflow: auto;">
    <div style="background-image: url('{{ asset('images/login_wallpaper.jpg') }}'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
    <x-navbar></x-navbar>

    <div class="flex-1 p-6" style="height: 100vh; overflow-y: auto;">
        <h1 class="text-2xl font-bold text-black mb-6">Employee List</h1>
        <table border="1" class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">ID</th>
                    <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Name</th>
                    <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Position</th>
                    <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Age</th>
                    <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Salary</th>
                    <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{$employee->id}}</td>
                    <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{$employee->name}}</td>
                    <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{$employee->position}}</td>
                    <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{$employee->age}}</td>
                    <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{$employee->salary}}</td>
                    <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{$employee->password}}</td>
                    <td class="px-4 py-2">
                        <div class="flex space-x-2">
                        <form method="get" action="{{route('employee.edit', ['employee' => $employee])}}">
                            @csrf
                            @method('edit')
                            <input type="submit" value="Edit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-300 w-18"/>
                        </form>
                        <form method="post" action="{{route('employee.destroy', ['employee' => $employee] )}}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-300 w-18"/>
                        </form>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session()->has('success'))
    <div>
        {{ session('success') }}    
    </div>    
    @endif  
</body>
</html>
