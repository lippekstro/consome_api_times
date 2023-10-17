<?php
require_once '_cabecalho.php';

$clubes_api = "http://localhost/teste_api/clubesimg";  // Note o "http://" para indicar que é uma URL

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
        <a href="exibe.php?id=<?= $time['Clube_ID'] ?>">
            <div class="cabecalho">
                <img src="/teste_api/<?= $time['Escudo'] ?>">
            </div>
        </a>

    <?php endforeach; ?>

</section>



</body>

</html>