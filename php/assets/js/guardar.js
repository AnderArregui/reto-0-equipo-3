function guardar(icon) {
    const idPost = icon.getAttribute('data-id-post');
    const nombreUsuario = "<?php echo $_SESSION['usuario']; ?>";
    const isSaving = icon.src.includes('nosave.png');
    const newIconSrc = isSaving 
        ? '/reto-1-equipo-3/php/assets/images/save.png' 
        : '/reto-1-equipo-3/php/assets/images/nosave.png';

    fetch('index.php?controller=Usuario&action=obtenerIdPorNombre', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nombre_usuario: nombreUsuario })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.id_usuario) {

            fetch('index.php?controller=Guardado&action=guardar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_post: idPost, id_usuario: data.id_usuario, guardar: isSaving })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    icon.src = newIconSrc;
                } else {
                    alert(data.message || "Error al procesar la solicitud.");
                }
            })
            .catch(error => {
                console.error("Error al guardar en la tabla guardados:", error);
            });
        } else {
            alert("Error al obtener el ID de usuario.");
        }
    })
    .catch(error => {
        console.error("Error al obtener el ID del usuario:", error);
    });
}





function like(icon) {

    if (icon.src.includes('nolike.png')) {
        icon.src = '/reto-1-equipo-3/php/assets/images/like.png'; 
    } else {
        icon.src = '/reto-1-equipo-3/php/assets/images/nolike.png';
    }
}


