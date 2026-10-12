<?php

$nome = ""; 
$nota1 = 0;
$nota2 = 0;
$nota3 = 0;
$media = 0;
$mensagem = NULL;
$classe_situacao = "";

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
            $classe_situacao = "aprovado"; 
        }elseif ($media >= 5 && $media <= 6.9){
            $mensagem = "Aluno de exame!";
            $classe_situacao = "exame"; 
        }else{
            $mensagem = "Aluno Reprovado!";
            $classe_situacao = "reprovado"; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas dos alunos</title>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #03045e;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            font-family: Arial, sans-serif;
        }

        form {
            display: flex;
            gap: 30px; 
            align-items: center;
            justify-content: center;
        }

        h1 {
            position: absolute;
            top: 40px;
            background-color: #f4d58d;
            width: 500px;
            border-radius: 10px;
            padding: 10px;
            margin: 0;
            text-align: center;
            color: #bf0603;
            font-size: 24px;
        }

        section {
            text-align: center;
            color: white;
            background-color: #bf0603;
            width: 500px;
            height: 400px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
        }

        .retangulo {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .retangulo label {
            font-weight: bold;
            text-align: left;
            width: 180px;
        }

        .retangulo input {
            padding: 8px;
            border-radius: 5px;
            border: none;
            width: 180px;
        }

        #nome_label{
            text-align: left;
            width: 300px;
        }

        #nome{
            width: 300px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #f4d58d;
            color: #bf0603;
            font-weight: bold;
            cursor: pointer;
        }

        .resultado_caixa {
            width: 400px;
            height: 400px; 
            background-color: #edbf55;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            gap: 12px;
        }

        .resultado_caixa h3 {
            margin: 0;
            font-size: 16px;
            color: #03045e;
            font-weight: bold;
        }

        .resultado_caixa h3 span {
            color: #bf0603;
            font-weight: normal;
        }

        .situacao {
            margin-top: 10px;
            width: 90%;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
        }

        .situacao h3 {
            font-size: 18px;
        }

        .situacao.aprovado {
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
        }
        .situacao.aprovado h3 {
            color: #155724;
        }

        .situacao.exame {
            background-color: #fff3cd;
            border: 2px solid #ffeeba;
        }
        .situacao.exame h3 {
            color: #856404;
        }

        .situacao.reprovado {
            background-color: rgba(191, 6, 3, 0.1);
            border: 2px solid rgba(191, 6, 3, 0.2);
        }
        .situacao.reprovado h3 {
            color: #bf0603;
        }

    </style>
</head>
<body>

    <h1>Relatório de Rendimento</h1>

    <form method="POST" action="index.php">

        <section>
            <div class="retangulo"> 
                <label for="nome" id="nome_label">Nome</label>
                <input id="nome" type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" placeholder="Digite o nome" required>

                <label for="nota1">Primeira nota</label>
                <input id="nota1" type="number" name="nota1" value="<?php echo $nota1 ?>" placeholder="Digite a primeira nota" min="0" max="10" required>

                <label for="nota2">Segunda nota</label>
                <input id="nota2" type="number" name="nota2" value="<?php echo $nota2 ?>" placeholder="Digite a segunda nota" min="0" max="10" required>

                <label for="nota3">Terceira nota</label>
                <input id="nota3" type="number" name="nota3" value="<?php echo $nota3 ?>" placeholder="Digite a terceira nota" min="0" max="10" required>
            </div>

            <button type="submit">Calcular a média</button>
        </section>

        <div class="resultado_caixa" style="<?php echo (isset($mensagem)) ? '' : 'display: none;' ; ?>">

            <h3>Nome do aluno: <span><?php echo htmlspecialchars($nome);?></span></h3> 
            <h3>Primeira Nota: <span><?php echo $nota1;?></span></h3> 
            <h3>Segunda Nota: <span><?php echo $nota2;?></span></h3> 
            <h3>Terceira Nota: <span><?php echo $nota3;?></span></h3> 
            <h3>Média: <span><?php echo number_format($media,2,',');?></span></h3>

            <div class="situacao <?php echo $classe_situacao; ?>">
                <h3>Situação do aluno: <?php echo $mensagem;?></h3>
            </div>

        </div>
    </form>
    
</body>
</html>

