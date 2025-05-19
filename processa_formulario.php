<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $data_nascimento = $_POST['data-nascimento'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $tipo_inscricao = $_POST['tipo-inscricao'] ?? '';
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (
        empty($nome) || empty($email) || empty($telefone) ||
        empty($data_nascimento) || empty($genero) || empty($tipo_inscricao)
    ) {
        die('Por favor, preencha todos os campos obrigatórios.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('E-mail inválido.');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO Inscrito (nome, email, telefone, data_nascimento, genero, tipo_inscricao, mensagem)
            VALUES (:nome, :email, :telefone, :data_nascimento, :genero, :tipo_inscricao, :mensagem)");

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':data_nascimento' => $data_nascimento,
            ':genero' => $genero,
            ':tipo_inscricao' => $tipo_inscricao,
            ':mensagem' => $mensagem
        ]);

        echo "Inscrição realizada com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>
