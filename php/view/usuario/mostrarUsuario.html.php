<div id="usuariosContainer" class="containerUsuario mx-auto p-4">
    <div id="usuariosGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Users will be dynamically inserted here -->
    </div>
    <div id="loadMoreContainer" class="mt-4 text-center">
        <button id="loadMoreButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
           
        </button>
    </div>
    <p id="noMoreUsers" class="mt-4 text-center text-gray-600" style="display: none;">
       
    </p>
    <p id="noUsers" class="text-center text-gray-600" style="display: none;">
        No se encontraron usuarios.
    </p>
    <?php if ($_SESSION['usuario']['tipo'] === 'admin'): ?>
    <div class="mt-4 text-center">
        <a href="index.php?controller=Usuario&action=crearNuevoUsuario" class="crearUsuario">
            Crear Usuario
        </a>
    </div>
    <?php endif; ?>
</div>

<script>
let page = 1;
let isLoading = false;
let hasMore = true;

function loadUsers() {
    if (isLoading || !hasMore) return;
    isLoading = true;
    document.getElementById('loadMoreButton').textContent = 'Cargando...';

    fetch(`index.php?controller=Usuario&action=obtenerUsuariosPaginados&page=${page}&limit=12`)
        .then(response => response.json())
        .then(data => {
            const usuariosGrid = document.getElementById('usuariosGrid');
            data.usuarios.forEach(usuario => {
                usuariosGrid.innerHTML += `
                    <a href="index.php?controller=Usuario&action=usuarioindividual&id_usuario=${usuario.id_usuario}" class="block">
                        <div class="p-4 border rounded-lg ${!usuario.foto ? 'bg-gray-100' : ''}">
                            ${usuario.foto ? `<img src="${usuario.foto}" alt="Imagen de ${usuario.nombre}" class="w-full h-32 object-cover mb-2 rounded">` : ''}
                            <h3 class="text-lg font-semibold">${usuario.nombre}</h3>
                            <p class="text-sm text-gray-600">${usuario.email}</p>
                        </div>
                    </a>
                `;
            });

            hasMore = data.hasMore;
            if (!hasMore) {
                document.getElementById('loadMoreContainer').style.display = 'none';
                document.getElementById('noMoreUsers').style.display = 'block';
            }

            page++;
            isLoading = false;
            document.getElementById('loadMoreButton').textContent = '';

            if (usuariosGrid.children.length === 0) {
                document.getElementById('noUsers').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error fetching users:', error);
            isLoading = false;
            document.getElementById('loadMoreButton').textContent = '';
        });
}

document.getElementById('loadMoreButton').addEventListener('click', loadUsers);

// Detectar cuando el usuario haya llegado al final de la página
window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 10) {
        // Solo ejecuta si no se está cargando más usuarios
        if (!isLoading && hasMore) {
            loadUsers();
        }
    }
});

// Carga inicial
loadUsers();

</script>