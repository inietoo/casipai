<?php
$error = ''; $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';
    if (empty($username) || empty($password) || empty($confirm)) {
        $error = 'Por favor rellena todos los campos.';
    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } elseif ($password !== $confirm) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        // TODO: insertar en DB con password_hash()
        $success = '¡Cuenta creada! Ya puedes iniciar sesión.';
    }
}
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cuenta — CASIPAI</title>
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
      <div class="logo-sub">Únete a la partida</div>
    </div>
    <?php if ($error): ?>
    <div class="alert alert-error" style="margin-bottom:1.25rem;"><span>⚠</span><span><?= htmlspecialchars($error) ?></span></div>
    <?php endif; ?>
    <?php if ($success): ?>
    <div class="alert alert-success" style="margin-bottom:1.25rem;"><span>✓</span><span><?= htmlspecialchars($success) ?></span></div>
    <?php endif; ?>
    <form class="auth-form" method="POST" action="register.php" novalidate>
      <div class="form-group">
        <label class="form-label" for="username">Nombre de usuario</label>
        <input class="form-input" type="text" id="username" name="username" placeholder="Elige un alias" maxlength="24" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Contraseña</label>
        <input class="form-input" type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="confirm">Confirmar contraseña</label>
        <input class="form-input" type="password" id="confirm" name="confirm" placeholder="Repite la contraseña" required>
      </div>
      <button class="btn btn-green btn-lg" type="submit" style="width:100%;margin-top:.5rem;">Crear cuenta</button>
    </form>
    <div class="auth-footer">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></div>
  </div>
</div>
</body>
</html>
