<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Attendance</title>
    @vite('resources/css/app.css')
</head>
<body style="margin: 0; padding: 0; height: 100vh; overflow: hidden;">
    <div style="background-image: url('{{ asset('images/login_wallpaper.jpg') }}'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
    
    <x-navbar class="navbar" style="position: fixed; width: 100%; z-index: 10;"></x-navbar>

    <!-- Main Content -->
    <div class="flex-1" style="margin-top: 20px; height: calc(100vh - 90px); overflow-y: auto; padding: 1.5rem; position: relative;">
        <h1 class="text-2xl font-bold text-black mb-6">Attendance Report</h1>

        <div class="table-section">
            <table class="min-w-full" style="width: 100%; border-collapse: collapse;">
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
                            <td class="px-4 py-2 bg-opacity-50 bg-white text-black" style="border: 1px solid rgba(0, 0, 0);">
                                @if (isset($employeeData['attendances'][$date]))
                                    @php
                                        $attendance = $employeeData['attendances'][$date]->first();
                                    @endphp
                                    <div>
                                        in: {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : 'N/A' }}<br>
                                        out: {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : 'N/A' }}
                            
                                        @if($attendance->photo_path)
                                            <img src="{{ asset('storage/' . $attendance->photo_path) }}" alt="Attendance Photo" class="w-16 h-16 object-cover mt-2 cursor-pointer" onclick="openModal('{{ asset('storage/' . $attendance->photo_path) }}')">
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

    <!-- Modal for Image Display -->
    <div id="myModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 30%; top: 30%; width: 40%; height: 50%; overflow: auto; background-color: rgba(0, 0, 0, 0.9);">
        <span class="close" onclick="closeModal()" style="position: absolute; top: 15px; right: 35px; color: #fff; font-size: 40px; font-weight: bold; transition: 0.3s;">&times;</span>
        <img class="modal-content" id="img01" style="margin: auto; display: block; width: 100%; max-width: 700px;"> <!-- Adjusted width and max-width -->
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal
        function openModal(src) {
            modal.style.display = "block";
            document.getElementById("img01").src = src;
        }

        // Close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Close the modal when clicking outside of the image
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
