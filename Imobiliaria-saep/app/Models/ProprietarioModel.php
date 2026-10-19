<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ProprietarioModel extends Model
{
    protected $table = 'PROPRIETARIO'; // nome da tabela
    protected $primaryKey = 'PRO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela CLIENTES do banco
        'PRO_NOME',
        'PRO_CPF',
        'PRO_TELEFONE'
    ];
}