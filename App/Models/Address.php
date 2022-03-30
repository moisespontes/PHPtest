<?php

namespace App\Models;

use Core\Model;

class Address extends Model
{
    private $message;

    public function __construct()
    {
        parent::__construct('address');
    }

    /**
     * Inicialização do endereço
     *
     * @param array $data
     * @return Address
     */
    public function bootstrap(array $data): Address
    {
        $this->cep = str_replace('-', '', $data['cep']);
        $this->logradouro = $data['logradouro'];
        $this->bairro = $data['bairro'];
        $this->localidade = $data['localidade'];
        $this->uf = $data['uf'];

        return $this;
    }

    /**
     * Busca o cep
     *
     * @param integer $cep
     * @return Address|null
     */
    public function findCep(int $cep, string $columns = "*"): ?Address
    {
        $cep = $this->find("cep = :cep", "cep={$cep}", $columns);
        return $cep->fetch();
    }

    /**
     * Busca um enderreço pelo id
     *
     * @param integer $id
     * @param string $columns
     * @return Model|null
     */
    public function findId(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * Salva o endereço no banco de dados
     *
     * @return boolean
     */
    public function save(): bool
    {
        $data = (array) $this->data();

        /** Addres create */
        $address = $this->create($data);

        /** Addres create */
        if ($this->fail()) {
            $this->message = "Erro ao cadastrar, verifique os dados";
            return false;
        }

        $this->data = $this->findId($address);
        return true;
    }
}
