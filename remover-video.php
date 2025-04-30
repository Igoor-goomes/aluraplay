<?php

$dbPath = '/mnt/d/Banco de Dados Ubuntu/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
  echo "<script>
            window.location.href = 'index.php?sucesso=0&erro=idInvalido';  
          </script>";
    exit;
}
$sql = 'DELETE FROM videos WHERE id = ?;';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id, PDO::PARAM_INT);


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
