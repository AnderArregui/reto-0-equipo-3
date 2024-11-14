function nota() {
    const noteContent = document.querySelector('.note-textarea').value;
    document.cookie = `note=${encodeURIComponent(noteContent)}; path=/; max-age=${60 * 60 * 24 * 30}`; // Cookie con una duración de 30 días
}

// Función para leer la cookie y cargar el contenido en el textarea
function loadNote() {
    const cookies = document.cookie.split('; ');
    const noteCookie = cookies.find(row => row.startsWith('note='));
    if (noteCookie) {
        const noteContent = decodeURIComponent(noteCookie.split('=')[1]);
        document.querySelector('.note-textarea').value = noteContent;
    }
}

// Cargar la nota cuando la página se carga
window.onload = loadNote;