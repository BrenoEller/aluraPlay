<?php
    require_once 'inicio-html.php';
?>
<main class="container">
    <form class="container__formulario" method="POST">
        <h2 class="formulario__titulo">Efetue login</h2>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="email">E-mail</label>
                <input name="email" type="email" class="campo__escrita" required
                    placeholder="Digite seu email" id="email"/>
            </div>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="passwor">Senha</label>
                <input type="password" name="password" class="campo__escrita" required placeholder="Digite sua senha"
                    id='senha' />
            </div>
            <input class="formulario__botao" type="submit" value="Entrar" />
    </form>
</main>
<?php
    require_once 'fim-html.php';
?>