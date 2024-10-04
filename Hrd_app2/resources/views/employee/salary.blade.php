<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Employee Salary Report</h1>

        <form action="{{ route('employee.salary') }}" method="GET" class="mb-6">
            <label for="filter" class="block text-gray-600 text-sm font-bold mb-2">Select Time Range:</label>
            <select name="filter" id="filter" class="border rounded px-4 py-2" style="border: 2px solid black;" onchange="this.form.submit()">
                <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Week</option>
                <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Month</option>
            </select>
        </form>

        <div class="mb-2">
            <h4 class="text-lg font-semibold text-gray-700">Periode: {{$daterange}}</h4>
        </div>

        <table border="1" class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Employee Name</th>
                    <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Total Lateness (minutes)</th>
                    <th class="px-4 py-2 bg-blue-900 text-white" style="border: 2px solid black;">Total Early Leave (minutes)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="px-4 py-2" style="border: 2px solid black;">{{ $item['employee']->name }}</td>
                    <td class="px-4 py-2" style="border: 2px solid black;">{{ $item['total_time_lateness'] }}</td>
                    <td class="px-4 py-2" style="border: 2px solid black;">{{ $item['total_time_shortage'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
