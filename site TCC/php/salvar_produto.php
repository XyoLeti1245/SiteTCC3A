<?php

session_start();

require_once "conn.php";


// -----------------------------------------
// VERIFICA SE O USUÁRIO ESTÁ LOGADO
// -----------------------------------------

if (!isset($_SESSION["id_usuario"])) {

    header("Location: login.php");

    exit;

}


// -----------------------------------------
// ACEITA SOMENTE POST
// -----------------------------------------

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: cadastro_bolo.php");

    exit;

}


// -----------------------------------------
// RECEBE OS DADOS
// -----------------------------------------

$nome = trim($_POST["nome"] ?? "");

$descricao = trim($_POST["descricao"] ?? "");

$preco_pequeno = $_POST["preco_pequeno"] ?? "";

$preco_medio = $_POST["preco_medio"] ?? "";

$preco_grande = $_POST["preco_grande"] ?? "";

$ativo = isset($_POST["ativo"])
    ? (int) $_POST["ativo"]
    : 1;


// -----------------------------------------
// VALIDA OS CAMPOS OBRIGATÓRIOS
// -----------------------------------------

if (
    $nome === "" ||
    $preco_pequeno === "" ||
    $preco_medio === "" ||
    $preco_grande === ""
) {

    die("Preencha todos os campos obrigatórios.");

}


// -----------------------------------------
// VALIDA OS PREÇOS
// -----------------------------------------

if (
    !is_numeric($preco_pequeno) ||
    !is_numeric($preco_medio) ||
    !is_numeric($preco_grande)
) {

    die("Os preços informados são inválidos.");

}


$preco_pequeno = (float) $preco_pequeno;

$preco_medio = (float) $preco_medio;

$preco_grande = (float) $preco_grande;


if (
    $preco_pequeno < 0 ||
    $preco_medio < 0 ||
    $preco_grande < 0
) {

    die("Os preços não podem ser negativos.");

}


// -----------------------------------------
// VALIDA O STATUS
// -----------------------------------------

if ($ativo !== 0 && $ativo !== 1) {

    die("Status inválido.");

}


// -----------------------------------------
// VERIFICA A IMAGEM
// -----------------------------------------

if (
    !isset($_FILES["imagem"]) ||
    $_FILES["imagem"]["error"] != UPLOAD_ERR_OK
) {

    die("Selecione uma imagem válida para o bolo.");

}


// -----------------------------------------
// DADOS DA IMAGEM
// -----------------------------------------

$arquivoTemporario = $_FILES["imagem"]["tmp_name"];

$tamanhoArquivo = $_FILES["imagem"]["size"];


// -----------------------------------------
// LIMITA O TAMANHO DA IMAGEM
// Máximo: 5 MB
// -----------------------------------------

$tamanhoMaximo = 5 * 1024 * 1024;


if ($tamanhoArquivo > $tamanhoMaximo) {

    die("A imagem deve ter no máximo 5 MB.");

}


// -----------------------------------------
// VERIFICA O TIPO REAL DA IMAGEM
// -----------------------------------------

$finfo = new finfo(FILEINFO_MIME_TYPE);

$tipoImagem = $finfo->file($arquivoTemporario);


// Tipos permitidos e respectivas extensões

$tiposPermitidos = [

    "image/jpeg" => "jpg",

    "image/png" => "png",

    "image/webp" => "webp"

];


if (!isset($tiposPermitidos[$tipoImagem])) {

    die("Formato de imagem não permitido.");

}


// Obtém a extensão pelo tipo real do arquivo

$extensao = $tiposPermitidos[$tipoImagem];


// -----------------------------------------
// PASTA ONDE AS IMAGENS SERÃO SALVAS
// -----------------------------------------

$pastaFisica = __DIR__ . "/uploads/bolos/";


// Cria a pasta caso ela ainda não exista

if (!is_dir($pastaFisica)) {

    if (!mkdir($pastaFisica, 0755, true)) {

        die("Não foi possível criar a pasta para as imagens.");

    }

}


// -----------------------------------------
// CRIA UM NOME ÚNICO PARA A IMAGEM
// -----------------------------------------

$nomeArquivo =
    "bolo_" .
    bin2hex(random_bytes(8)) .
    "." .
    $extensao;


// Caminho físico utilizado pelo PHP

$destinoFisico =
    $pastaFisica .
    $nomeArquivo;


// Caminho que será salvo no banco

$caminhoBanco =
    "uploads/produto/" .
    $nomeArquivo;


// -----------------------------------------
// MOVE A IMAGEM PARA A PASTA
// -----------------------------------------

if (
    !move_uploaded_file(
        $arquivoTemporario,
        $destinoFisico
    )
) {

    die("Erro ao salvar a imagem do produto.");

}


// -----------------------------------------
// INSERE O PRODUTO NO BANCO
// -----------------------------------------

try {

    $sql = "INSERT INTO produto            (
                nome,
                descricao,
                preco_pequeno,
                preco_medio,
                preco_grande,
                imagem,
                ativo
            )
            VALUES
            (
                :nome,
                :descricao,
                :preco_pequeno,
                :preco_medio,
                :preco_grande,
                :imagem,
                :ativo
            )";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ":nome",
        $nome
    );


    $stmt->bindValue(
        ":descricao",
        $descricao
    );


    $stmt->bindValue(
        ":preco_pequeno",
        $preco_pequeno
    );


    $stmt->bindValue(
        ":preco_medio",
        $preco_medio
    );


    $stmt->bindValue(
        ":preco_grande",
        $preco_grande
    );


    $stmt->bindValue(
        ":imagem",
        $caminhoBanco
    );


    $stmt->bindValue(
        ":ativo",
        $ativo,
        PDO::PARAM_INT
    );


    $stmt->execute();


    // -----------------------------------------
    // CADASTRO REALIZADO
    // -----------------------------------------

    header("Location: painel.html");

    exit;


} catch (PDOException $e) {


    // -----------------------------------------
    // SE O INSERT FALHAR,
    // REMOVE A IMAGEM QUE FOI ENVIADA
    // -----------------------------------------

    if (file_exists($destinoFisico)) {

        unlink($destinoFisico);

    }


    die("Erro ao cadastrar o produto.");

}

?>