const imgJefes = document.querySelectorAll('.imgJefes');

imgJefes.forEach((img, index) => {
    const originalSrc = img.src; 
    const hoverSrc = `/assets/images/jefe${index + 1}_hover.png`; 

    img.addEventListener('mouseenter', () => {
        img.src = hoverSrc; 
    });

    img.addEventListener('mouseleave', () => {
        img.src = originalSrc; 
    });
});
