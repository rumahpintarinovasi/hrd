<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Employee Attendance</title>
</head>
<body>
    <header class="bg-blue-900">
        <nav class="flex max-w-8xl justify-between p-7" aria-label="Global">
            <div class="flex lg:flex-1 justify-start">
                <a href="#" class="flex items-center">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">
                    <span class="text-lg font-bold text-white">Rumah Pintar</span>
                </a>
            </div>
            <div class="flex lg:flex-1 justify-end">
                <!-- Form untuk logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-md font-bold leading-5 text-white inline-block">Log out <span aria-hidden="true">&rarr;</span></button>
                </form>
            </div>
        </nav>
    </header>
    
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-800 text-white p-6">
            <ul>
                <li class="mb-4">
                    <a href="{{route('employee.index')}}" class="block px-4 py-2 text-lg font-semibold hover:bg-gray-700 rounded">Attendance</a>
                </li>
                <li class="mb-4">
                    <a href="{{route('employee.view')}}" class="block px-4 py-2 text-lg font-semibold hover:bg-gray-700 rounded">View</a>
                </li>
                <li class="mb-4">
                    <a href="{{route('employee.create')}}" class="block px-4 py-2 text-lg font-semibold hover:bg-gray-700 rounded">Settings</a>
                </li>
            </ul>
        </div>

        <div class="flex-1 p-6">
            <table border="1" class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Position</th>
                        <th class="px-4 py-2 border">Age</th>
                        <th class="px-4 py-2 border">Salary</th>
                        <th class="px-4 py-2 border">Password</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td class="px-4 py-2 border">{{$employee->id}}</td>
                        <td class="px-4 py-2 border">{{$employee->name}}</td>
                        <td class="px-4 py-2 border">{{$employee->position}}</td>
                        <td class="px-4 py-2 border">{{$employee->age}}</td>
                        <td class="px-4 py-2 border">{{$employee->salary}}</td>
                        <td class="px-4 py-2 border">{{$employee->password}}</td>
                        <td class="px-4 py-2 ">
                            <a href="{{route('employee.edit', ['employee' => $employee])}}" class="text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
