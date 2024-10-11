<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Attendance</title>
    @vite('resources/css/app.css')
</head>
<body style="position: relative; overflow: auto;">
    <div style="background-image: url('{{ asset('images/login_wallpaper.jpg') }}'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <div class="flex-1 p-6" style="height: 100vh; overflow-y: auto;">
        <!-- Pisahkan H1 dari tabel -->
            <h1 class="text-2xl font-bold text-black mb-6">Attendance Report</h1>

        <!-- Tabel dimulai setelah header -->
        <div class="table-section">
            <table class="min-w-full" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">ID</th>
                        <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Name</th>
                        <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">Position</th>
                        @foreach ($dateRange as $date)
                        <th class="px-4 py-2 bg-opacity-80 bg-blue-900 text-white" style="border: 1px solid rgba(0, 0, 0);">{{ \Carbon\Carbon::parse($date)->format('d/m/24') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $employeeData)
                        <tr>
                            <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $employeeData['employee']->id }}</td>
                            <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $employeeData['employee']->name }}</td>
                            <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $employeeData['employee']->position }}</td>
                            @foreach ($dateRange as $date)
                                <td class="px-4 py-2 bg-opacity-30 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">
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
