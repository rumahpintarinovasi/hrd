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

    <div class="flex-1 p-8 bg-gray-100">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data</h1>   
    <form method="POST" action="{{route('employee.update', ['employee' => $employee])}}" class="bg-white p-6 rounded shadow-md max-w-lg">
        @method('put')
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" placeholder="Employee name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value = "{{$employee->name}}" />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Position</label>
            <input type="text" name="position" placeholder="Employee's position" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value = "{{$employee->position}}"/>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Age</label>
            <input type="text" name="age" placeholder="Employee's age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value = "{{$employee->age}}"/> 
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Salary</label>
            <input type="text" name="salary" placeholder="Employee's salary" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value = "{{$employee->salary}}"/>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="text" name="password" placeholder="Password For Login" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value = "{{$employee->password}}"/>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" value="update" />
            Submit
            </button>
        </div>
    </form>
    <div>
        @if (session()->has('success'))
            <div>
                {{session('success')}}    
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
