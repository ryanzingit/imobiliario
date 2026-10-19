<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ImovelModel;
use App\Models\ProprietarioModel;

// Vincula o Veículo com seu respectivo Usuário (FK_USU_ID)
class ImovelController extends BaseController
{
    // Exibe a listagem de veículos
    public function index()
    {
        // Instancia o Model de veículos
        $model = new ImovelModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os veículos juntamente com o nome do cliente
            // responsável por cada veículo
            $dados['imovel'] = $model
                ->select('IMOVEL.*, PROPRIETARIO.PRO_NOME')

                // Relaciona VEICULOS com CLIENTES pela chave estrangeira
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = IMOVEL.FK_PRO_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pela placa
                    ->like('IMO_VALOR', $pesquisar)

                    // Pesquisa pela marca
                    ->orLike('IMO_ENDERECO', $pesquisar)

                    // Pesquisa pelo modelo
                    ->orLike('IMO_TIPO', $pesquisar)

                    // Também permite pesquisar pelo nome do proprietário
                    ->orLike('PROPRIETARIO.PRO_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os veículos
            // juntamente com o nome dos respectivos clientes
            $dados['imovel'] = $model
                ->select('IMOVEL.*, PROPRIETARIO.PRO_NOME')
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = IMOVEL.FK_PRO_ID'
                )
                ->findAll();
        }

        // Carrega a View de veículos
        return view('sistema/imovel/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo veículo
    public function novo()
    {
        // Instancia o Model de clientes
        $proprietarioModel = new ProprietarioModel();

        // Busca todos os clientes cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Carrega o formulário de cadastro do veículo
        return view('sistema/imovel/novo_imovel', $dados);
    }


    // Insere um novo veículo
    public function inserir()
    {
        // Instancia o Model de veículos
        $model = new ImovelModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'IMO_VALOR' => $this->request->getPost('valor'),
            'IMO_ENDERECO' => $this->request->getPost('endereco'),
            'IMO_TIPO' => $this->request->getPost('tipo'),
            

            // Guarda o ID do cliente escolhido no formulário
            // como chave estrangeira do veículo
            'FK_PRO_ID' => $this->request->getPost('proprietario')
        ];

        // Insere o veículo no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imovel'))
            ->with('success', 'imovel cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de veículos
        $imovelModel = new ImovelModel();

        // Instancia o Model de clientes
        $proprietarioModel = new ProprietarioModel();

        // Busca o veículo que será editado
        $dados['imovel'] = $imovelModel->find($id);

        // Busca todos os clientes para preencher o SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Carrega a View de edição
        return view('sistema/imovel/editar_imovel', $dados);
    }


    // Atualiza um veículo
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ImovelModel();

        // Recupera os novos dados do formulário
        $dados = [
            'IMP_VALOR' => $this->request->getPost('valor'),
            'IMO_ENDERECO' => $this->request->getPost('endereco'),
            'IMO_TIPO' => $this->request->getPost('tipo'),
            'FK_PRO_ID' => $this->request->getPost('proprietario')
        ];

        // Atualiza o veículo pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imovel'))
            ->with('success', 'imovel atualizado com sucesso!');
    }


    // Exclui um veículo
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ImovelModel();

        // Exclui o veículo pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imovel'))
            ->with('success', 'imovel excluído com sucesso!');
    }
}