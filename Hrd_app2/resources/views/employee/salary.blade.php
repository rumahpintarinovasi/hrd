<!-- resources/views/employee/salary.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary</title>
</head>
<body>
    <h1>Employee Salary and Attendance</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Time Lateness (minutes)</th>
                <th>Total Time Shortage (minutes)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['employee']->name }}</td>
                    <td>{{ $item['total_time_lateness'] }}</td>
                    <td>{{ $item['total_time_shortage'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
