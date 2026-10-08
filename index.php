<?php

$nome = ""; 
$nota1 = 0;
$nota2 = 0;
$nota3 = 0;
$media = 0;
$mensagem = NULL;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $nota1 = (float) $_POST['nota1'];
    $nota2 = (float) $_POST['nota2'];
    $nota3 = (float) $_POST['nota3'];

    if ($nota1 < 0 || $nota2 < 0 || $nota3 < 0){
        $mensagem = "Coloque uma nota maior que zero";
    }else{
        $media = ($nota1 + $nota2 + $nota3)/3;

        if($media >= 7){
            $mensagem = "Aprovado!";
        }elseif ($media >= 5 && $media <= 6.9){
            $mensagem = "Aluno de exame!";
        }else{
            $mensagem = "Aluno Reprovado!!!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas dos alunos</title>
</head>
<body>

    <h1>Boletim</h1>

    <form method="POST" action="index.php">


        <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome" placeholder="Digite o nome" required>
        <br><br>

        <label for="nota1">Primeira nota</label>
        <input id="nota1" type="number" name="nota1" placeholder="Digite a primeira nota" min="0" max="10" required>
        <br><br>

        <label for="nota2">Segunda nota</label>
        <input id="nota2" type="number" name="nota2" placeholder="Digite a segunda nota" min="0" max="10" required>
        <br><br>

        <label for="nota1">Terceira nota</label>
        <input id="nota1" type="number" name="nota3" placeholder="Digite a terceira nota" min="0" max="10" required>

        <br><br>
        <button type="submit">Calcular a média</button>

        <div style="<?php echo (isset($mensagem)) ? '' : 'display: none;' ; ?>">

            <h3>Nome do aluno: <?php echo $nome;?></h3> 
            <h3>Primeira Nota: <?php echo $nota1;?></h3> 
            <h3>Segunda Nota: <?php echo $nota2;?></h3> 
            <h3>Terceira Nota: <?php echo $nota3;?></h3> 
            <h3>Média: <?php echo $media;?></h3>
            <h3>Situação do aluno: <?php echo $mensagem;?></h3>

        </div>
    </form>
    
</body>
</html>
