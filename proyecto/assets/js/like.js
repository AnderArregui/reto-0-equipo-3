function like(icon) {
    const idRespuesta = icon.getAttribute('data-id-respuesta');
    const idUsuario = icon.getAttribute('data-id-usuario');
    const isLiking = icon.getAttribute('data-liked') === 'false'; // Verifica si el usuario no ha dado like

    const newIconSrc = isLiking 
        ? '/assets/images/like.png' // Cambia a like.png si el usuario da like
        : '/assets/images/nolike.png'; // Cambia a nolike.png si el usuario quita el like
    const newLikedState = isLiking ? 'true' : 'false'; // Cambia el estado de "liked"

    // Enviar solicitud al servidor para guardar el estado del like en la base de datos
    fetch('index.php?controller=Respuesta&action=darLike', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            id_respuesta: idRespuesta, 
            id_usuario: idUsuario, 
            like: isLiking ? 1 : 0
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cambiar el icono solo si la operación fue exitosa
            icon.src = newIconSrc;
            icon.setAttribute('data-liked', newLikedState);

            // Actualizar el contador de likes
            const likeCountElement = icon.closest('.postInfo').querySelector('.like-count');
            if (likeCountElement) {
                likeCountElement.textContent = data.likes;
            }
        } else {
            // Si algo salió mal, revertir el cambio en el icono
            alert(data.message || "Error al procesar el like.");
        }
    })
    .catch(error => {
        console.error("Error al dar like:", error);
        // Si hay un error en la solicitud, revertir el cambio de icono
        icon.src = icon.src.includes('nolike.png') 
            ? '/assets/images/like.png' 
            : '/assets/images/nolike.png';
    });
}






function agregarALikes(likeData) {
    const likesContainer = document.getElementById('likes-container');

    const likeDiv = document.createElement('div');
    likeDiv.className = 'likeItem';
    likeDiv.id = `like-${likeData.id_respuesta}`;

    const link = document.createElement('a');
    link.href = `index.php?controller=Respuesta&action=verRespuesta&id_respuesta=${likeData.id_respuesta}`;
    link.textContent = likeData.contenido.length > 80 
        ? likeData.contenido.substr(0, 80) + "..." 
        : likeData.contenido;

    likeDiv.appendChild(link);
    likesContainer.insertBefore(likeDiv, likesContainer.firstChild);
}

function eliminarDeLikes(idRespuesta) {
    const likeElement = document.getElementById(`like-${idRespuesta}`);
    if (likeElement) {
        likeElement.remove();
    }
}
