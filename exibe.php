<?php
require_once '_cabecalho.php';

$id = $_GET['id'];
$clubes_api = "http://localhost/teste_api/clube/$id";

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

$cores = explode(',', $result['clubes'][0]['Cores']);
$cores = implode(', ', $cores);
$gradiente = "style = 'background: linear-gradient(to bottom right, $cores);'";

?>

<section>
    <div class="cabecalho" <?= $gradiente ?>>
        <img src="/teste_api/<?= $result['clubes'][0]['Escudo'] ?>">

        <div class="conteudo">
            <h1><?= $result['clubes'][0]['Clube'] ?></h1>
            <p><b>Fundação</b>: <?= $result['clubes'][0]['Fundação'] ?> (<?= date('Y') - $result['clubes'][0]['Fundação'] ?> anos)</p>
            <p><b>Estádio</b>: <?= $result['clubes'][0]['Estádio'] ?></p>
        </div>
    </div>
    <div class="titulos">
        <h2 style="text-align: center;">Títulos</h2>
        <?php foreach ($result['clubes'][0]['Títulos'] as $titulo) : ?>
            <p>
                <b><?= $titulo['Campeonato'] ?> (<?= $titulo['Qntd'] ?>)</b>:
                <?php for ($i = 0; $i < $titulo['Qntd']; $i++) : ?>
                    <img src="/teste_api/<?= $titulo['Imagem'] ?>" class="taca">
                <?php endfor; ?>
            </p>
        <?php endforeach; ?>
    </div>
</section>
</body>

</html>