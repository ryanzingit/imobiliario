<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ImovelModel extends Model
{
    protected $table = 'IMOVEL'; // nome da tabela
    protected $primaryKey = 'IMO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela VEICULOS do banco
        'IMO_VALOR',
        'IMO_ENDERECO',
        'IMO_TIPO',
        'FK_PRO_ID'
    ];
}