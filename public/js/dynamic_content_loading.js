

window.addEventListener("DOMContentLoaded", function(){
    document.querySelector(".nav-link.active").click();
});

// --- Click Handler ---
document.querySelectorAll(".nav-link").forEach(element => {
    console.log("click");
    element.addEventListener("click", async function(e) {
        e.preventDefault();

        try {

            document.querySelectorAll(".nav-link").forEach(l => l.classList.remove("active"));
            this.classList.add("active");

            const page = this.dataset.page;
            loadPageView(page);
        } catch (error) {
            console.log("Error : " + error);
        }
    });
});

async function loadPageView(page) 
{
    try {
        const response = await fetch(BASE_URL + page);
        if (!response.ok) {
            throw new Error("HTTP " + response.status);
        }

        const result = await response.text();
        document.getElementById("main_content").innerHTML = result;

        if (page === "dashboard") {
            loadScript();
        }else if (page === "attendance") {
            loadAttendanceScript();
        }

    } catch (error) {
        console.error("Error loading page: ", error);
        document.getElementById("main_content").innerHTML = "<p class='text-danger'>Failed to load page.</p>";
    }
}

function loadScript()
{
    loadInitCameraScript();
}

