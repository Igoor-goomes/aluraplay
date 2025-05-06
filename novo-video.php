<?php

$dbPath = '/mnt/d/Banco de Dados Ubuntu/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL); // validando nossa URL 
if ($url === false) {
  header('Location: /?sucesso=0&acao=cadastrarUrl');
  exit;
}

$titulo = filter_input(INPUT_POST, 'title');
if ($titulo === false) {
  header('Location: /?sucesso=0&acao=cadastrarTitulo');
  exit;
}

$sql = 'INSERT INTO videos (url,title) VALUES (?, ?);';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);

if ($statement->execute() === false) {
  header('Location: /?erro=incluirVideo');
  exit;
} else {
  header('Location: /?sucesso=incluirVideo');
  exit;
}
