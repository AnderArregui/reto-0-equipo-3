document.addEventListener("DOMContentLoaded", function () {
    const temas = document.querySelectorAll('.tema');

    temas.forEach(tema => {
        const colorBase = tema.dataset.color; 
        tema.style.setProperty('--color-base', colorBase);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const preguntas = document.querySelectorAll('.tema');

    temas.forEach(tema => {
        const colorPregunta = pregunta.dataset.color; 
        pregunta.style.setProperty('--color-pregunta', colorPregunta);
    });
});



