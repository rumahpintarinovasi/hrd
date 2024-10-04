<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary</title>
</head>
<body>
    <h1>Employee Late minutes</h1>

    <form action="{{ route('employee.salary') }}" method="GET">
        <label for="filter">Select Time Range:</label>
        <select name="filter" id="filter" onchange="this.form.submit()">
            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}> Week</option>
            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}> Month</option>
        </select>
    </form>
    <div>
        <h4> Periode : {{$daterange}}</h4>
    </div>
    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Total Lateness (minutes)</th>
                <th>Total Early Leave (minutes)</th>
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
