
        function cajaTema() {
            const nuevoTemaInput = document.getElementById("nuevo_tema");
            const crearCheckbox = document.getElementById("crear");

            if (crearCheckbox.checked) {
                nuevoTemaInput.style.display = "block"; 
            } else {
                nuevoTemaInput.style.display = "none"; 
            }
        }

