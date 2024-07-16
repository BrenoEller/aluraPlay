<?php

require "src/connection-db.php";

$videos = $pdo->query("SELECT * FROM videos;")->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
    require_once 'inicio-html.php';
?>
<ul class="videos__container" alt="videos alura">
    <?php foreach($videos as $video): ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $video['url'] ?>"
                title="<?= $video['title'] ?>" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?= $video['title'] ?></h3>
                <div class="acoes-video">
                    <a href="/editar-video?id=<?= $video['id'] ?>">Editar</a>
                    <a href="/remover-video?id=<?= $video['id'] ?>">Excluir</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<?php
    require_once 'fim-html.php';
?>