<?php

$dbPath = '/mnt/d/Banco de Dados Ubuntu/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
  header('Location: index.php?sucesso=o&acao=editarId');
  exit;
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
  header('Location: index.php?sucesso=o&acao=editarUrl');
  exit;
}

$titulo = filter_input(INPUT_POST, 'title');
if ($titulo === false) {
  header('Location: index.php?sucesso=o&acao=editarTitulo');
  exit;
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

if ($statement->execute() === false) {
  echo "<script>
            alert('Erro ao editar o vídeo!');
            window.location.href = 'index.php?sucesso=0&erro=videoNaoPodeSerExcluido';  
          </script>";
  exit;
} else {
  echo "<script>
            alert('Vídeo editado com sucesso!');
            window.location.href = 'index.php?sucesso=1&acao=editar';  
          </script>";
  exit;
}
