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
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                @foreach ($dateRange as $date)
                    <th>{{ \Carbon\Carbon::parse($date)->format('d/m/24') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $employeeData)
                <tr>
                    <td>{{ $employeeData['employee']->id }}</td>
                    <td>{{ $employeeData['employee']->name }}</td>
                    <td>{{ $employeeData['employee']->position }}</td>

                    @foreach ($dateRange as $date)
                        <td>
                            @if (isset($employeeData['attendances'][$date]))
                                @php
                                    $attendance = $employeeData['attendances'][$date]->first();
                                @endphp
                                in: {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : 'N/A' }}<br>
                                out: {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : 'N/A' }}
                            @else
                                
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <a href="{{route('employee.view')}}" >view</a>
    <a href="{{route('employee.create')}}" >create</a>
</body>
</html>
