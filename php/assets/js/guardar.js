function guardar(icon) {
    console.log("Icono clicado:", icon);
    const idPost = icon.getAttribute('data-id-post');
    const idUsuario = icon.getAttribute('data-id-usuario');
    const isSaving = icon.src.includes('nosave.png');
    const newIconSrc = isSaving 
        ? '/reto-1-equipo-3/php/assets/images/save.png' 
        : '/reto-1-equipo-3/php/assets/images/nosave.png';

    console.log("src actual:", icon.src, "isSaving:", isSaving);

    fetch('index.php?controller=Guardado&action=guardar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_post: idPost, id_usuario: idUsuario, guardar: isSaving ? 1 : 0 })
    })
    .then(response => response.text())
    .then(data => {
        console.log("Respuesta del servidor:", data);
        const jsonData = JSON.parse(data);
        if (jsonData.success) {
            icon.src = newIconSrc;

            // Añadir nuevo post guardado si se guardó exitosamente
            if (isSaving && jsonData.postGuardado) {
                const guardadosContainer = document.getElementById('guardados-container');

                const divUsuario = document.createElement('div');
                divUsuario.className = 'divUsuario';
                divUsuario.style.border = `2px dashed ${jsonData.postGuardado.caracteristica}`;
                divUsuario.id = `guardado-${jsonData.postGuardado.id_post}`; 

                const h3 = document.createElement('h3');
                const link = document.createElement('a');
                link.href = `index.php?controller=Post&action=respuestas&id_post=${jsonData.postGuardado.id_post}`;
                link.className = 'tema-link';

                const maxCaracteres = 80;
                const contenido = jsonData.postGuardado.contenido.length > maxCaracteres
                    ? jsonData.postGuardado.contenido.substr(0, maxCaracteres) + "..."
                    : jsonData.postGuardado.contenido;
                link.textContent = contenido;

                h3.appendChild(link);
                divUsuario.appendChild(h3);
                guardadosContainer.appendChild(divUsuario);
            } 
            
            else if (!isSaving) {
                const guardadoElement = document.getElementById(`guardado-${idPost}`);
                if (guardadoElement) {
                    guardadoElement.remove();
                }
            }
        } else {
            alert(jsonData.message || "Error al procesar la solicitud.");
        }
    })
    .catch(error => {
        console.error("Error al guardar en la tabla guardados:", error);
    });
}



function agregarAGuardados(postGuardado) {
    const guardadosContainer = document.querySelector('.divAside h2 + div');
    
    // Crear un nuevo elemento para el post guardado
    const postDiv = document.createElement('div');
    postDiv.classList.add('divUsuario');
    postDiv.style.border = `2px dashed ${postGuardado.caracteristica}`;

    // Crear el contenido del post guardado
    const postLink = document.createElement('a');
    postLink.href = `index.php?controller=Post&action=respuestas&id_post=${postGuardado.id_post}`;
    postLink.classList.add('tema-link');
    postLink.innerHTML = postGuardado.contenido.length > 80 
        ? postGuardado.contenido.substring(0, 80) + "..." 
        : postGuardado.contenido;

    const postTitle = document.createElement('h3');
    postTitle.appendChild(postLink);
    postDiv.appendChild(postTitle);

    // Insertar el nuevo post guardado al principio de la lista de "Mis Guardados"
    guardadosContainer.insertBefore(postDiv, guardadosContainer.firstChild);
}

function eliminarDeGuardados(idPost) {
    const guardadosContainer = document.querySelector('.divAside h2 + div');
    const postElements = guardadosContainer.querySelectorAll('.divUsuario');

    // Buscar y eliminar el elemento correspondiente
    postElements.forEach(postElement => {
        const link = postElement.querySelector('a');
        if (link && link.href.includes(`id_post=${idPost}`)) {
            postElement.remove();
        }
    });
}


