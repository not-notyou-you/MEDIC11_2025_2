<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --primary: #048C6A;
      --secondary: #048C6A;
      --accent: #53b490;
      --bg: #F8FFE5;
      --text: #222222;
      --blur-bg: rgba(83, 180, 144, 0.6);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
      height: 100%;
      font-family: 'Roboto', sans-serif;
    }

    body {
      background-color: var(--accent);
      overflow: auto;
      position: relative;
    }

    .carousel {
      position: fixed;
      inset: 0;
      z-index: -2;
    }

    .carousel img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: grayscale(100%);
      opacity: 0;
      animation: slide 9s infinite;
    }

    .carousel img:nth-child(1) { animation-delay: 0s; }
    .carousel img:nth-child(2) { animation-delay: 3s; }
    .carousel img:nth-child(3) { animation-delay: 6s; }

    @keyframes slide {
      0%, 100% { opacity: 0; }
      10%, 33% { opacity: 1; }
      66% { opacity: 0; }
    }

    .overlay {
      position: fixed;
      inset: 0;
      background: var(--blur-bg);
      backdrop-filter: blur(3px);
      z-index: -1;
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .container {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      max-width: 600px;
      width: 100%;
      padding: 1.5rem;
      gap: 1.25rem;
      background: linear-gradient(to bottom right, #e0f2ec, #f5fffc);
      border: 6px double #319875;
      border-radius: 1.25rem;
      box-shadow: 0 0 20px rgba(6, 214, 160, 0.5);
    }

    .logo-card {
      aspect-ratio: 1;
      width: min(160px, 35vw);
      border-radius: 50%;
      background: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      flex-shrink: 0;
    }

    .logo-card img {
      width: 90%;
      height: 90%;
      object-fit: cover;
      border-radius: 50%;
    }

    .form-card {
      flex: 1;
      font-family: 'Poppins', sans-serif;
      color: #144034;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-card h2 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 0.75rem;
      line-height: 1.2;
    }

    .input-group {
      margin-bottom: 1rem;
    }

    .input-group label {
      display: block;
      color: var(--secondary);
      font-weight: 600;
      font-size: 0.875rem;
      margin-bottom: 0.25rem;
    }

    .input-group input {
      width: 100%;
      padding: 0.5rem 1rem;
      border: 2px solid var(--secondary);
      border-radius: 0.5rem;
      background-color: #fff;
      color: var(--secondary);
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
      outline: none;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .input-group input:focus {
      outline: 2px solid var(--primary);
    }

    .button-group-container {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }

    .button-group-container > div {
      flex: 1;
    }

    .custom-button {
      width: 100%;
      border: 2px solid var(--secondary);
      color: var(--secondary);
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      padding: 0.5rem 1.25rem;
      border-radius: 0.5rem;
      background: transparent;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .custom-button:hover {
      background: var(--secondary);
      color: #fff;
    }

    .custom-button:active {
      transform: scale(0.95);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        max-width: 100%;
        padding: 1rem;
        gap: 1rem;
      }

      .logo-card {
        width: min(160px, 50vw);
      }

      .form-card {
        width: 100%;
        text-align: center;
        margin-top: 0.5rem;
      }

      .form-card h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
      }

      .input-group {
        margin-bottom: 0.5rem;
      }

      .button-group-container {
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 0.75rem;
      }
    }
  </style>
</head>
<body>
  <div class="carousel">
    <img src="{{ asset('assets/foto/c1.webp') }}" alt="">
    <img src="{{ asset('assets/foto/c2.webp') }}" alt="">
    <img src="{{ asset('assets/foto/c3.webp') }}" alt="">
    
  </div>
  <div class="overlay"></div>

  <div class="page-wrapper">
    <div class="container">
      <div class="logo-card">
        <img src="{{ asset('assets/logo/logo1.webp') }}" alt="Logo" />
      </div>
      <div class="form-card">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="button-group-container">
            <div><button type="submit" class="custom-button">Login</button></div>
            <div><a href="/" class="custom-button">Back to Home</a></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
