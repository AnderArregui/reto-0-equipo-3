function uploadImage(input) {
    const file = input.files[0];
    if (file) {
        const formData = new FormData();
        formData.append("fotoPerfil", file);

        fetch("index.php?controller=Usuario&action=actualizarImagenPerfil", {
            method: "POST",
            body: formData
        })
        .then(response => response.text()) // Usamos .text() para inspeccionar la respuesta completa
        .then(text => {
            console.log("Texto de respuesta:", text); // Verificar el contenido completo en consola
            location.reload();

            try {
                const data = JSON.parse(text);
                
                if (data.success) {
                    document.querySelector(".perfil img").src = data.newImageUrl;
                } else {
                    alert(data.message || "Hubo un error al actualizar la imagen.");
                }
            } catch (error) {
                console.error("Error al parsear JSON:", error);
                console.log("Respuesta completa del servidor:", text);
            }
        })
        .catch(error => {
            console.error("Error al subir la imagen:", error);
        });
    }
}
