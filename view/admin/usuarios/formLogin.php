<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <header>
        <h1>Iniciar Sesión</h1>
    </header>
    <main>
        <form action="index.php?C=usuario&M=login" method="POST">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
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
