<?php
session_start();
$page_title = 'Lobby';
$games = [
  ['emoji'=>'🎰','name'=>'Slots',     'desc'=>'Gira los carretes y gana.',        'status'=>'available','players'=>3],
  ['emoji'=>'♠️','name'=>'Blackjack', 'desc'=>'Plántate o pide hasta 21.',        'status'=>'available','players'=>2],
  ['emoji'=>'🎡','name'=>'Ruleta',    'desc'=>'Apuesta al número de la suerte.',  'status'=>'available','players'=>5],
  ['emoji'=>'🃏','name'=>'Póker',     'desc'=>"Texas Hold'em para 2-6 jugadores",'status'=>'available','players'=>4],
  ['emoji'=>'🎲','name'=>'Dados',     'desc'=>'Craps básico, apuesta y lanza.',   'status'=>'soon',     'players'=>0],
  ['emoji'=>'🐴','name'=>'Carreras',  'desc'=>'Apuesta por el caballo ganador.',  'status'=>'soon',     'players'=>0],
];
$active_rooms = [
  ['game'=>'Blackjack','emoji'=>'♠️','host'=>'MikelEtxe', 'current'=>2,'max'=>4,'id'=>1],
  ['game'=>'Ruleta',   'emoji'=>'🎡','host'=>'SaraMadrid','current'=>3,'max'=>6,'id'=>2],
  ['game'=>'Slots',    'emoji'=>'🎰','host'=>'JuanLopez', 'current'=>1,'max'=>4,'id'=>3],
];
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lobby — CASIPAI</title>
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
      <div class="kpi-grid" style="margin-bottom:var(--space-8)">
        <div class="kpi-card"><div class="kpi-label">Tus fichas</div><div class="kpi-value">5,000</div><div class="kpi-delta up">▲ +200 hoy</div></div>
        <div class="kpi-card"><div class="kpi-label">Jugadores en línea</div><div class="kpi-value">7</div></div>
        <div class="kpi-card"><div class="kpi-label">Salas activas</div><div class="kpi-value">3</div></div>
        <div class="kpi-card"><div class="kpi-label">Tu mejor racha</div><div class="kpi-value">×4.2</div><div class="kpi-delta up">Blackjack</div></div>
      </div>
      <div class="page-header">
        <div class="page-header-left"><h1>Juegos disponibles</h1><p>Elige tu juego y entra a una sala o crea la tuya</p></div>
      </div>
      <div class="games-grid">
        <?php foreach ($games as $g): ?>
        <div class="game-card" onclick="window.location='game.php?game=<?= urlencode($g['name']) ?>'">
          <div class="game-card-thumb" style="background:radial-gradient(ellipse at center,var(--color-surface-offset),var(--color-bg))">
            <?= $g['emoji'] ?>
          </div>
          <div class="game-card-body">
            <div class="game-card-title"><?= htmlspecialchars($g['name']) ?></div>
            <div class="game-card-desc"><?= htmlspecialchars($g['desc']) ?></div>
            <div class="game-card-footer">
              <span class="game-badge <?= $g['status'] ?>"><?= $g['status']==='available'?'● Disponible':'⏳ Próximamente' ?></span>
              <?php if ($g['players']): ?><span style="font-size:var(--text-xs);color:var(--color-text-muted)"><?= $g['players'] ?> jugando</span><?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="divider"></div>
      <div class="page-header">
        <div class="page-header-left"><h1>Salas abiertas</h1><p>Únete a una partida en marcha</p></div>
        <a href="game.php?action=create" class="btn btn-primary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Crear sala
        </a>
      </div>
      <div class="rooms-list">
        <?php foreach ($active_rooms as $r): ?>
        <div class="room-row">
          <div class="room-icon"><?= $r['emoji'] ?></div>
          <div class="room-info">
            <div class="room-name"><?= htmlspecialchars($r['game']) ?> · Sala de <?= htmlspecialchars($r['host']) ?></div>
            <div class="room-meta">Anfitrión: <?= htmlspecialchars($r['host']) ?></div>
          </div>
          <div class="room-players">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            <?= $r['current'] ?>/<?= $r['max'] ?>
          </div>
          <a href="game.php?room=<?= $r['id'] ?>" class="btn btn-green btn-sm">Unirse</a>
        </div>
        <?php endforeach; ?>
      </div>
    </main>
  </div>
</div>
<script>
document.getElementById('sidebarToggle')?.addEventListener('click',()=>{
  document.getElementById('sidebar').classList.toggle('open');
});
</script>
</body>
</html>
