
document.addEventListener("DOMContentLoaded", function(e) 
{

    console.log("LOADED CONTENT VIEW");
    document.querySelectorAll(".nav-link").forEach(element => {
        console.log("click");
        element.addEventListener("click", async function(e) {
            e.preventDefault();

            try {

                document.querySelectorAll(".nav-link").forEach(l => l.classList.remove("active"));
                this.classList.add("active");

                const page = this.dataset.page;

                const response = await fetch(BASE_URL + page);
                const result = await response.text();
                console.log(result);
                document.getElementById("main_content").innerHTML = result;
            } catch (error) {
                console.log("Error : " + error);
            }
        });
    });
});