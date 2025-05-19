<?php
// Caminho do banco de dados SQLite
$db_path = __DIR__ . '/../db/database.sqlite';

try {
    $pdo = new PDO("sqlite:" . $db_path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criação da tabela se não existir
    $pdo->exec("CREATE TABLE IF NOT EXISTS Inscrito (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL,
        telefone TEXT NOT NULL,
        data_nascimento TEXT NOT NULL,
        genero TEXT NOT NULL,
        tipo_inscricao TEXT NOT NULL,
        mensagem TEXT
    )");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
