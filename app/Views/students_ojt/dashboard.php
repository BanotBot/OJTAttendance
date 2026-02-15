<style>
    #ojt-attendance-container {
        --ethereal: #4518e4;
        --ethereal-dark: #3612b5;
        --bg-warm: #F9F7F7;
    }

    #ojt-attendance-container.attendance-module {
        background-color: #FFFFFF;
        border-radius: 1.25rem;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin: 0;
        width: 100%;
    }
    
    #ojt-attendance-container .dashboard-title {
        margin-top: 0;
        margin-bottom: 1.25rem;
        text-align: center;
        font-family: 'Playfair Display', serif;
        color: var(--ethereal);
        font-weight: 700;
        font-size: 1.75rem;
    }


    #ojt-attendance-container .video-scanner {
        position: relative;
        background-color: #000;
        border-radius: 1rem;
        overflow: hidden;
        aspect-ratio: 16 / 9;
        margin: 0 auto 1.5rem auto; 
        border: 1px solid #e5e7eb;
        width: 60%; 
    }

    @media (max-width: 768px) {
        #ojt-attendance-container .video-scanner,
        #ojt-attendance-container .button-wrapper {
            width: 100% !important;
        }
    }

    #ojt-attendance-container #webcam {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #ojt-attendance-container .scanner-overlay {
        position: absolute;
        inset: 1rem;
        border: 2px solid rgba(69, 24, 228, 0.2);
        border-radius: 0.75rem;
        pointer-events: none;
    }

    #ojt-attendance-container .loading-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #111827;
        color: white;
        z-index: 10;
    }

    /* Button Styling */
    #ojt-attendance-container .btn-ethereal-primary {
        background-color: var(--ethereal);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: transform 0.2s;
    }

    #ojt-attendance-container .btn-ethereal-outline {
        border: 2px solid var(--ethereal);
        color: var(--ethereal);
        background: transparent;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: background 0.2s;
    }

    #ojt-attendance-container .btn-ethereal-primary:hover {
        color: #fff;
        background-color: var(--ethereal-dark); 
        transform: translateY(-1px); 
    }
    #ojt-attendance-container .btn-ethereal-outline:hover { 
        background-color: rgba(69, 24, 228, 0.05); 
    }
</style>

<section id="ojt-attendance-container" class="attendance-module">
    <div class="nav-container">
        <h1 class="dashboard-title">Dashboard View</h1>
    </div>

    <div class="video-scanner">
        <video id="webcam" autoplay playsinline></video>
        <div class="scanner-overlay"></div>
        <div class="loading-overlay" id="camera-loading">
            <div class="spinner-border spinner-border-sm mr-2" role="status"></div>
            <span>Initialising Camera...</span>
        </div>
    </div>

    <div class="button-wrapper" style="width: 60%; margin: 0 auto;">
        <div class="row no-gutters">
            <div class="col-6 pr-2">
                <button onclick="recordAttendance('In')" class="btn btn-ethereal-primary btn-block">
                    Check In
                </button>
            </div>
            <div class="col-6 pl-2">
                <button onclick="recordAttendance('Out')" class="btn btn-ethereal-outline btn-block">
                    Check Out
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    /**
     * Camera initialization wrapped in a function to allow 
     * re-triggering if content is loaded via AJAX.
    */
    function initOjtCamera() {
        const video = document.getElementById('webcam');
        const loader = document.getElementById('camera-loading');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    video.srcObject = stream;
                    loader.style.display = 'none';
                })
                .catch(function(error) {
                    console.error("Camera Error: ", error);
                    loader.innerHTML = '<span class="px-2 text-center">Camera Access Denied</span>';
                });
        }
    }

    // Auto-init on load
    document.addEventListener('DOMContentLoaded', initOjtCamera);
    
    // Fallback for dynamic loading (call this manually after AJAX success)
    if (window.jQuery) {
        $(document).ajaxSuccess(function() {
            if ($('#webcam').length && !$('#webcam').prop('srcObject')) {
                initOjtCamera();
            }
        });
    }

    function recordAttendance(status) {
        console.log("Attendance Status: " + status);
        // Add your logic to save to database here
        alert("Success: Checked " + status);
    }
</script>