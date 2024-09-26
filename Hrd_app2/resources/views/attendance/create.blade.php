<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Attendance</h1>
    
        @if(!Session::has('employee_id'))
            <div class="alert alert-danger">You must be logged in to submit attendance.</div>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @else
            <form method="POST" action="{{ route('attendance.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="photo">Upload Photo</label>
                    <input type="file" name="photo" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label>Status</label><br>
                    <input type="radio" name="status" value="check_in" required> Check In<br>
                    <input type="radio" name="status" value="check_out" required> Check Out<br>
                </div>
        
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endif
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>    

</body>
</html>
