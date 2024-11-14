function confirmarEliminacion(event) {
    // Evitar que se recargue la página
    event.preventDefault();

    // Encontrar el div contenedor de la pregunta
    const preguntaDiv = event.target.closest('.pregunta');
    
    // Ocultar el botón eliminar y mostrar los botones de confirmación y cancelación
    const eliminarBtn = preguntaDiv.querySelector('.eliminarBtn');
    eliminarBtn.style.visibility = 'hidden'; // Eliminar el botón

    // Mostrar los botones de confirmación y cancelación
    const confirmacionDiv = preguntaDiv.querySelector('.confirmacion');
    confirmacionDiv.style.display = 'block';

    // Cambiar el fondo de la pregunta cuando se hace clic en Eliminar
    preguntaDiv.style.backgroundColor = '#600404'; // Color rojo
}

function eliminarPregunta(event) {
    // Evitar que se recargue la página
    event.preventDefault();

    // Enviar el formulario para eliminar la pregunta
    const preguntaDiv = event.target.closest('.pregunta');
    const form = preguntaDiv.querySelector('#formEliminarPregunta');
    form.submit(); // Enviar el formulario

    // Cambiar el fondo de la pregunta después de eliminarla
    preguntaDiv.style.backgroundColor = '#8b0000'; // Color más oscuro de rojo
}

function cancelarEliminacion(event) {
    // Evitar que se recargue la página
    event.preventDefault();

    // Encontrar el div contenedor de la pregunta
    const preguntaDiv = event.target.closest('.pregunta');
    
    // Volver a mostrar el botón eliminar y ocultar los botones de confirmación y cancelación
    const eliminarBtn = preguntaDiv.querySelector('.eliminarBtn');
    eliminarBtn.style.visibility = 'visible'; // Volver a mostrar el botón

    // Ocultar los botones de confirmación y cancelación
    const confirmacionDiv = preguntaDiv.querySelector('.confirmacion');
    confirmacionDiv.style.display = 'none';

    // Restaurar el fondo de la pregunta
    preguntaDiv.style.backgroundColor = ''; // Restaurar el fondo original
}
