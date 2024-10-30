document.querySelectorAll('.orden-control a').forEach(link => {
    link.addEventListener('click', (event) => {
        localStorage.setItem('scrollPosition', window.scrollY);
        

        document.querySelectorAll('.orden-control a').forEach(el => {
            el.classList.remove('active');
        });
        

        event.target.classList.add('active');
    });
});

window.addEventListener('load', () => {
    const scrollPosition = localStorage.getItem('scrollPosition');
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        localStorage.removeItem('scrollPosition'); 
    }


    const urlParams = new URLSearchParams(window.location.search);
    const tipo = urlParams.get('tipo');
    if (tipo) {
        document.querySelector(`.orden-control a[href*="${tipo}"]`).classList.add('active');
    }
});
