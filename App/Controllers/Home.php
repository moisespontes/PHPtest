<?php

namespace App\Controllers;

use App\Models\Address;
use Core\LoadView;

class Home
{
    /**
     * Home constructor.
     *
     * @param string|null $param
     * @return void
     */
    public function index()
    {
        $data['script'] = ['form-validation', 'global'];
        $data['style'] = ['global'];
        (new LoadView($data))->render('/home');
    }

    /**
     * Verifica se o cep está cadastrado no banco
     *
     * @param integer|null $cep
     * @return void
     */
    public function getCep(?string $cep): void
    {
        $cep = (int) $cep;

        if (empty($cep)) {
            echo json_encode([
                'result' => false,
                'validate' => false
            ]);
            return;
        }

        if (strlen($cep) <> 8) {
            echo json_encode([
                'result' => false,
                'validate' => false
            ]);
            return;
        }

        $address = (new Address())->findCep($cep);

        if (empty($address)) {
            echo json_encode([
                'result' => false,
                'validate' => true
            ]);
            return;
        }

        $address = $address->data();
        unset($address->created, $address->modified);

        echo json_encode([
            'result' => true,
            'data' => $address
        ]);
        return;
    }

    /**
     * Execulta a ratina de cadasto
     *
     * @return void
     */
    public function createCep(): void
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($data)) {
            echo json_encode([
                'result' => false,
                'message' => "Erro ao buscar cep, tente mais tarde."
            ]);
            return;
        }

        $address = (new Address())->bootstrap($data);

        if ($address->save()) {
            echo json_encode([
                "result" => true,
                "data" => $address->data
            ]);
            return;
        }

        echo json_encode([
            "result" => false,
            "message" => "Erro ao buscar cep, tente mais tarde."
        ]);
        return;
    }
}
