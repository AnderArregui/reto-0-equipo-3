function uploadImage(input) {
    const file = input.files[0];
    if (file) {
        const formData = new FormData();
        formData.append("fotoPerfil", file);

        fetch("/reto-1-equipo-3/php/controlador/UsuarioController.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                document.querySelector(".perfil img").src = data.newImageUrl;
            } else {
                alert("Error al cambiar la imagen");
            }
        })
        .catch(error => {
            console.error("Error al subir la imagen:", error);
        });
    }
}
