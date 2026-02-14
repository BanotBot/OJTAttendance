
document.querySelector(".nav-link").forEach(element => {
    element.addEventListener("click", async function(e){
        e.preventDefault();

        try {

            document.querySelectorAll(".nav-link").forEach(l => l.classList.remove("active"));
            this.classList.add("active");            

            const page = this.dataset.page;

            const response = await fetch(`<?php base_url('students_ojt/') ?>${page}`, {

            });

            const result = response.text();
            document.getElementById("main_content").innerHTML = result;
        } catch (error) {
            console.log("Error : " + error);
        }
    });
});