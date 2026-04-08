<?php
session_start();
$page_title = 'Mi perfil';
$username   = $_SESSION['username'] ?? 'Jugador';
$initials   = strtoupper(substr($username, 0, 2));
$balance    = $_SESSION['balance']  ?? 5000;
$stats = ['Partidas'=>142,'Victorias'=>68,'Ganadas'=>'24,500 🪙','Perdidas'=>'18,200 🪙'];
$history = [
  ['Blackjack','21/04/2026','Victoria','+1,200 🪙','badge-green'],
  ['Ruleta',   '21/04/2026','Derrota', '-300 🪙',  'badge-red'],
  ['Slots',    '20/04/2026','Victoria','+550 🪙',   'badge-green'],
  ['Póker',    '20/04/2026','Derrota', '-800 🪙',   'badge-red'],
  ['Blackjack','19/04/2026','Victoria','+2,400 🪙', 'badge-green'],
];
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil — CASIPAI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..800&family=Inter:wght@300..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="app-layout">
  <?php include 'views/layout/header.php'; ?>
  <div class="main-area">
    <main class="page-content">
      <div class="profile-header">
        <div class="avatar lg"><?= htmlspecialchars($initials) ?></div>
        <div>
          <h2 style="font-size:var(--text-xl);font-weight:700"><?= htmlspecialchars($username) ?></h2>
          <p style="color:var(--color-text-muted);font-size:var(--text-sm)">Jugador · Miembro desde abril 2026</p>
          <span class="badge badge-gold" style="margin-top:.5rem">🪙 <?= number_format($balance) ?> fichas</span>
        </div>
        <div class="profile-stats">
          <?php foreach ($stats as $lbl => $val): ?>
          <div class="profile-stat"><div class="profile-stat-val"><?= $val ?></div><div class="profile-stat-lbl"><?= $lbl ?></div></div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="tabs">
        <button class="tab-btn active" id="tab-history" onclick="showTab('history')">Historial</button>
        <button class="tab-btn" id="tab-settings" onclick="showTab('settings')">Ajustes</button>
      </div>
      <div id="panel-history">
        <div class="table-wrap">
          <table class="data-table">
            <thead><tr><th>Juego</th><th>Fecha</th><th>Resultado</th><th>Fichas</th></tr></thead>
            <tbody>
              <?php foreach ($history as [$game,$date,$result,$amount,$badge]): ?>
              <tr><td><?= $game ?></td><td style="color:var(--color-text-muted)"><?= $date ?></td><td><span class="badge <?= $badge ?>"><?= $result ?></span></td><td><?= $amount ?></td></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="panel-settings" style="display:none;max-width:480px">
        <div class="card">
          <h3 style="font-size:var(--text-lg);margin-bottom:var(--space-5)">Cambiar contraseña</h3>
          <form class="auth-form" style="gap:var(--space-4)">
            <div class="form-group"><label class="form-label">Contraseña actual</label><input class="form-input" type="password" placeholder="••••••••"></div>
            <div class="form-group"><label class="form-label">Nueva contraseña</label><input class="form-input" type="password" placeholder="Mínimo 6 caracteres"></div>
            <div class="form-group"><label class="form-label">Confirmar nueva contraseña</label><input class="form-input" type="password" placeholder="Repite la contraseña"></div>
            <button class="btn btn-primary" type="submit">Guardar cambios</button>
          </form>
        </div>
      </div>
    </main>
  </div>
</div>
<script>
function showTab(tab) {
  document.getElementById('panel-history').style.display  = tab==='history'  ? '' : 'none';
  document.getElementById('panel-settings').style.display = tab==='settings' ? '' : 'none';
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
  document.getElementById('tab-'+tab).classList.add('active');
}
document.getElementById('sidebarToggle')?.addEventListener('click',()=>document.getElementById('sidebar').classList.toggle('open'));
</script>
</body>
</html>
