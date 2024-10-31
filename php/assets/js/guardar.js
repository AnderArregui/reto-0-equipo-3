function guardar(icon) {
    console.log("Icono clicado:", icon);
    const idPost = icon.getAttribute('data-id-post');
    const idUsuario = icon.getAttribute('data-id-usuario');
    const isSaving = icon.src.includes('nosave.png');
    const newIconSrc = isSaving 
        ? '/reto-1-equipo-3/php/assets/images/save.png' 
        : '/reto-1-equipo-3/php/assets/images/nosave.png';

    console.log("src actual:", icon.src, "isSaving:", isSaving); // Añadir console log

    fetch('index.php?controller=Guardado&action=guardar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_post: idPost, id_usuario: idUsuario, guardar: isSaving ? 1 : 0 })
    })
    .then(response => {
        return response.text();
    })
    .then(data => {
        console.log("Respuesta del servidor:", data);
        const jsonData = JSON.parse(data);
        if (jsonData.success) {
            icon.src = newIconSrc;
        } else {
            alert(jsonData.message || "Error al procesar la solicitud.");
        }
    })
    .catch(error => {
        console.error("Error al guardar en la tabla guardados:", error);
    })
}





function like(icon) {

    if (icon.src.includes('nolike.png')) {
        icon.src = '/reto-1-equipo-3/php/assets/images/like.png'; 
    } else {
        icon.src = '/reto-1-equipo-3/php/assets/images/nolike.png';
    }
}


