<?php
require_once '_cabecalho.php';

$clubes_api = "http://localhost/teste_api/clubesall";  // Note o "http://" para indicar que é uma URL

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

<section class="grade-conteudo">
    <?php foreach ($result['clubes'] as $time) : ?>
        <?php
        $cores = explode(',', $time['Cores']);
        $cores = implode(', ', $cores);
        $gradiente = "style = 'background: linear-gradient(to bottom right, $cores);'";
        ?>

        <a href="exibe.php?id=<?= $time['Id'] ?>">
            <div class="cabecalho" <?= $gradiente ?>>
                <img src="/teste_api/<?= $time['Escudo'] ?>" width="100%" height="auto" class="escudo">

                <div class="conteudo">
                    <h1><?= $time['Clube'] ?></h1>
                    <p><b>Fundação</b>: <?= $time['Fundação'] ?> (<?= date('Y') - $time['Fundação'] ?> anos)</p>
                    <p><b>Estádio</b>: <?= $time['Estádio'] ?></p>
                </div>
            </div>
        </a>

    <?php endforeach; ?>

</section>



</body>

</html>