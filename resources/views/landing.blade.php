<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Asy-Pay</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
            text-align: center;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .header {
            font-size: 36px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .description {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .button {
            background-color: #FF6F00;
            color: white;
            font-size: 20px;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            margin-top: 30px;
        }

        .button:hover {
            background-color: #f57c00;
        }

        .image {
            margin-top: 50px;
            max-width: 70%;
        }

        .login-register-buttons {
            margin-top: 20px;
        }

        .login-register-buttons a {
            margin: 10px;
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .login-register-buttons a:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .description {
                font-size: 16px;
            }

            .button {
                font-size: 18px;
                padding: 12px 24px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="header">Selamat Datang di Asy-Pay</h1>
        <p class="description">
            terpercaya dan aman. 
        </p>

        <div class="login-register-buttons">
            <a href="{{ route('login') }}" class="button">Login</a>
            <a href="{{ route('register') }}" class="button">Registrasi</a>
        </div>

        <img src="https://via.placeholder.com/600x400.png?text=Image+Placeholder" alt="Asy-Pay" class="image">
    </div>

</body>
</html>
