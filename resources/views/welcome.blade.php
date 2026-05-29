<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Figtree', sans-serif;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=1950&q=80');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    color: white;
  }

  /* Overlay gelap */
  body::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
  }

  .content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  /* Navigasi kanan atas */
  .nav {
    display: flex;
    justify-content: flex-end;
    gap: 1.5rem;
    padding: 1.5rem 2rem;
  }

  .nav a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    letter-spacing: 0.5px;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: background 0.2s, transform 0.2s;
  }

  .nav a:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-1px);
  }

  /* Quotes di tengah */
  .quote-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    text-align: center;
  }

  blockquote {
    font-size: clamp(1.2rem, 3vw, 1.8rem);
    font-weight: 400;
    max-width: 700px;
    line-height: 1.6;
    opacity: 0.9;
    font-style: italic;
  }

  /* Jam digital di kiri bawah */
  .clock-container {
    position: absolute;
    bottom: 2rem;
    left: 2rem;
    user-select: none;
  }

  .time {
    font-size: clamp(4rem, 15vw, 10rem);
    font-weight: 600;
    line-height: 1;
    text-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
    letter-spacing: 0.02em;
  }

  .date {
    font-size: clamp(1rem, 2.5vw, 1.5rem);
    font-weight: 400;
    margin-top: 0.5rem;
    opacity: 0.85;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
  }

  /* Responsif tambahan untuk layar kecil */
  @media (max-width: 640px) {
    .nav {
      padding: 1rem;
      gap: 0.8rem;
    }
    .clock-container {
      bottom: 1.5rem;
      left: 1.5rem;
    }
    .quote-container {
      padding: 1rem;
    }
  }
</style>
</head>
<body>
<div class="content">
<!-- Navigasi -->
<div class="nav">
@auth
<a href="{{ url('/dashboard') }}">Dashboard</a>
@else
@if(Route::has('login'))
<a href="{{ route('login') }}">Log in</a>
@endif
@if (Route::has('register'))
<a href="{{ route('register') }}">Register</a>
@endif
@endauth
</div>

<!-- Quotes inspiratif Laravel -->
<div class="quote-container">
<blockquote>
{{ \Illuminate\Foundation\Inspiring::quote() }}
</blockquote>
</div>

<!-- Jam digital & tanggal -->
<div class="clock-container">
<div class="time" id="clock">
--:--:--
</div>
<div class="date" id="date">
---
</div>
</div>
</div>

<script>
function updateClock() {
const now = new Date();

// Jam 24 jam
const hours = String(now.getHours()).padStart(2, '0');
const minutes = String(now.getMinutes()).padStart(2, '0');
const seconds = String(now.getSeconds()).padStart(2, '0');
document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

// Tanggal dalam bahasa Indonesia
const options = {
weekday: 'long',
year: 'numeric',
month: 'long',
day: 'numeric'
};
const dateString = now.toLocaleDateString('id-ID', options);
document.getElementById('date').textContent = dateString;
}

// Update setiap detik
updateClock();
setInterval(updateClock, 1000);
</script>
</body>
</html>