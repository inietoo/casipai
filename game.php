<?php
session_start();
$page_title = 'Mesa de juego';
$room_id    = intval($_GET['room'] ?? 1);
$game_name  = htmlspecialchars($_GET['game'] ?? 'Blackjack');
$players = [
  ['name'=>'MikelEtxe','initials'=>'ME','balance'=>12500,'bet'=>500],
  ['name'=>'Tú',        'initials'=>'TU','balance'=>5000, 'bet'=>300],
  ['name'=>'SaraMadrid','initials'=>'SM','balance'=>8300, 'bet'=>400],
];
?><!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mesa — CASIPAI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..800&family=Inter:wght@300..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
  <style>
    .game-layout { display:grid; grid-template-columns:1fr 280px; grid-template-rows:1fr auto; gap:var(--space-4); height:calc(100dvh - var(--topbar-height)); padding:var(--space-4); }
    .game-table-area { background:radial-gradient(ellipse at center,#1a4a2e 0%,#0d2b1a 60%,#071a10 100%); border-radius:var(--radius-xl); border:2px solid #2d6e42; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:var(--space-6); position:relative; overflow:hidden; min-height:300px; }
    .game-table-area::before { content:''; position:absolute; inset:0; background:repeating-linear-gradient(45deg,transparent,transparent 40px,oklch(1 0 0/0.01) 40px,oklch(1 0 0/0.01) 80px); }
    .game-placeholder-msg { font-family:var(--font-display); font-size:var(--text-xl); font-weight:700; color:oklch(1 0 0/0.6); text-align:center; z-index:1; }
    .game-placeholder-sub { font-size:var(--text-sm); color:oklch(1 0 0/0.35); z-index:1; }
    .game-sidebar { display:flex; flex-direction:column; gap:var(--space-4); overflow-y:auto; }
    .game-actions { grid-column:1; display:flex; gap:var(--space-3); padding:var(--space-2) 0; flex-wrap:wrap; }
    .bet-input { background:var(--color-surface-2); border:1px solid var(--color-border); border-radius:var(--radius-md); padding:var(--space-2) var(--space-4); font-size:var(--text-sm); color:var(--color-text); width:120px; font-variant-numeric:tabular-nums; }
    .chat-box { display:flex; flex-direction:column; background:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-lg); height:220px; overflow:hidden; }
    .chat-messages { flex:1; overflow-y:auto; padding:var(--space-3); display:flex; flex-direction:column; gap:var(--space-2); }
    .chat-msg { font-size:var(--text-xs); }
    .chat-msg .chat-author { font-weight:700; color:var(--color-primary); }
    .chat-input-row { display:flex; gap:var(--space-2); padding:var(--space-2) var(--space-3); border-top:1px solid var(--color-border); }
    .chat-input-row input { flex:1; background:var(--color-surface-2); border:1px solid var(--color-border); border-radius:var(--radius-sm); padding:var(--space-1) var(--space-3); font-size:var(--text-xs); color:var(--color-text); }
  </style>
</head>
<body>
<div style="display:flex;flex-direction:column;height:100dvh">
  <header class="topbar">
    <a href="lobby.php" class="btn btn-ghost btn-sm">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
      Volver al lobby
    </a>
    <span class="topbar-title" style="margin-left:var(--space-3)"><?= $game_name ?> · Sala #<?= $room_id ?></span>
    <div class="topbar-actions"><div class="topbar-badge">En línea</div></div>
  </header>
  <div class="game-layout">
    <div class="game-table-area">
      <div class="game-placeholder-msg">♠ <?= $game_name ?> ♥</div>
      <div class="game-placeholder-sub">Aquí irá el tablero del juego</div>
    </div>
    <div class="game-actions">
      <input class="bet-input" type="number" value="100" min="10" step="10" placeholder="Apuesta">
      <button class="btn btn-primary">Apostar</button>
      <button class="btn btn-ghost">Plantarse</button>
      <button class="btn btn-ghost">Pedir carta</button>
      <a href="lobby.php" class="btn btn-ghost btn-sm" style="margin-left:auto;color:var(--color-error)">Salir</a>
    </div>
    <div class="game-sidebar">
      <div class="card" style="padding:var(--space-4)">
        <div class="section-label" style="margin-bottom:var(--space-3)">Jugadores</div>
        <?php foreach ($players as $p): ?>
        <div style="display:flex;align-items:center;gap:var(--space-3);padding:var(--space-2) 0;border-bottom:1px solid var(--color-divider)">
          <div class="avatar"><?= $p['initials'] ?></div>
          <div style="flex:1;min-width:0">
            <div style="font-size:var(--text-sm);font-weight:600"><?= htmlspecialchars($p['name']) ?></div>
            <div style="font-size:var(--text-xs);color:var(--color-text-muted)">🪙 <?= number_format($p['balance']) ?></div>
          </div>
          <span class="badge badge-gold" style="font-size:10px">Ap: <?= $p['bet'] ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="chat-box">
        <div class="chat-messages" id="chatMessages">
          <div class="chat-msg"><span class="chat-author">MikelEtxe:</span> ¡Vamos!</div>
          <div class="chat-msg"><span class="chat-author">SaraMadrid:</span> Suerte a todos 🍀</div>
          <div class="chat-msg"><span class="chat-author">Sistema:</span> La partida ha comenzado.</div>
        </div>
        <div class="chat-input-row">
          <input type="text" id="chatInput" placeholder="Mensaje…" maxlength="120" onkeydown="if(event.key==='Enter')sendChat()">
          <button class="btn btn-primary btn-sm" onclick="sendChat()">→</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function sendChat(){
  const input=document.getElementById('chatInput'),msg=input.value.trim();
  if(!msg)return;
  const msgs=document.getElementById('chatMessages'),div=document.createElement('div');
  div.className='chat-msg';
  div.innerHTML='<span class="chat-author">Tú:</span> '+msg.replace(/</g,'&lt;');
  msgs.appendChild(div);msgs.scrollTop=msgs.scrollHeight;input.value='';
}
</script>
</body>
</html>
