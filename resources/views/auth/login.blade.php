<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Memuat script reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #0056b3;
        }

        .g-recaptcha {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Input Email -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Password -->
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- reCAPTCHA -->
        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}"></div>
        @error('g-recaptcha-response')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- Tombol Login -->
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

</body>
</html>
