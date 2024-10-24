
function guardar(icon) {

    if (icon.src.includes('nosave.png')) {
        icon.src = '/reto-1-equipo-3/php/assets/images/save.png'; 
    } else {
        icon.src = '/reto-1-equipo-3/php/assets/images/nosave.png';
    }
}
