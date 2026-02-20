
function loadInitCameraScript() 
{
    console.log("CAMERA INITIALIZED");
    console.log(typeof Webcam);
    Webcam.set({
        width: 1280,
        height: 720,
        dest_width: 1280,
        dest_height: 720,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false,
        flip_horiz: true, 
        fps: 45
    });
    
    Webcam.attach("#webcam");

    Webcam.on("live", function(){
        $("#camera-loading").css("display", "none");

        const video = document.querySelector("webcam video");
        if (video) {
            video.style.width = "100%";
            video.style.height = "100%";
            video.style.objectFit = "cover";
        }
    });
}

Webcam.on("error", function(err) {
    console.error("Webcam Error:", err);
    document.getElementById("camera-loading").innerHTML = "<span>Camera Access Denied</span>";
});

async function recordAttendance(status)
{
    try {
        Webcam.snap(async function(data_uri){
            console.log("Captured Image : ", data_uri);

            let imageFile = data_uri.split(",")[1];
            console.log("DataFile : ", imageFile);

            const response = await fetch(SAVE_ATTENDANCE_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    imageFile: imageFile
                })
            });

            const result = await response.json();
            console.log(result);
            console.log(response);
            if (!result.success) {
                alert(result.message);
            }

            alert(result.message);
        });
    } catch (error) {
        console.error(error);
    }
    
}
