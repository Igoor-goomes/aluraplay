<?php

$dbPath = '/mnt/d/Banco de Dados Ubuntu/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
  header('Location: /?erro=idInvalido');
  exit;
}
$sql = 'DELETE FROM videos WHERE id = ?;';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id, PDO::PARAM_INT);


if ($statement->execute() === false) {
  header('Location: /?erro=excluirVideo');
  exit;
} else {
  header('Location: /?sucesso=excluirVideo');
  exit;
}
