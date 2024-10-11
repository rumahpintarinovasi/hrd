<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Report</title>
    @vite('resources/css/app.css')
</head>
<body style="position: relative; overflow: hidden;">
    <div style="background-image: url('{{ asset('images/login_wallpaper.jpg') }}'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <div class="flex-1 p-6" style="height: 100vh; overflow-y: auto;">
            <h1 class="text-2xl font-bold text-black mb-6">Salary</h1>

        <div class="table-section">
            <form action="{{ route('employee.salary') }}" method="GET" class="mb-6 p-4 rounded-lg">
                <label for="filter" class="block text-gray-800 text-sm font-bold mb-2">Select Time Range:</label>
                <select name="filter" id="filter" class="border rounded px-4 py-2 bg-white bg-opacity-30 text-black" style="border: 2px solid black;" onchange="this.form.submit()">
                    <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Week</option>
                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Month</option>
                </select>

                <label for="fine" class="block text-gray-800 text-sm font-bold mb-1">Fine per minute:</label>
                <input type="number" name="fine" id="fine" class="border rounded px-4 py-2 bg-white bg-opacity-30 text-black" style="border: 2px solid black;" required>
                <button type="submit" class="mt-2 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Apply</button>
            </form>

            <div class="mb-2">
                <h4 class="text-lg font-bold text-gray-850">Period: {{$daterange}}</h4>
            </div>

            <table border="1" class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Employee Name</th>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Base Salary</th>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Total Lateness (minutes)</th>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Total Early Leave (minutes)</th>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Fine</th>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Total Fine</th>
                        <th class="px-4 py-2 bg-blue-900 bg-opacity-80 text-white" style="border: 2px solid black;">Total Salary (After Fine)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    @php
                        $total_fine = ($item['total_time_lateness'] + $item['total_time_shortage']) * request('fine');
                        $final_salary = $item['employee']->salary - $total_fine;
                    @endphp
                    <tr>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $item['employee']->name }}</td>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $item['employee']->salary }}</td>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $item['total_time_lateness'] }}</td>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $item['total_time_shortage'] }}</td>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ request('fine') }}</td>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $total_fine }}</td>
                        <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">{{ $final_salary }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
