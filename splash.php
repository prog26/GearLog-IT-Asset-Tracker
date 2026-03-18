<?php
header("refresh:3;url=login.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GearLog Inventory - Chargement</title>

  <style>
    :root {
      --bg: #020617;
      --primary: #38bdf8;
      --text: #f8fafc;
      --text-muted: #94a3b8;
      --glow: rgba(56, 189, 248, 0.35);
      --line: rgba(255, 255, 255, 0.08);
      --track: rgba(255, 255, 255, 0.06);
      --easing: cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at center, #0f172a 0%, #020617 100%);
      color: var(--text);
      font-family: 'Inter', -apple-system, sans-serif;
      overflow: hidden;
    }

    .splash {
      width: min(90vw, 400px);
      text-align: center;
      animation: fadeIn 0.8s var(--easing);
    }

    /* Cadre d'image agrandi */
    .logo-wrap {
      position: relative;
      width: 160px; /* Taille augmentée */
      height: 160px;
      margin: 0 auto 24px;
    }

    .logo-shell {
      width: 100%;
      height: 100%;
      border-radius: 32px;
      background: rgba(15, 23, 42, 0.6);
      border: 1px solid var(--line);
      box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 40px var(--glow);
      overflow: hidden;
      animation: breathe 4s infinite ease-in-out;
    }

    .logo {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Nom de l'application */
    .app-name {
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.02em;
      margin-bottom: 40px;
      background: linear-gradient(to bottom, #fff, #94a3b8);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Zone de chargement */
    .loader-container {
      width: 100%;
      max-width: 280px;
      margin: 0 auto;
    }

    .status-info {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 8px;
      font-family: monospace;
      font-size: 14px;
      color: var(--primary);
      font-weight: 600;
    }

    .progress {
      width: 100%;
      height: 6px;
      border-radius: 10px;
      background: var(--track);
      border: 1px solid rgba(255,255,255,0.03);
      overflow: hidden;
    }

    .progress-bar {
      height: 100%;
      width: 0%;
      background: linear-gradient(90deg, #38bdf8, #0ea5e9);
      box-shadow: 0 0 15px var(--primary);
      transition: width 0.2s var(--easing);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes breathe {
      0%, 100% { transform: scale(1); box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 40px var(--glow); }
      50% { transform: scale(1.03); box-shadow: 0 25px 60px rgba(0,0,0,0.6), 0 0 60px var(--glow); }
    }
  </style>
</head>
<body>

  <main class="splash">
    <div class="logo-wrap">
      <div class="logo-shell">
        <img src="assets/logo.png" alt="GearLog Logo" class="logo" />
      </div>
    </div>

    <div class="app-name">GearLog Inventory</div>

    <div class="loader-container">
      <div class="status-info">
        <span id="percent">0%</span>
      </div>
      <div class="progress">
        <div class="progress-bar" id="bar"></div>
      </div>
    </div>
  </main>

  <script>
    let progress = 0;
    const bar = document.getElementById("bar");
    const percentText = document.getElementById("percent");

    const interval = setInterval(() => {
      // Progression réaliste
      const increment = Math.random() * 3;
      progress += increment;

      if (progress >= 100) progress = 100;

      const displayVal = Math.floor(progress);
      bar.style.width = displayVal + "%";
      percentText.textContent = displayVal + "%";

      if (progress >= 100) {
        clearInterval(interval);
        setTimeout(() => {
          window.location.href = "login.php";
        }, 800);
      }
    }, 60);
  </script>
</body>
</html>