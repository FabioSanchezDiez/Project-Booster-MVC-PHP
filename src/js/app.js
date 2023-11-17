const mobileMenuBtn = document.querySelector("#mobile-menu");
const closeMenuBtn = document.querySelector("#close-menu");
const sidebar = document.querySelector(".sidebar");
const bodyElement = document.querySelector("body");
const contentDashboard = document.querySelector(".content-dashboard");

//Generalize the delete action on projects and calendar entries
const binsForProjects = document.querySelectorAll('.bin-for-projects');
handleBinClick(binsForProjects, '/remove-project');
const binsForCalendarEntries = document.querySelectorAll('.bin-for-calendar-entries');
handleBinClick(binsForCalendarEntries, '/remove-calendar');

function handleBinClick(bins, removalUrl) {
    if (bins) {
        bins.forEach(bin => {
            bin.addEventListener("click", function (event) {
                event.preventDefault();
                const itemId = bin.dataset.itemId;
                const userId = bin.dataset.itemUserid;

                Swal.fire({
                    title: '¿Estás seguro de que quieres eliminar este elemento?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, estoy seguro',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `${removalUrl}?id=${itemId}&userId=${userId}`;
                    }
                });
            });
        });
    }
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