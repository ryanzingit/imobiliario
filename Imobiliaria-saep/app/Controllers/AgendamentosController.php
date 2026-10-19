<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendamentosModel;
use App\Models\ProprietarioModel;
use App\Models\ImovelModel;

// Vincula o Agendamento ao Veículo (FK_VEI_ID) com seu respectivo Usuário (FK_USU_ID)
class AgendamentosController extends BaseController
{
    // Exibe a listagem de agendamentos
    public function index()
    {
        // Instancia o Model de agendamentos
        $model = new AgendamentosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o termo digitado
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os agendamentos juntamente com
            // informações do cliente e do veículo
            $dados['agendamentos'] = $model
                ->select(
                    'AGENDAMENTO.*, 
                    PROPRIETARIO.PRO_NOME, 
                    IMOVEL.IMO_VALOR, 
                    IMOVEL.IMO_ENDERECO,
                    IMOVEL.IMO_TIPO'
                )

                // Relaciona o agendamento ao cliente
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = AGENDAMENTO.FK_PRO_ID'
                )

                // Relaciona o agendamento ao veículo
                ->join(
                    'IMOVEL',
                    'IMOVEL.IMO_ID = AGENDAMENTO.FK_IMO_ID'
                )

                // Agrupa as condições utilizadas na pesquisa
                ->groupStart()

                    // Pesquisa pelo nome do cliente
                    ->like('PROPRIETARIO.PRO_NOME', $pesquisar)

                    // Pesquisa pela placa
                    ->orLike('IMOVEL.IMO_VALOR', $pesquisar)

                    // Pesquisa pelo modelo do veículo
                    ->orLike('IMOVEL.IMO_ENDERECO', $pesquisar)

                    
                    // Pesquisa pelo status
                    ->orLike('AGE_STATUS', $pesquisar)

                ->groupEnd()

                // Ordena os agendamentos pela data e hora
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os agendamentos
            $dados['agendamentos'] = $model
                ->select(
                    'AGENDAMENTO.*, 
                    PROPRIETARIO.PRO_NOME, 
                    IMOVEL.IMO_VALOR, 
                    IMOVEL.IMO_TIPO'
                )

                // Relaciona o cliente ao agendamento
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = AGENDAMENTO.FK_PRO_ID'
                )

                // Relaciona o veículo ao agendamento
                ->join(
                    'IMOVEL',
                    'IMOVEL.IMO_ID = AGENDAMENTO.FK_IMO_ID'
                )

                // Ordena pela data e hora do agendamento
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }

        // Carrega a View com os agendamentos encontrados
        return view('sistema/agendamentos/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo agendamento
    public function novo()
    {
        // Instancia o Model de clientes
        $proprietarioModel = new ProprietarioModel();

        // Instancia o Model de veículos
        $imovelModel = new ImovelModel();

        // Busca todos os clientes para preencher o SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Busca todos os veículos para preencher o SELECT
        $dados['imovel'] = $imovelModel->findAll();

        // Carrega o formulário
        return view(
            'sistema/agendamentos/novo_agendamento',
            $dados
        );
    }


    // Insere um novo agendamento
    public function inserir()
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_STATUS' => $this->request->getPost('status'),

            // Cliente escolhido no formulário
            'FK_PRO_ID' => $this->request->getPost('proprietario'),

            // Veículo escolhido no formulário
            'FK_IMO_ID' => $this->request->getPost('imovel')
        ];

        // Insere o agendamento no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia os três Models necessários
        $agendamentosModel = new AgendamentosModel();
        $proprietarioModel = new ProprietarioModel();
        $imovelModel = new ImovelModel();

        // Busca o agendamento pelo ID
        $dados['agendamento'] = $agendamentosModel->find($id);

        // Busca os clientes para preencher o SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Busca os veículos para preencher o SELECT
        $dados['imovel'] = $imovelModel->findAll();

        // Carrega a View de edição
        return view(
            'sistema/agendamentos/editar_agendamento',
            $dados
        );
    }


    // Atualiza um agendamento
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_STATUS' => $this->request->getPost('status'),
            'FK_PRO_ID' => $this->request->getPost('proprietario'),
            'FK_IMO_ID' => $this->request->getPost('imovel')
        ];

        // Atualiza o agendamento no banco
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento atualizado com sucesso!');
    }


    // Exclui um agendamento
    public function excluir($id)
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Exclui o agendamento pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}