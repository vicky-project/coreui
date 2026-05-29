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

  /* Quotes di tengah, tetapi digeser ke atas dengan padding bawah yang besar */
  .quote-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 2rem 10rem 2rem;
    /* padding-bottom diperbesar agar tidak menutupi clock */
    text-align: center;
  }

  blockquote {
    font-size: clamp(1.2rem, 3vw, 1.8rem);
    max-width: 700px;
    line-height: 1.6;
    opacity: 0.9;
    font-weight: 400;
  }

  .quote-text {
    font-weight: 600;
    font-style: italic;
  }

  .quote-author {
    display: block;
    margin-top: 0.75rem;
    font-size: 0.9em;
    color: #d1d5db;
    font-weight: 400;
    font-style: normal;
  }

  .clock-container {
    position: absolute;
    bottom: 2rem;
    left: 2rem;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
    z-index: 3;
    user-select: none;
  }

  .time {
    font-size: clamp(4rem, 15vw, 10rem);
    font-weight: 600;
    line-height: 1;
    text-shadow: 0 0 20px rgba(0, 0, 0, 0.7), 0 0 40px rgba(0,0,0,0.5);
    letter-spacing: 0.02em;
  }

  .date {
    font-size: clamp(1.2rem, 2.5vw, 1.8rem);
    font-weight: 400;
    line-height: 1.2;
    color: #ffffff;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.8), 0 0 20px rgba(0,0,0,0.6);
  }

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
      padding: 1rem 1rem 8rem 1rem;
      /* padding bawah tetap besar di mobile */
    }
  }
</style>
</head>
<body>
<div class="content">
<div class="nav">
@auth
<a href="{{ url('/apps/dashboard') }}">Dashboard</a>
@else
@if(Route::has('login'))
<a href="{{ route('login') }}">Log in</a>
@endif
@if (Route::has('register'))
<a href="{{ route('register') }}">Register</a>
@endif
@endauth
</div>

<div class="quote-container">
@php
$fullQuote = \Illuminate\Foundation\Inspiring::quotes()->random();
$parts = explode(' - ', $fullQuote, 2);
$quoteText = $parts[0] ?? '';
$quoteAuthor = $parts[1] ?? '';
$quoteText = trim($quoteText, "“”\"'");
@endphp
<blockquote>
<span class="quote-text">&#8220;{{ $quoteText }}&#8221;</span>
@if($quoteAuthor)
<span class="quote-author">&#8212; {{ $quoteAuthor }}</span>
@endif
</blockquote>
</div>

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
const hours = String(now.getHours()).padStart(2, '0');
const minutes = String(now.getMinutes()).padStart(2, '0');
const seconds = String(now.getSeconds()).padStart(2, '0');
document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

const options = {
weekday: 'long',
year: 'numeric',
month: 'long',
day: 'numeric'
};
const dateString = now.toLocaleDateString('id-ID', options);
document.getElementById('date').textContent = dateString;
}

updateClock();
setInterval(updateClock, 1000);
</script>
</body>
</html>