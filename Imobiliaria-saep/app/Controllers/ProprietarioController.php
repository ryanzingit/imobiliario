<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietarioModel;

class ProprietarioController extends BaseController
{
    // Exibe a listagem de clientes
    public function index()
    {
        // Instancia o Model responsável pela tabela CLIENTES
        $model = new ProprietarioModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca clientes que possuem o termo informado
            // no nome, CPF ou telefone
            $dados['proprietario'] = $model
                ->like('PRO_NOME', $pesquisar)
                ->orLike('PRO_CPF', $pesquisar)
                ->orLike('PRO_TELEFONE', $pesquisar)
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os clientes cadastrados
            $dados['proprietario'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os clientes encontrados
        return view('sistema/proprietario/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo cliente
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/proprietario/novo_proprietario');
    }


    // Insere um novo cliente no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Recupera os valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_CPF' => $this->request->getPost('cpf'),
            'PRO_TELEFONE' => $this->request->getPost('telefone')
        ];

        // Insere o novo cliente no banco
        $model->insert($dados);

        // Redireciona para a listagem de clientes
        return redirect()
            ->to(base_url('proprietario'))
            ->with('success', ' proprietario cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um cliente
    public function editar($id)
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Busca o cliente pelo ID recebido na URL
        $dados['proprietario'] = $model->find($id);

        // Carrega a View de edição enviando os dados do cliente
        return view('sistema/proprietario/editar_proprietario', $dados);
    }


    // Atualiza os dados de um cliente
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_CPF' => $this->request->getPost('cpf'),
            'PRO_TELEFONE' => $this->request->getPost('telefone')
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietario'))
            ->with('success', 'proprietario atualizado com sucesso!');
    }


    // Exclui um cliente
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietario'))
            ->with('success', 'proprietario excluído com sucesso!');
    }
}