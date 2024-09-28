<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add an Employee</title>
</head>
<body>
    <h1>Add an Employee</h1>
    <form method="POST" action="{{ route('employee.store') }}">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Employee name" />
        </div>

        <div>
            <label>Position</label>
            <input type="text" name="position" placeholder="Employee's position" />
        </div>

        <div>
            <label>Age</label>
            <input type="text" name="age" placeholder="Employee's age" /> 
        </div>

        <div>
            <label>Salary</label>
            <input type="text" name="salary" placeholder="Employee's salary" />
        </div>

        <div>
            <label>Password</label>
            <input type="text" name="password" placeholder="Password For Login" />
        </div>

        <div>
            <input type="submit" value="Add" />
        </div>
    </form>
    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <a href="{{route('employee.index')}}" >index</a>
    <a href="{{route('employee.view')}}" >view</a>
</body>
</html>
