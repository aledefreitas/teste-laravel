<?php
/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\UsersModel;

use ZLX\Cache\Cache as ZLXCache;

use \DateTime;

class HomeController extends Controller
{
    /**
     * Método para a ação index() da controller
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cadastro');
    }

    /**
     * Cadastra uma pessoa física utilizando os dados do POST
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastro_pessoa_fisica()
    {
        try {
            if(!request()->isMethod('post')) {
                throw new \Exception("Não foi enviado um POST para o cadastro");
            }

            if(!preg_match("/^(\d{3})\.(\d{3})\.(\d{3})\-(\d{2})$/", request()->input('documento'))) {
                throw new \Exception("Por favor, digite um CPF válido");
            }

            if(trim(request()->input('nome')) == '') {
                throw new \Exception("Você deve preencher o campo de Nome");
            }

            if(trim(request()->input('sobrenome')) == '' || strlen(request()->input('sobrenome')) >= 8) {
                throw new \Exception("Você deve preencher o campo de Sobrenome");
            }

            // Validamos os inputs comuns em outra função
            $this->validateCommonFields();

            $params = request()->all();

            $params['tipo_pessoa'] = 'fisica';
            $params['documento'] = preg_replace("/[^0-9]+/", "", request()->input('documento'));
            $params['nascimento'] = $this->parseBirthDate(request()->input('nascimento'));

            UsersModel::addNewUser($params);

            ZLXCache::clearGroup("Users");

            View::share("success", true);
        } catch(\Exception $e) {
            $error = $e->getMessage();

            if(strstr($error, "Duplicate entry"))
                $error = "Documento já cadastrado.";

            View::share("error", $error);
        }

        return view('cadastro');
    }

    /**
     * Cadastra uma pessoa jurídica utilizando os dados do POST
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastro_pessoa_juridica()
    {
        try {
            if(!request()->isMethod('post')) {
                throw new \Exception("Não foi enviado um POST para o cadastro");
            }

            if(!preg_match("/^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})\-(\d{2})$/", request()->input('documento'))) {
                throw new \Exception("Por favor, digite um CNPJ válido");
            }

            if(trim(request()->input('fantasia')) == '') {
                throw new \Exception("Você deve preencher o campo de Nome Fantasia");
            }

            if(trim(request()->input('razao_social')) == '') {
                throw new \Exception("Você deve preencher o campo de Razão Social");
            }

            // Validamos os inputs comuns em outra função
            $this->validateCommonFields();

            $params = request()->all();

            $params['tipo_pessoa'] = 'juridica';
            $params['documento'] = preg_replace("/[^0-9]+/", "", request()->input('documento'));

            UsersModel::addNewUser($params);

            ZLXCache::clearGroup("Users");

            View::share("success", true);
        } catch(\Exception $e) {
            $error = $e->getMessage();

            if(strstr($error, "Duplicate entry"))
                $error = "Documento já cadastrado.";

            View::share("error", $error);
        }

        return view('cadastro');
    }

    /**
     * Valida os campos comuns entre pessoa física e jurídica
     *
     * @throws \Exception       Caso haja algum erro de validação
     *
     * @return void
     */
    private function validateCommonFields()
    {
        if(!intval(request()->input('cep')) || strlen(request()->input('cep')) != 8) {
            throw new \Exception("Você deve preencher o campo de Nome");
        }

        if(trim(request()->input('logradouro')) == '') {
            throw new \Exception("Você deve preencher o campo de Logradouro");
        }

        if(trim(request()->input('numero')) == '') {
            throw new \Exception("Você deve preencher o campo de Numero");
        }

        if(trim(request()->input('bairro')) == '') {
            throw new \Exception("Você deve preencher o campo de Bairro");
        }

        if(trim(request()->input('cidade')) == '') {
            throw new \Exception("Você deve preencher o campo de Cidade");
        }

        if(trim(request()->input('uf')) == '') {
            throw new \Exception("Você deve preencher o campo de UF");
        }
    }

    /**
     * Retorna o valor parseado da data de nascimento
     *
     * @param   string      $nascimento
     *
     * @return string
     */
    private function parseBirthDate($nascimento)
    {
        if(!preg_match("/^([0-2][1-9]|3[0-1])\/(0[1-9]|1[0-2])\/(19|20)[0-9]{2}$/", $nascimento)) {
            throw new \Exception("Data de nascimento inválida");
        }

        $birthdate = explode("/", $nascimento);
        $birthdate = $birthdate[2] . "-" . $birthdate[1] . "-" . $birthdate[0];

        $BirthDateTime = new DateTime($birthdate);
        $interval = $BirthDateTime->diff(new DateTime());

        if($interval->format("%Y") < 19) {
            throw new \Exception("É necessário ser maior de 19 anos para se cadastrar");
        }

        return $birthdate;
    }
}
