<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Employee Attendance</title>
</head>
<body>
    <header class="bg-blue-900">
        <nav class="mx-auto flex max-w-7xl justify-between p-7 " aria-label="Global">
            <div class="flex lg:flex-1 justify-start"> <!-- Tambahkan "items-center" agar teks sejajar secara vertikal dengan logo -->
                <a href="#" class= flex items-center"> <!-- Flex untuk mengatur logo dan nama secara horizontal -->
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">
                    <span class="text-lg font-bold text-white">Rumah Pintar</span> <!-- Nama perusahaan di sebelah logo -->
                </a>
            </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      <a href="#" class="text-md font-bold leading-5 text-white">Log in <span aria-hidden="true">&rarr;</span>
    </a>
    </div>
  </nav>


  <!-- Mobile menu, show/hide based on menu open state. -->
  <div class="lg:hidden" role="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0 z-10">
    </div>
    <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
        </a>
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6">
            <div class="-mx-3">
            </div>
            <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
          </div>
        </div>
      </div>
    </div
  </div>
</header>


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
