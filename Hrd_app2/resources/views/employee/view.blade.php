<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Attendance</title>
</head>
<body>
    <h1>Employee Attendance</h1>

    <table border="1">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>age</th>
                <th>Salary</th>
                <th>Password</th>
                <th>edit</th>
            </tr>
            @foreach ($employees as $employee)
                <tr>
                    <th>{{$employee->id}}</th>
                    <th>{{$employee->name}}</th>
                    <th>{{$employee->position}}</th>
                    <th>{{$employee->age}}</th>
                    <th>{{$employee->salary}}</th>
                    <th>{{$employee->password}}</th>
                    <th>
                        <a href="{{route('employee.edit', ['employee' => $employee])}}">edit</a>
                    </th>
                </tr>
            @endforeach
    </table>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <a href="{{route('employee.index')}}" >index</a>
    <a href="{{route('employee.create')}}" >create</a>
</body>
</html>
