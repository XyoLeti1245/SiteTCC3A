<?php

session_start();


// Impede acesso sem login
if (!isset($_SESSION["id_usuario"])) {

    header("Location: login.php");

    exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Produto</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {
            background-color: #f2f4f7;
        }



        /* TOPO */

        .topo {

            width: 100%;
            height: 70px;

            background-color: #ffffff;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 40px;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.10);
        }


        .topo h2 {
            color: #333;
        }


        .btn-voltar {

            text-decoration: none;

            background-color: #1976d2;

            color: white;

            padding: 10px 18px;

            border-radius: 6px;

            transition: 0.3s;
        }


        .btn-voltar:hover {
            background-color: #125ca8;
        }



        /* CONTAINER */

        .container {

            width: 90%;

            max-width: 650px;

            margin: 40px auto;
        }



        /* TÍTULO */

        .titulo {

            margin-bottom: 25px;
        }


        .titulo h1 {

            color: #333;

            margin-bottom: 8px;
        }


        .titulo p {

            color: #777;
        }



        /* FORMULÁRIO */

        .form-box {

            background-color: white;

            padding: 35px;

            border-radius: 12px;

            box-shadow:
                0 3px 12px rgba(0,0,0,0.10);
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


        .campo input,
        .campo select,
        .campo textarea {

            width: 100%;

            padding: 0 12px;

            border: 1px solid #ccc;

            border-radius: 7px;

            font-size: 16px;

            background-color: white;

            outline: none;
        }


        .campo input,
        .campo select {

            height: 45px;
        }


        .campo textarea {

            height: 120px;

            padding: 12px;

            resize: vertical;
        }


        .campo input:focus,
        .campo select:focus,
        .campo textarea:focus {

            border-color: #1976d2;
        }



        /* PREÇOS */

        .linha-precos {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 15px;
        }



        /* INPUT DE ARQUIVO */

        .campo input[type="file"] {

            height: auto;

            padding: 10px;
        }


        .texto-ajuda {

            display: block;

            margin-top: 6px;

            font-size: 12px;

            color: #777;
        }



        /* BOTÃO */

        .btn-cadastrar {

            width: 100%;

            height: 46px;

            border: none;

            border-radius: 7px;

            background-color: #1976d2;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }


        .btn-cadastrar:hover {

            background-color: #125ca8;
        }



        /* RESPONSIVO */

        @media(max-width: 700px) {

            .topo {

                padding: 0 20px;
            }


            .topo h2 {

                font-size: 18px;
            }


            .form-box {

                padding: 25px;
            }


            .linha-precos {

                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


    <!-- TOPO -->

    <header class="topo">


        <h2>
            Painel Administrativo
        </h2>


        <a
            href="painel.html"
            class="btn-voltar">

            Voltar

        </a>


    </header>



    <!-- CONTEÚDO -->

    <main class="container">


        <!-- TÍTULO -->

        <div class="titulo">


            <h1>
                Cadastro de Produto
            </h1>


            <p>
                Preencha os dados abaixo para cadastrar
                um novo produto no sistema.
            </p>


        </div>



        <!-- FORMULÁRIO -->

        <div class="form-box">


            <form
                action="salvar_produto.php"
                method="POST"
                enctype="multipart/form-data">


                <!-- NOME -->

                <div class="campo">


                    <label for="nome">
                        Nome do bolo
                    </label>


                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        maxlength="100"
                        placeholder="Ex: Brinco de Ouro"
                        required
                    >


                </div>



                <!-- DESCRIÇÃO -->

                <div class="campo">


                    <label for="descricao">
                        Descrição
                    </label>


                    <textarea
                        id="descricao"
                        name="descricao"
                        placeholder="Descreva o tamanha, detalhes, decoração etc."
                    ></textarea>


                </div>



                <!-- PREÇOS -->

                <div class="linha-precos">


                    <!-- PEQUENO -->

                    <div class="campo">


                        <label for="preco_pequeno">
                            Preço pequeno
                        </label>


                        <input
                            type="number"
                            id="preco_pequeno"
                            name="preco_pequeno"
                            min="0"
                            step="0.01"
                            placeholder="R$ 0,00"
                            required
                        >


                    </div>



                    <!-- MÉDIO -->

                    <div class="campo">


                        <label for="preco_medio">
                            Preço médio
                        </label>


                        <input
                            type="number"
                            id="preco_medio"
                            name="preco_medio"
                            min="0"
                            step="0.01"
                            placeholder="R$ 0,00"
                            required
                        >


                    </div>



                    <!-- GRANDE -->

                    <div class="campo">


                        <label for="preco_grande">
                            Preço grande
                        </label>


                        <input
                            type="number"
                            id="preco_grande"
                            name="preco_grande"
                            min="0"
                            step="0.01"
                            placeholder="R$ 0,00"
                            required
                        >


                    </div>


                </div>



                <!-- IMAGEM -->

                <div class="campo">


                    <label for="imagem">
                        Imagem do bolo
                    </label>


                    <input
                        type="file"
                        id="imagem"
                        name="imagem"
                        accept="image/jpeg,image/png,image/webp"
                        required
                    >


                    <span class="texto-ajuda">
                        Selecione uma imagem JPG, PNG ou WEBP.
                    </span>


                </div>



                <!-- STATUS -->

                <div class="campo">


                    <label for="ativo">
                        Status
                    </label>


                    <select
                        id="ativo"
                        name="ativo"
                        required>


                        <option value="1" selected>
                            Ativo
                        </option>


                        <option value="0">
                            Inativo
                        </option>


                    </select>


                </div>



                <!-- BOTÃO -->

                <button
                    type="submit"
                    class="btn-cadastrar">

                    Cadastrar Produto

                </button>


            </form>


        </div>


    </main>


</body>

</html>