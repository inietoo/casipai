<?php
session_start();
$page_title = 'Panel de administración';
$users = [
  ['id'=>1,'username'=>'MikelEtxe', 'role'=>'admin', 'balance'=>12500,'status'=>'online', 'joined'=>'01/04/2026'],
  ['id'=>2,'username'=>'SaraMadrid','role'=>'player','balance'=>8300, 'status'=>'online', 'joined'=>'02/04/2026'],
  ['id'=>3,'username'=>'JuanLopez', 'role'=>'player','balance'=>3700, 'status'=>'online', 'joined'=>'03/04/2026'],
  ['id'=>4,'username'=>'Ana_Gamer', 'role'=>'player','balance'=>900,  'status'=>'offline','joined'=>'05/04/2026'],
  ['id'=>5,'username'=>'PepeRules', 'role'=>'player','balance'=>6200, 'status'=>'offline','joined'=>'07/04/2026'],
];
$rooms = [
  ['id'=>1,'game'=>'Blackjack','host'=>'MikelEtxe', 'players'=>'2/4','status'=>'active'],
  ['id'=>2,'game'=>'Ruleta',   'host'=>'SaraMadrid','players'=>'3/6','status'=>'active'],
  ['id'=>3,'game'=>'Slots',    'host'=>'JuanLopez', 'players'=>'1/4','status'=>'active'],
];
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — CASIPAI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..800&family=Inter:wght@300..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
<div class="app-layout">
  <?php include '../views/layout/header.php'; ?>
  <div class="main-area">
    <main class="page-content">
      <div class="kpi-grid" style="margin-bottom:var(--space-8)">
        <div class="kpi-card"><div class="kpi-label">Total usuarios</div><div class="kpi-value"><?= count($users) ?></div></div>
        <div class="kpi-card"><div class="kpi-label">En línea ahora</div><div class="kpi-value"><?= count(array_filter($users,fn($u)=>$u['status']==='online')) ?></div></div>
        <div class="kpi-card"><div class="kpi-label">Salas activas</div><div class="kpi-value"><?= count($rooms) ?></div></div>
        <div class="kpi-card"><div class="kpi-label">Fichas en circulación</div><div class="kpi-value"><?= number_format(array_sum(array_column($users,'balance'))) ?></div></div>
      </div>
      <div class="tabs">
        <button class="tab-btn active" onclick="showAdminTab('users')">Usuarios</button>
        <button class="tab-btn" onclick="showAdminTab('rooms')">Salas activas</button>
        <button class="tab-btn" onclick="showAdminTab('economy')">Economía</button>
      </div>
      <div id="admin-users">
        <div style="display:flex;align-items:center;gap:var(--space-3);margin-bottom:var(--space-4)">
          <input class="form-input" type="search" placeholder="Buscar usuario…" style="max-width:280px">
        </div>
        <div class="table-wrap">
          <table class="data-table">
            <thead><tr><th>#</th><th>Usuario</th><th>Rol</th><th>Fichas</th><th>Estado</th><th>Registro</th><th>Acciones</th></tr></thead>
            <tbody>
              <?php foreach ($users as $u): ?>
              <tr>
                <td style="color:var(--color-text-muted)"><?= $u['id'] ?></td>
                <td style="font-weight:600"><?= htmlspecialchars($u['username']) ?></td>
                <td><span class="badge <?= $u['role']==='admin'?'badge-gold':'badge-gray' ?>"><?= $u['role'] ?></span></td>
                <td><?= number_format($u['balance']) ?></td>
                <td><span class="badge <?= $u['status']==='online'?'badge-green':'badge-gray' ?>"><?= $u['status'] ?></span></td>
                <td style="color:var(--color-text-muted)"><?= $u['joined'] ?></td>
                <td><button class="btn btn-ghost btn-sm">Editar</button> <button class="btn btn-ghost btn-sm" style="color:var(--color-error)">Banear</button></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="admin-rooms" style="display:none">
        <div class="table-wrap">
          <table class="data-table">
            <thead><tr><th>#</th><th>Juego</th><th>Anfitrión</th><th>Jugadores</th><th>Estado</th><th>Acción</th></tr></thead>
            <tbody>
              <?php foreach ($rooms as $r): ?>
              <tr><td style="color:var(--color-text-muted)"><?= $r['id'] ?></td><td style="font-weight:600"><?= $r['game'] ?></td><td><?= $r['host'] ?></td><td><?= $r['players'] ?></td><td><span class="badge badge-green"><?= $r['status'] ?></span></td><td><button class="btn btn-ghost btn-sm" style="color:var(--color-error)">Cerrar sala</button></td></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="admin-economy" style="display:none;max-width:480px">
        <div class="card">
          <h3 style="font-size:var(--text-lg);margin-bottom:var(--space-5)">Ajustar fichas de usuario</h3>
          <form class="auth-form" style="gap:var(--space-4)">
            <div class="form-group"><label class="form-label">Usuario</label><input class="form-input" type="text" placeholder="Nombre de usuario"></div>
            <div class="form-group"><label class="form-label">Cantidad (puede ser negativa)</label><input class="form-input" type="number" placeholder="ej. 1000 o -500"></div>
            <div class="form-group"><label class="form-label">Motivo</label><input class="form-input" type="text" placeholder="Corrección de error, bonus…"></div>
            <button class="btn btn-primary" type="submit">Aplicar ajuste</button>
          </form>
        </div>
      </div>
    </main>
  </div>
</div>
<script>
function showAdminTab(tab){
  ['users','rooms','economy'].forEach(t=>document.getElementById('admin-'+t).style.display=t===tab?'':'none');
  document.querySelectorAll('.tab-btn').forEach((b,i)=>b.classList.toggle('active',['users','rooms','economy'][i]===tab));
}
document.getElementById('sidebarToggle')?.addEventListener('click',()=>document.getElementById('sidebar').classList.toggle('open'));
</script>
</body>
</html>
