<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de proprietarios</title>
    </head>
    <body>
        <h1>Lista de proprietarios</h1>

        <form method="POST" action="<?= base_url('proprietario') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($proprietario as $pro): ?>
                <tr>
                    <td><?= $pro['PRO_NOME'] ?></td>
                    <td><?= $pro['PRO_CPF'] ?></td>
                    <td><?= $pro['PRO_TELEFONE'] ?></td>
                    <td><a href="<?= base_url('proprietario/editar/'.$pro['PRO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('proprietario/excluir/'.$pro['PRO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('proprietario/novo') ?>"><button>Cadastrar proprietario</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>