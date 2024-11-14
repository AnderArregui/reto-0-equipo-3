document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('toggle-theme');


    const isChecked = localStorage.getItem('themeToggleChecked') === 'true';
    checkbox.checked = isChecked;


    checkbox.addEventListener('change', function() {
        localStorage.setItem('themeToggleChecked', checkbox.checked);
        toggleTheme(checkbox.checked);
    });


    function toggleTheme(isDarkMode) {
        if (isDarkMode) {
            document.body.classList.add('dark-theme');
        } else {
            document.body.classList.remove('dark-theme');
        }
    }

    toggleTheme(isChecked);
});
