const mobileMenuBtn = document.querySelector("#mobile-menu");
const closeMenuBtn = document.querySelector("#close-menu");
const sidebar = document.querySelector(".sidebar");
const bodyElement = document.querySelector("body");
const contentDashboard = document.querySelector(".content-dashboard");
const bins = document.querySelectorAll(".delete-project-a");

if (bins) {
    bins.forEach(bin => {
        bin.addEventListener("click", function () {
            event.preventDefault();
            const projectId = bin.dataset.projectId;
            const userId = bin.dataset.projectUserid;
        
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar este proyecto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, estoy seguro',
                cancelButtonText: 'No'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = `/remove-project?id=${projectId}&userId=${userId}`;
                }
            })
        })
    })
}

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", function () {
        sidebar.classList.add("show");
        bodyElement.classList.add("block")
        contentDashboard.style.display = "none"
    })
}

if (closeMenuBtn) {
    closeMenuBtn.addEventListener("click", function () {

        sidebar.classList.add("hide");
        bodyElement.classList.remove("block")
        contentDashboard.style.display = "block"

        setTimeout(() => {
            sidebar.classList.remove("show");
            sidebar.classList.remove("hide");

        }, 500);

    })
}

//Remove show class on a size more tall than tablet
window.addEventListener("resize", function () {
    const widthScreen = document.body.clientWidth;
    if (widthScreen >= 768) {
        sidebar.classList.remove("show")
        contentDashboard.style.display = "block"
    }
})