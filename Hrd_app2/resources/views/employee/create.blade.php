<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add an Employee</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar></x-navbar>

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-100">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Input New Employee Data</h1>

            <form method="POST" action="{{ route('employee.store') }}" class="bg-white p-6 rounded shadow-md max-w-lg">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" placeholder="Employee name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <div class="mb-4">
                    <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Position</label>
                    <input type="text" name="position" placeholder="Employee's position" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <div class="mb-4">
                    <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age</label>
                    <input type="text" name="age" placeholder="Employee's age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" /> 
                </div>

                <div class="mb-4">
                    <label for="salary" class="block text-gray-700 text-sm font-bold mb-2">Salary</label>
                    <input type="text" name="salary" placeholder="Employee's salary" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" placeholder="Password For Login" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
