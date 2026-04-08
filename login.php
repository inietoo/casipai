<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    // TODO: verificar con DB
    if (empty($username) || empty($password)) {
        $error = 'Por favor rellena todos los campos.';
    }
}
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión — CASIPAI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..800&family=Inter:wght@300..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="auth-wrapper">
  <div class="auth-card">
    <div class="auth-logo">
      <div class="logo-text">CASIPAI</div>
      <div class="logo-sub">Casino para amigos · LAN Edition</div>
    </div>
    <?php if ($error): ?>
    <div class="alert alert-error" style="margin-bottom:1.25rem;">
      <span>⚠</span><span><?= htmlspecialchars($error) ?></span>
    </div>
    <?php endif; ?>
    <form class="auth-form" method="POST" action="login.php" novalidate>
      <div class="form-group">
        <label class="form-label" for="username">Usuario</label>
        <input class="form-input" type="text" id="username" name="username"
               placeholder="Tu nombre de usuario" autocomplete="username" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Contraseña</label>
        <input class="form-input" type="password" id="password" name="password"
               placeholder="••••••••" autocomplete="current-password" required>
      </div>
      <button class="btn btn-primary btn-lg" type="submit" style="width:100%;margin-top:.5rem;">
        Entrar al casino
      </button>
    </form>
    <div class="auth-footer">
      ¿No tienes cuenta? <a href="register.php">Crear cuenta</a>
    </div>
  </div>
</div>
</body>
</html>
