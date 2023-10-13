<?php

$clubes_api = "http://localhost/teste_api/clubesAll";  // Note o "http://" para indicar que é uma URL

try {
    $data_nome = file_get_contents($clubes_api);

    if ($data_nome !== false) {
        $result = json_decode($data_nome, true);  // Use true para obter um array associativo em vez de um objeto
        if ($result !== null) {
            //var_dump($result);
        } else {
            echo "Erro ao decodificar JSON.";
        }
    } else {
        echo "Erro ao acessar a API.";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(3, 32.5%);
            padding: 1rem;
        }

        .perfil_time {
            border: 1px solid black;
            padding: 1rem;
            border-radius: 10px;
            color: white;
        }

        .cabecalho {
            display: grid;
            grid-template-columns: auto auto;
            align-items: center;
            justify-content: space-evenly;
        }

        .conteudo {
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .taca {
            width: 1rem;
            margin: 0.1rem;
        }

        p {
            margin: 0.5rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }
    </style>
</head>

<body>

    <?php foreach ($result['clubes'] as $time) : ?>
        <?php 
            $cores = explode(',', $time['Cores']);
            $cores = implode(', ', $cores);
            $gradiente = "style = 'background: linear-gradient(to bottom right, $cores);'"
        ?>
        <div class="perfil_time" <?= $gradiente ?>>
            <div class="cabecalho">
                <img src="/teste_api/<?= $time['Escudo'] ?>">

                <div class="conteudo">
                    <h1><?= $time['Clube'] ?></h1>
                    <p><b>Fundação</b>: <?= $time['Fundação'] ?> (<?= date('Y') - $time['Fundação'] ?> anos)</p>
                    <p><b>Estádio</b>: <?= $time['Estádio'] ?></p>
                </div>
            </div>
            <div class="titulos">
                <h2 style="text-align: center;">Títulos</h2>
                <?php foreach ($time['Títulos'] as $titulo) : ?>
                    <p>
                        <b><?= $titulo['Campeonato'] ?> (<?= $titulo['Qntd'] ?>)</b>:
                        <?php for ($i = 0; $i < $titulo['Qntd']; $i++) : ?>
                            <img src="/teste_api/<?= $titulo['Imagem'] ?>" class="taca">
                        <?php endfor; ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>



</body>

</html>