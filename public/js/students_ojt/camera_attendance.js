
function loadInitCameraScript() 
{
    console.log("CAMERA INITIALIZED");
    console.log(typeof Webcam);
    Webcam.set({
        width:400,
        height:300,
        image_format:'jpeg',
        jpeg_quality:90
    });
    
    Webcam.attach("#webcam");

    Webcam.on("live", function(){
        $("#camera-loading").css("display", "none");
    });
}

async function recordAttendance(status)
{
    console.log("status", status);
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
