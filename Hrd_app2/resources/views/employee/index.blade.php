<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Attendance</title>
    @vite('resources/css/app.css')
</head>
<body>
<header class="bg-blue-900">
    <nav class="flex max-w-8xl justify-between p-7 " aria-label="Global">
        <div class="flex lg:flex-1 justify-start">
            <a href="#" class="flex items-center">
                <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">
                <span class="text-lg font-bold text-white">Rumah Pintar</span>
            </a>
        </div>
        <div class="flex lg:flex-1 justify-end">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-md font-bold leading-5 text-white">Log out <span aria-hidden="true">&rarr;</span></button>
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
                <a href="{{route('employee.view')}}"class="block px-4 py-2 text-lg font-semibold hover:bg-gray-700 rounded">View</a>
            </li>
            <li class="mb-4">
                <a href="{{route('employee.create')}}" class="block px-4 py-2 text-lg font-semibold hover:bg-gray-700 rounded">Add Employee</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <table border="1" class="min-w-full bg-white">
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
                                    N/A
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
            @csrf
    </div>
</div>
</body>
</html>
