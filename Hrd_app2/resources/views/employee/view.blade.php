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
    <x-navbar></x-navbar>

        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Employee List</h1>
            <table border="1" class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">ID</th>
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Name</th>
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Position</th>
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Age</th>
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Salary</th>
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Password</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{$employee->id}}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{$employee->name}}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{$employee->position}}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{$employee->age}}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{$employee->salary}}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{$employee->password}}</td>
                        <td class="px-4 py-2 ">
                            <a href="{{route('employee.edit', ['employee' => $employee])}}" class="text-blue-700 hover:underline">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
