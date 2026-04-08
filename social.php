<?php
session_start();
$page_title = 'Amigos';
$friends = [
  ['name'=>'MikelEtxe', 'initials'=>'ME','status'=>'online', 'state'=>'Jugando Blackjack'],
  ['name'=>'SaraMadrid','initials'=>'SM','status'=>'online', 'state'=>'En el lobby'],
  ['name'=>'JuanLopez', 'initials'=>'JL','status'=>'online', 'state'=>'Jugando Slots'],
  ['name'=>'Ana_Gamer', 'initials'=>'AG','status'=>'offline','state'=>'Últ. vez hace 2h'],
  ['name'=>'PepeRules', 'initials'=>'PR','status'=>'offline','state'=>'Últ. vez ayer'],
];
$activity = [
  ['MikelEtxe ganó <strong>3,200 fichas</strong> en Blackjack','2 min'],
  ['SaraMadrid se unió al lobby','5 min'],
  ['JuanLopez creó una sala de Slots','8 min'],
  ['Ana_Gamer cerró sesión','2h'],
];
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amigos — CASIPAI</title>
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
      <div style="display:grid;grid-template-columns:1fr 320px;gap:var(--space-6);align-items:start">
        <div>
          <div class="page-header">
            <div class="page-header-left"><h1>Amigos</h1><p><?= count(array_filter($friends,fn($f)=>$f['status']==='online')) ?> en línea ahora</p></div>
          </div>
          <?php foreach ($friends as $f): ?>
          <div class="friend-row">
            <div class="avatar"><?= $f['initials'] ?></div>
            <div class="friend-status <?= $f['status'] ?>"></div>
            <div><div class="friend-name"><?= htmlspecialchars($f['name']) ?></div><div class="friend-state"><?= htmlspecialchars($f['state']) ?></div></div>
            <?php if ($f['status']==='online'): ?>
            <div class="friend-actions"><button class="btn btn-ghost btn-sm">Invitar</button><button class="btn btn-ghost btn-sm">Chat</button></div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <div>
          <div class="section-label">Actividad reciente</div>
          <div class="card" style="padding:var(--space-4)">
            <?php foreach ($activity as [$msg,$time]): ?>
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:var(--space-3);padding:var(--space-3) 0;border-bottom:1px solid var(--color-divider)">
              <p style="font-size:var(--text-sm);color:var(--color-text-muted);max-width:none;margin:0"><?= $msg ?></p>
              <span style="font-size:var(--text-xs);color:var(--color-text-faint);white-space:nowrap;flex-shrink:0"><?= $time ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<script>document.getElementById('sidebarToggle')?.addEventListener('click',()=>document.getElementById('sidebar').classList.toggle('open'));</script>
</body>
</html>
