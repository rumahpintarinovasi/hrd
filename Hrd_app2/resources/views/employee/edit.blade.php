<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add an Employee</title>
</head>
<body>
    <h1>Edit an Employee</h1>
    <form method="POST" action="{{route('employee.update', ['employee' => $employee])}}">
        @method('put')
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Employee name" value = "{{$employee->name}}" />
        </div>

        <div>
            <label>Position</label>
            <input type="text" name="position" placeholder="Employee's position" value = "{{$employee->position}}"/>
        </div>

        <div>
            <label>Age</label>
            <input type="text" name="age" placeholder="Employee's age" value = "{{$employee->age}}"/> 
        </div>

        <div>
            <label>Salary</label>
            <input type="text" name="salary" placeholder="Employee's salary" value = "{{$employee->salary}}"/>
        </div>

        <div>
            <label>Password</label>
            <input type="text" name="password" placeholder="Password For Login" value = "{{$employee->password}}"/>
        </div>

        <div>
            <input type="submit" value="update" />
        </div>
    </form>
</body>
</html>
