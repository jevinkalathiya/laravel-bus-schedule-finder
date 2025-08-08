<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Bus</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="header">
        Create Bus Route
        <button class="back-btn" onclick="window.location.href='{{ route('index') }}'">Cancel</button>
    </div>
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
        <form action="{{ route('create') }}" method="POST" id="busForm">
          @csrf
            <div class="form-group">
                <label for="busName">Bus Name:</label>
                <input type="text" id="busName" name="busName" value="{{ old('busName') }}" required/>
            </div>

            <div class="stops-group" id="stopsGroup">
                <label>Stops:</label>
                <div class="stop-entry">
                    <input type="text" name="stopName[]" placeholder="Stop Name" required/>
                    <input type="number" name="stopTerminal[]" placeholder="Terminal No" required/>
                    <input type="time" name="stopTime[]" placeholder="Stop Time" required/>
                </div>
            </div>

            <div class="btn-group">
                <button type="button" class="btn" onclick="addStop()">+ Add Stop</button>
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function addStop() {
            const stopEntry = document.createElement("div");
            stopEntry.className = "stop-entry";
            stopEntry.style.marginBottom = "10px";

            stopEntry.innerHTML = `
        <input type="text" name="stopName[]" placeholder="Stop Name" required>
        <input type="number" name="stopTerminal[]" placeholder="Terminal No" required/>
        <input type="time" name="stopTime[]" required>
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">X</button>
    `;

            document.getElementById("stopsGroup").appendChild(stopEntry);
        }
    </script>

</body>

</html>