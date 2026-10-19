<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar imovel</title>
    </head>
    <body>
        <h1>Editar imovel</h1>

        <form action="<?= base_url('imovel/atualizar/'.$imovel['IMO_ID']) ?>" method="POST">
            <label>Valor:</label><br>
            <input type="text" id="valor" name="valor" value="<?= $imovel['IMO_VALOR'] ?>" required>
            <br><br>

            <label>endereco:</label><br>
            <input type="text" id="marca" name="marca" value="<?= $imovel['IMO_ENDERECO'] ?>" required>
            <br><br>

            <label>Tipo:</label><br>
            <input type="text" id="modelo" name="modelo" value="<?= $imovel['IMO_TIPO'] ?>" required>
            <br><br>



            <label>proprietario:</label><br>
            <select id="proprietario" name="proprietario" required>
                <?php foreach($proprietario as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $imovel['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="editar_imovel" name="editar_imovel" value="Salvar Alterações">
        </form>
        <br>
        <a href="<?= base_url('imovel') ?>"><button>Voltar</button></a>
    </body>
</html>