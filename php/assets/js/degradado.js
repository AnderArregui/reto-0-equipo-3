document.addEventListener("DOMContentLoaded", function () {
    const temas = document.querySelectorAll('.tema');

    temas.forEach(tema => {
        const colorBase = tema.dataset.color; 
        tema.style.setProperty('--color-base', colorBase);
    });
});
