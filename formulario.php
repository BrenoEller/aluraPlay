<?php

require "src/connection-db.php";

$id = filter_input(INPUT_GET, 'id');

$video = [
    'url' => '',
    'title' => ''
];

if($id !== false && $id !== null) {
    $statement = $pdo->prepare("SELECT * FROM videos WHERE id = ?;");
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(PDO::FETCH_ASSOC);
}
?>
<?php
    require_once 'inicio-html.php';
?>
    <main class="container">
        <form class="container__formulario" method="POST">
            <h2 class="formulario__titulo">Envie um vídeo!</h3>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" class="campo__escrita" required value="<?= $video['url'] ?>"
                        placeholder="<?= $video['url'] ?>" id='url'/>
                </div>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" class="campo__escrita" value="<?= $video['title'] ?>" required placeholder="<?= $video['title'] ?>"
                        id='titulo' />
                </div>
                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>
    </main>
<?php
    require_once 'fim-html.php';
?>