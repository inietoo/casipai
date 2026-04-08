<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$username     = $_SESSION['username'] ?? 'Jugador';
$initials     = strtoupper(substr($username, 0, 2));
$balance      = $_SESSION['balance']  ?? 5000;
$is_admin     = ($_SESSION['role'] ?? 'player') === 'admin';

function nav_link(string $href, string $icon, string $label, string $page, string $current): string {
    $active = ($page === $current) ? 'active' : '';
    return "<li><a href=\"$href\" class=\"$active\">$icon <span>$label</span></a></li>";
}
?>
<header class="topbar">
  <button class="btn btn-icon sidebar-toggle" aria-label="Abrir menú" id="sidebarToggle">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
  <span class="topbar-title"><?= htmlspecialchars($page_title ?? 'CASIPAI') ?></span>
  <div class="topbar-actions">
    <div class="topbar-badge">En línea</div>
    <button class="btn btn-icon" aria-label="Notificaciones">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
    </button>
    <a href="/casipai/logout.php" class="btn btn-ghost btn-sm">Salir</a>
  </div>
</header>
<nav class="sidebar" id="sidebar" aria-label="Navegación principal">
  <a href="/casipai/lobby.php" class="sidebar-brand">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28" style="color:var(--color-primary)">
      <rect x="2" y="6" width="20" height="14" rx="3"/><circle cx="12" cy="13" r="3"/>
      <line x1="12" y1="6" x2="12" y2="3"/><line x1="12" y1="20" x2="12" y2="23"/>
    </svg>
    <div><div class="brand-name">CASIPAI</div><div class="brand-sub">Casino LAN</div></div>
  </a>
  <div class="sidebar-section-label">Jugar</div>
  <ul class="sidebar-nav">
    <?= nav_link('/casipai/lobby.php',
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
        'Lobby', 'lobby', $current_page) ?>
    <?= nav_link('/casipai/rooms.php',
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'Salas activas', 'rooms', $current_page) ?>
  </ul>
  <div class="sidebar-section-label">Social</div>
  <ul class="sidebar-nav">
    <?= nav_link('/casipai/social.php',
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
        'Amigos', 'social', $current_page) ?>
    <?= nav_link('/casipai/profile.php',
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
        'Mi perfil', 'profile', $current_page) ?>
  </ul>
  <?php if ($is_admin): ?>
  <div class="sidebar-section-label">Admin</div>
  <ul class="sidebar-nav">
    <?= nav_link('/casipai/admin/index.php',
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'Panel admin', 'index', $current_page) ?>
  </ul>
  <?php endif; ?>
  <div class="sidebar-footer">
    <div class="user-pill">
      <div class="avatar"><?= htmlspecialchars($initials) ?></div>
      <div class="user-info">
        <div class="user-name"><?= htmlspecialchars($username) ?></div>
        <div class="user-balance">🪙 <?= number_format($balance) ?> fichas</div>
      </div>
    </div>
  </div>
</nav>
