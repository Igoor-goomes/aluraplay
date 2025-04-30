<?php

$dbPath = '/mnt/d/Banco de Dados Ubuntu/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL); // validando nossa URL 
if ($url === false) {
  header('Location: index.php?sucesso=0&acao=cadastrarUrl');
  exit;
}

$titulo = filter_input(INPUT_POST, 'title');
if ($titulo === false) {
  header('Location: index.php?sucesso=0&acao=cadastrarTitulo');
  exit;
}

$sql = 'INSERT INTO videos (url,title) VALUES (?, ?);';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);

if ($statement->execute() === false) {
  echo "<script>
            alert('Erro ao incluir o vídeo no AluraPlay!');
            window.location.href = 'index.php?sucesso=0';  
          </script>";
  exit;
} else {
  echo "<script>
            alert('Vídeo incluido com sucesso no AluraPlay!');
            window.location.href = 'index.php?sucesso=1';  
          </script>";
  exit;
}
