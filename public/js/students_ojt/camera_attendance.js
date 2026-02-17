
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
    try {

        Webcam.snap(async function(data_uri){
            console.log("status", status);
            console.log("Captured Image : ", data_uri);

            let imageFile = data_uri.split(",")[1];
            console.log("DataFile : ", imageFile);

            const response = await fetch("<?php echo site_url('students_ojt/attendance') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    imageFile: imageFile
                })
            });

            const result = response.json();

            if (!response.ok) {
                throw new Error("Unable to record the attendance captured, Please try again later!");
            }

            alert("Successfully recorded");

        });
    } catch (error) {
        console.error(error);
    }
    
}
