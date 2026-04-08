# 🎰 CASIPAI — Casino LAN para amigos

Casino web para jugar con amigos en red local (LAN) sobre XAMPP. PHP + MySQL + HTML5/CSS3.

## Estructura del proyecto

```
htdocs/casipai/
├── index.php                  # Punto de entrada (redirige a login/lobby)
├── login.php                  # Autenticación
├── register.php               # Registro de usuarios
├── logout.php                 # Cerrar sesión
├── lobby.php                  # Lobby principal con juegos y salas
├── profile.php                # Perfil y estadísticas del jugador
├── social.php                 # Amigos y actividad
├── game.php                   # Plantilla genérica de sala de juego
├── public/
│   └── css/style.css          # Sistema de diseño completo
├── views/
│   └── layout/header.php      # Sidebar + topbar compartidos
├── admin/
│   └── index.php              # Panel de administración
└── app/                       # Lógica PHP (próximas fases)
```

## Instalación en XAMPP

1. Copia la carpeta en `htdocs/casipai/`
2. Inicia Apache y MySQL desde el panel de XAMPP
3. Crea la base de datos `casipai` en phpMyAdmin (schema próximamente)
4. Accede desde `http://localhost/casipai/`

Desde otros equipos de la LAN: `http://<IP_DEL_SERVIDOR>/casipai/`

## Stack

- **Backend:** PHP 8+ con sesiones
- **Base de datos:** MySQL/MariaDB
- **Frontend:** HTML5, CSS3 con variables (sin frameworks externos)
- **Tipografías:** Outfit + Inter (Google Fonts)

## Fases del proyecto

- [x] Fase 1 — Frontend: todas las vistas y sistema de diseño
- [ ] Fase 2 — Autenticación PHP + MySQL
- [ ] Fase 3 — Lógica de salas y WebSockets/polling
- [ ] Fase 4 — Juegos: Blackjack, Ruleta, Slots, Póker
- [ ] Fase 5 — Chat en tiempo real
