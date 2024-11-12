const div = document.getElementById('visualizacion');

// Al hacer click en un elemento, se queda activado el perfil
function setActive(element) {
    // Primero elimina la clase 'active' de todos los enlaces
    document.querySelectorAll('#menuPerfil a').forEach(link => {
        link.classList.remove('active');
    });
    
    // Luego añade la clase 'active' al enlace actual
    element.classList.add('active');
}

// Definir la función perfil como global
function perfil(usuario) {
    fetch('/reto-1-equipo-3/php/view/usuario/perfil/verperfil.html.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario) // Enviar el objeto usuario convertido en JSON
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al cargar la página: ' + response.statusText);
        }
        return response.text();
    })
    .then(data => {
        // Inserta el contenido HTML en el contenedor
        document.getElementById("visualizacion").innerHTML = data;
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud Fetch:', error);
    });     
}

function obtenerPreguntasPorUsuario(posts) {
    fetch('/reto-1-equipo-3/php/view/usuario/preguntas/gestionarpreguntas.html.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(posts)

    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar los posts: ' + response.statusText);
            }
            return response.text();
        })
        .then(data => {
            // Inserta el contenido HTML de los posts en el contenedor
            document.getElementById("visualizacion").innerHTML = data;
        })
        .catch(error => {
            console.error('Hubo un problema con la solicitud Fetch:', error);
        });
}

function obtenerRespuestasPorUsuario(respuestas) {
    fetch('/reto-1-equipo-3/php/view/usuario/respuestas/gestionarrespuestas.html.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(respuestas)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar los posts: ' + response.statusText);
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("visualizacion").innerHTML = data;
        })
        .catch(error => {
            console.error('Hubo un problema con la solitud Fetch:', error);
        });
}

