<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Route</title>
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
</head>

<body>

    <div class="header">
        @php
            $first = $buses->stop->first(); 
            $last = $buses->stop->last();
            echo "Bus Route - $first->name to $last->name"
        @endphp
        <button class="back-btn" onclick="window.location.href='{{ route('index') }}'">Cancel</button>
    </div>

    <div class="route-container">
        <div class="route-header">
            <div class="header-stop">Station</div>
            <div class="header-info">Terminal</div>
            <div class="header-times">
                <div class="header-time">Arrival</div>
                <div class="header-time">Departure</div>
            </div>
        </div>

        @foreach ($buses->stop as $bus)
            <div class="stop">
                <div class="stop-circle"></div>
                <div class="stop-details">
                    <div class="stop-title">{{ $bus->name }}</div>
                    <div class="stop-info">Terminal No. {{ $bus->terminal_no }}</div>
                </div>
                <div class="stop-time-container">
                    <div class="stop-time"><span class="scheduled">{{ \Carbon\Carbon::parse($bus->arrival_time)->format('h:i A') }}</span></div>
                    <div class="stop-time"><span class="actual">{{ \Carbon\Carbon::parse($bus->departure_time)->format('h:i A') }}</span></div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>