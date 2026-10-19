<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Imovel</title>
    </head>
    <body>
        <h1>Novo imovel</h1>

        <form action="<?= base_url('imovel/inserir') ?>" method="POST">
            <label>Valor:</label><br>
            <input type="text" id="valor" name="valor" placeholder="Valor..." required>
            <br><br>

            <label>endereco:</label><br>
            <input type="text" id="endereco" name="endereco" placeholder="Endereco..." required>
            <br><br>

            <label>Tipo:</label><br>
            <input type="text" id="tipo" name="tipo" placeholder="tipo..." required>
            <br><br>


            <label>proprietario:</label><br>
            <select id="proprietario" name="proprietario" required>
                <option value="">Selecione um proprietario</option>
                <?php foreach($proprietario as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>">
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="cadastrar_imovel" name="cadastrar_imovel" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('imovel') ?>"><button>Voltar</button></a>
    </body>
</html>