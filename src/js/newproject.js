//IIFE for that the variables can't exists in other js archives
(function () {

    const inputProject = document.querySelector("#project");

    inputProject.addEventListener("input", function () {

        const value = inputProject.value;

        if (value.length >= 25) {
            inputProject.value = value.substring(0, 25); // Trunca el texto a 25 caracteres
            Swal.fire('Se ha alcanzado el límite de 25 caracteres, el título del proyecto debe ser mas corto.')
        }

    })


    document.querySelector(".form").addEventListener("submit", function (event) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let checkedCount = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        });

        if (checkedCount === 0) {
            Swal.fire('Debes seleccionar al menos una etiqueta para tu proyecto.');
            event.preventDefault();
        } else if (checkedCount > 3) {
            Swal.fire("Un proyecto no puede tener más de 3 etiquetas.")
            event.preventDefault();
        }
    });

})();