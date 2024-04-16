<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <div id="countdown" style="text-align: center; font-size: 24px;">
        <i class="fas fa-clock"></i> <span id="countdownText">Time remaining: 15m 00s</span>
    </div>

    <!-- end check out section -->
    <x-slot name="footer">

    </x-slot>
</x-app-layout>

<script>
    // Set the countdown target time 15 minutes from now
    var targetTime = new Date();
    targetTime.setMinutes(targetTime.getMinutes() + 15);

    // Update the countdown every second
    var countdown = setInterval(function() {
        // Get the current time
        var currentTime = new Date().getTime();

        // Find the time remaining
        var distance = targetTime - currentTime;

        // Calculate minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the countdown in the 'countdown' div
        document.getElementById('countdownText').innerHTML = minutes.toString().padStart(2, '0') + 'm ' +
            seconds.toString().padStart(2, '0') + 's ';

        // If the countdown is finished, display a message
        if (distance < 0) {
            clearInterval(countdown);
            document.getElementById('countdownText').innerHTML = 'EXPIRED';
        }
    }, 1000);
</script>
