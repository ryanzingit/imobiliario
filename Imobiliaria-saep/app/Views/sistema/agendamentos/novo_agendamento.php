<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Agendamento</title>
    </head>
    <body>
        <h1>Novo Agendamento</h1>

        <form action="<?= base_url('agendamentos/inserir') ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" required>
            <br><br>

            <label>Serviço:</label><br>
            <input type="text" id="servico" name="servico" placeholder="Serviço..." required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" placeholder="Status..." required>
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

            <label>Veículo:</label><br>
            <select id="imovel" name="imovel" required>
                <option value="">Selecione um imovel</option>
                <?php foreach($imovel as $imo): ?>
                    <option value="<?= $imo['IMO_ID'] ?>">
                        <?= $imo['IMO_VALOR'] ?> - <?= $imo['IMO_TIPO'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="cadastrar_agendamento" name="cadastrar_agendamento" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>