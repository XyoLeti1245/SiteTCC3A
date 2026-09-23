<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            width: 100%;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background-color: #f2f4f7;
        }

        .login-box {
            width: 100%;
            max-width: 380px;

            background-color: #c2d0ea;

            padding: 35px;

            border-radius: 12px;

            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
        }

        .logo {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 180px;
            height: auto;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            margin-bottom: 7px;

            font-size: 14px;
            font-weight: bold;

            color: #444;
        }

        .campo input {
            width: 100%;
            height: 45px;

            padding: 0 12px;

            border: 1px solid #ccc;
            border-radius: 7px;

            font-size: 16px;

            outline: none;
        }

        .campo input:focus {
            border-color: #e33041;
        }

        .btn-login {
            width: 100%;
            height: 46px;

            border: none;
            border-radius: 7px;

            background-color: #e33041;

            color: white;

            font-size: 16px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #125ca8;
        }

    </style>

</head>

<body>

    <div class="login-box">

        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>

        <h2>Login</h2>

        <form action="validar_login.php" method="POST">

            <div class="campo">

                <label for="email">E-mail</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required
                >

            </div>

            <div class="campo">

                <label for="senha">Senha</label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                >

            </div>

            <button
                type="submit"
                class="btn-login">
                Entrar
            </button>

        </form>

    </div>

</body>
</html>