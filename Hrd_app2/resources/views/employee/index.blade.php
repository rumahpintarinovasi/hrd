<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Attendance</title>
    @vite('resources/css/app.css')
</head>
<body style="background-image: url('{{ asset('images/login_wallpaper.jpg') }}'); background-size: cover; background-position: center;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(69, 73, 98, 0.508); z-index: -1;"></div>
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Attendance Report</h1>
        <table class="min-w-full" style="sborder-collapse: collapse;">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-opacity-70 bg-blue-900 text-white" style="border: 1px solid ;">ID</th>
                    <th class="px-4 py-2 bg-opacity-70 bg-blue-900 text-white" style="border: 1px solid ;">Name</th>
                    <th class="px-4 py-2 bg-opacity-70 bg-blue-900 text-white" style="border: 1px solid ;">Position</th>
                    @foreach ($dateRange as $date)
                        <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid;">{{ \Carbon\Carbon::parse($date)->format('d/m/24') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employeeData)
                    <tr>
                        <td class="px-4 py-2 text-white" style="border: 1px solid rgba(0, 0, 0, 0.2);">{{ $employeeData['employee']->name }}</td>
                        <td class="px-4 py-2 text-white" style="border: 1px solid rgba(0, 0, 0, 0.2);">{{ $employeeData['employee']->id }}</td>
                        <td class="px-4 py-2 text-white" style="border: 1px solid rgba(0, 0, 0, 0.2);">{{ $employeeData['employee']->position }}</td>
                        @foreach ($dateRange as $date)
                            <td class="px-4 py-2 text-white" style="border: 2px solid rgb(255, 255, 255);">
                                @if (isset($employeeData['attendances'][$date]))
                                    @php
                                        $attendance = $employeeData['attendances'][$date]->first();
                                    @endphp
                                    <div>
                                        in: {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : 'N/A' }}<br>
                                        out: {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : 'N/A' }}

                                        @if($attendance->photo_path)
                                            <img src="{{asset('storage/'. $attendance->photo_path)}}" alt="Attendance Photo" class="w-16 h-16 object-cover mt-2">
                                        @else
                                            No photo
                                        @endif
                                    </div>
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
