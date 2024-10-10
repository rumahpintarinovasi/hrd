<header class="" style="background-color: rgb(15, 28, 61);">
    <nav class="flex max-w-8xl justify-between p-7 " aria-label="Global">
        <div class="flex lg:flex-1 justify-start">
            <a href="{{route('employee.index')}}" class="flex items-center">
                <img class="h-10 w-16" src="{{ asset('images/logo_rumah_pintar.png') }}"alt="Logo">
                <span class="text-2xl font-bold text-white">Rumah Pintar</span>
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
    <div id="sidebar" class="w-64 h-screen bg-gray-900 bg-opacity-80 text-white p-6" >
        <ul>
            <li class="mb-4">
                <a href="{{route('employee.index')}}" class="block px-4 py-2 text-lg font-semibold {{ request()->routeIs('employee.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Attendance</a>
            </li>
            <li class="mb-4">
                <a href="{{route('employee.view')}}" class="block px-4 py-2 text-lg font-semibold {{ request()->routeIs('employee.view') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">View</a>
            </li>
            <li class="mb-4">
                <a href="{{route('employee.salary')}}" class="block px-4 py-2 text-lg font-semibold {{ request()->routeIs('employee.salary') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Salary</a>
            </li>
            <li class="mb-4">
                <a href="{{route('employee.create')}}" class="block px-4 py-2 text-lg font-semibold {{ request()->routeIs('employee.create') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Add Employee</a>
            </li>
        </ul>
    </div>