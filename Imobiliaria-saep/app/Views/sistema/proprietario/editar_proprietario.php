<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar proprietario</title>
    </head>
    <body>
        <h1>Editar proprietario</h1>

        <form action="<?= base_url('proprietario/atualizar/'.$proprietario['PRO_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $proprietario['PRO_NOME'] ?>" required>
            <br><br>
            <label>CPF:</label><br>
            <input type="text" id="cpf" name="cpf" value="<?= $proprietario['PRO_CPF'] ?>" required>
            <br><br>
            <label>Telefone:</label><br>
            <input type="tel" id="telefone" name="telefone" value="<?= $proprietario['PRO_TELEFONE'] ?>" required>
            <br><br>
            <input type="submit" id="editar_proprietario" name="editar_proprietario" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('proprietario') ?>"><button>Voltar</button></a>
    </body>
</html>