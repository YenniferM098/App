<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="App/view/css/styles.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="App/View/Admin/img/logo.png" alt="Bienes Raíces">
        <label for="">Bienes Raíces</label>
    </div>
    <div class="user-actions">
        <select class="login" required onchange="window.location.href = this.value;">
            <option class="login" value="">Iniciar Sesión</option>
            <option class="login" value="App/admin/formLoginView.php">Iniciar Sesión para Admin</option>
            <option class="login" value="App/usuarios/formLoginView.php">Iniciar Sesión para Usuarios</option>
        </select>
        <select class="start" required onchange="window.location.href = this.value;">
            <option class="login" value="">Registrarse</option>
            <option class="login" value="../usuarios/formRegistroView.php">Registrarse como Usuario</option>
        </select>
    </div>
</header>
    <main>
        <section class="hero">
            <h1>Encuentra tu Propiedad Ideal en Bienes Raíces</h1>
        </section>
        <section class="images-grid">
            <div class="image"><img src="../../img/property1.jpg" alt="Propiedad 1"></div>
            <div class="image"><img src="../../img/property2.jpg" alt="Propiedad 2"></div>
            <div class="image"><img src="../../img/property3.jpg" alt="Propiedad 3"></div>
            <div class="image"><img src="../../img/property4.jpg" alt="Propiedad 4"></div>
            <div class="image"><img src="../../img/property5.jpg" alt="Propiedad 5"></div>
        </section>
    </main>
    <footer>
    <div class="footer-content">
        <div class="footer-section">
            <h2>Acerca de Nosotros</h2>
            <p>Información sobre la empresa.</p>
        </div>
        <div class="footer-section">
            <h2>Contacto</h2>
            <p>Email: info@bienesraices.com</p>
            <p>Teléfono: +52 123 456 7890</p>
        </div>
        <div class="footer-section">
            <h2>Síguenos</h2>
            <p>Enlaces a redes sociales.</p>
        </div>
    </div>
</footer>

</body>
</html>
