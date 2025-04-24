<?php

$dbPath = '/mnt/d/Banco de Dados Ubuntu/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$_GET['id'];
$sql = 'DELETE FROM videos WHERE id = ?;';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $_GET['id']);

if ($statement->execute() === false) {
    echo "<script>
            alert('Erro ao exluir o vídeo!');
            window.location.href = 'index.php?sucesso=0';  
          </script>";
    exit;
} else {
    echo "<script>
            alert('Vídeo excluido com sucesso do AluraPlay!');
            window.location.href = 'index.php?sucesso=1';  
          </script>";
    exit;
}




