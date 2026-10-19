<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Veículos</title>
    </head>
    <body>
        <h1>Lista de Veículos</h1>

        <form method="POST" action="<?= base_url('imovel') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Valor</th>
                <th>Endereco</th>
                <th>Tipo</th>
                <th>proprietario</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($imovel as $imo): ?>
                <tr>
                    <td><?= $imo['IMO_VALOR'] ?></td>
                    <td><?= $imo['IMO_ENDERECO'] ?></td>
                    <td><?= $imo['IMO_TIPO'] ?></td>
                    <td><?= $imo['PRO_NOME'] ?></td>
                    <td><a href="<?= base_url('imovel/editar/'.$imo['IMO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('imovel/excluir/'.$imo['IMO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('imovel/novo') ?>"><button>Cadastrar Veículo</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>