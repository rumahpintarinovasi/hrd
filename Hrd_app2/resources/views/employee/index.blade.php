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
    <x-navbar></x-navbar>

    

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Attendance Report</h1>
        <table border="1" class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">ID</th>
                    <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Name</th>
                    <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Position</th>
                    @foreach ($dateRange as $date)
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">{{ \Carbon\Carbon::parse($date)->format('d/m/24') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employeeData)
                    <tr>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{ $employeeData['employee']->name }}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{ $employeeData['employee']->id }}</td>
                        <td class="px-4 py-2" style="border: 2px solid black;">{{ $employeeData['employee']->position }}</td>
                        @foreach ($dateRange as $date)
                            <td class="px-4 py-2" style="border: 2px solid black;">
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
        </form>
    </div>
</div>
</body>
</html>
