<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Agendamento</title>
    </head>
    <body>
        <h1>Editar Agendamento</h1>

        <form action="<?= base_url('agendamentos/atualizar/'.$agendamento['AGE_ID']) ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($agendamento['AGE_DATA_HORA'])) ?>" required>
            <br><br>


            <label>Status:</label><br>
            <input type="text" id="status" name="status" value="<?= $agendamento['AGE_STATUS'] ?>" required>
            <br><br>

            <label>proprietario:</label><br>
            <select id="proprietario" name="proprietario" required>
                <?php foreach($proprietario as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $agendamento['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Veículo:</label><br>
            <select id="imovel" name="imovel" required>
                <?php foreach($imovel as $imo): ?>
                    <option value="<?= $imo['IMO_ID'] ?>"
                        <?= $imo['IMO_ID'] == $agendamento['FK_IMO_ID'] ? 'selected' : '' ?>>
                        <?= $imo['IMO_VALOR'] ?> - <?= $imo['IMO_TIPO'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="editar_agendamento" name="editar_agendamento" value="Salvar Alterações">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>