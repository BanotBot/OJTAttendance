<style>
    .attendance-container {
        text-align: center;
    }

    .attendance-header {
        background-color: #FFFFFF;
        border-bottom: 1px solid #e5e7eb;~
        padding: 1.5rem 0;
        margin-bottom: 2rem;
    }

    .card {
        background-color: #FFFFFF;
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid #f3f4f6;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    .section-title {}
</style>

<section class="container attendance-header">

    <div class="container mx-auto px-4 text-center">
        <h1 class="font-serif text-3xl text-ethereal">Dashboard View</h1>
        <p class="text-gray-500 mt-2">Welcome to the Students OJT dashboard 🔥</p>
    </div>

    <div class="card">
        <h2 class="section-title">
            <span class="status-dot"></span>
            Attendance Scanner
        </h2>
    </div>

    <div class="video-scanner group">
        <video src="" id="webcam" autoplay playsinline></video>
        <div class="scanner-overly"></div>
        <div class="loading-overly" id="camera-loading">
            Requesting Camera Access....
        </div>
    </div>

    <div class="button-group">
        <button onclick="recordAttendance('Check In')" class="btn btn-primary">
            Check In
        </button>
        <button onclick="recordAttendance('Check Out')" class="btn btn-secondary">
            Check Out
        </button>
    </div>



</section>