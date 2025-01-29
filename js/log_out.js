const logoutButton = document.getElementById('logoutButton');

// Añadir un evento de clic al botón
logoutButton.addEventListener('click', function() {
    // Preguntar si el usuario está seguro de cerrar sesión
    const confirmLogout = confirm("¿Estás seguro de que deseas cerrar sesión?");

    // Si el usuario confirma, proceder a cerrar sesión
    if (confirmLogout) {
        // Aquí puedes agregar la lógica para cerrar sesión
        // Ejemplo: Redirigir a la página de cierre de sesión o realizar una acción
        alert("Has cerrado sesión correctamente.");
        window.location.href = '../conexionphp/logout.php';  // Cambia '/logout' por la URL que maneje el cierre de sesión
    } else {
        // Si el usuario cancela, no hacer nada
       
    }
});