<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Schedule Finder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container">
        <h2>🚌 Bus Schedule Finder</h2>

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <!-- Search Form -->
        <form action="{{ route('index') }}" method="POST">
            @csrf
            <div class="form-group">
                <select id="source" name="source" required>
                    <option value="" disabled selected>Select Source</option>
                    @foreach ($stops as $s)
                            <option value="{{ $s }}" {{ old('source', $source ?? '') == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                    @endforeach
                </select>
                <select id="destination" name="destination" required>
                    <option value="" disabled selected>Select Source</option>
                    @foreach ($stops as $s)
                            <option value="{{ $s }}" {{ old('destination', $destination ?? '') == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                    @endforeach
                </select>
                <input type="submit" value="Search">
            </div>
        </form>

        <!-- Bus List -->
        <div class="bus-list" id="busList"></div>
    </div>

    @if (isset($buses))
        <script>
            const buses = @json($buses);
            const busList = document.getElementById('busList');

            if (buses.length === 0) {
                busList.innerHTML =
                '<div class="alert alert-primary" role="alert">No buses found for the selected route.</div>';
            } else {

                buses.forEach((bus, index) => {
                    const stops = Array.isArray(bus.stop) ? bus.stop : [];

                    const stopsHtml = stops.map(stop => `
            <div class="stop">
                <span><i class="fa-solid fa-location-dot"></i> ${stop.name}</span>
                <span>${stop.arrival_time}</span>
            </div>
        `).join('');

                    // 1. Create wrapper
                    const card = document.createElement('div');
                    card.innerHTML = `
        <div class="bus-card">
            <div class="bus-header" data-index="${index}">
                <div class="bus-type">${bus.name}</div>
                <div class="bus-time">
                    <i class="fa-solid fa-bus"></i> ${bus.stop[0].arrival_time} → ${bus.stop[bus.stop.length - 1].arrival_time}
                    <i class="fa-solid fa-angle-right arrow"></i>
                </div>
            </div>
            <div class="accordion">
                ${stopsHtml}
                <div style="margin-top: 15px;text-align:center;">
                    <button onclick="window.location='/bus/${bus.id}'">Route Details</button>
                </div>
            </div>
        </div>
    `;

                    const busCard = card.firstElementChild; // Get the actual .bus-card div
                    const accordion = busCard.querySelector(".accordion");
                    const arrowIcon = busCard.querySelector(".arrow");

                    busCard.querySelector(".bus-header").addEventListener("click", () => {
                        // Close all others
                        document.querySelectorAll(".accordion").forEach(acc => {
                            if (acc !== accordion) {
                                acc.style.maxHeight = null;
                                acc.classList.remove("open");
                                acc.previousElementSibling?.querySelector(".arrow")?.classList.remove(
                                    "rotate");
                            }
                        });

                        // Toggle clicked one
                        if (accordion.style.maxHeight) {
                            accordion.style.maxHeight = null;
                            accordion.classList.remove("open");
                            arrowIcon.classList.remove("rotate");
                        } else {
                            accordion.style.maxHeight = accordion.scrollHeight + "px";
                            accordion.classList.add("open");
                            arrowIcon.classList.add("rotate");
                        }
                    });

                    busList.appendChild(busCard); // Append the actual card
                });

            }
        </script>
    @endif

    <script>
        const source = document.getElementById('source');
        const destination = document.getElementById('destination');

        function updateDestinationOptions() {
            const selectedStart = source.value;

            Array.from(destination.options).forEach(option => {
                if (option.value === "" || option.disabled && option.selected) return; // Skip default option
                option.disabled = option.value === selectedStart;
            });
        }

        function updateSourceOptions() {
            const selectedEnd = destination.value;

            Array.from(source.options).forEach(option => {
                if (option.value === "" || option.disabled && option.selected) return; // Skip default option
                option.disabled = option.value === selectedEnd;
            });
        }

        source.addEventListener('change', updateDestinationOptions);
        destination.addEventListener('change', updateSourceOptions);

        // Run on load in case there's a preselected value
        updateDestinationOptions();
        updateSourceOptions();
    </script>



</body>

</html>
