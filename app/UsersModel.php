<?php
/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\UserValuesModel;
use App\UserAttributesModel;


class UsersModel extends Model
{
    /**
     * Array contendo as colunas fillable
     *
     * @var array
     */
    protected $fillable = [
        'tipo_pessoa',
        'documento',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'nascimento',
        'uf'
    ];

    /**
     * Array contendo as colunas guarded
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * String contendo o nome da tabela
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Adiciona um novo usuário ao banco de dados
     *
     * @param   array           $params
     *
     * @return void
     */
    public static function addNewUser(array $params)
    {
        return DB::transaction(function() use ($params) {
            $id_user = DB::table('users')->insertGetId([
                'tipo_pessoa' => $params['tipo_pessoa'],
                'documento' => $params['documento'],
                'logradouro' => $params['logradouro'],
                'numero' => $params['numero'],
                'complemento' => $params['complemento'],
                'bairro' => $params['bairro'],
                'cidade' => $params['cidade'],
                'nascimento' => @$params['nascimento'],
                'uf' => $params['uf']
            ]);

            if(!intval($id_user))
                throw new \Exception("Não foi possível adicionar o usuário ao banco de dados");

            $dynamicValues = array_intersect_key($params, [
                'fantasia'=> null,
                'nome' => null,
                'sobrenome' => null,
                'razao_social' => null
            ]);

            foreach($dynamicValues as $attribute => $value) {
                $attr = DB::table("user_attributes")->where("attribute", $attribute)->first();

                DB::table('user_values')->insert([
                    'user_id' => $id_user,
                    'user_attribute_id' => $attr->id,
                    'value' => $value
                ]);
            }
        });
    }

    /**
     * Retorna a listagem de todos os usuários
     *
     * @return array
     */
    public static function getAllUsers()
    {
        $users = DB::table('users')
                ->select([
                    "users.*",
                ])
                ->get();

        $list = [];

        foreach($users as $user) {
            $attributes = DB::table('user_values')
                        ->select([
                            'user_values.user_id',
                            'user_values.value',
                            'user_attributes.attribute'
                        ])
                        ->join('user_attributes', 'user_attributes.id', '=', 'user_values.user_attribute_id')
                        ->where("user_values.user_id", $user->id)
                        ->get();

            $list[$user->id] = [
                "id" => $user->id,
                "tipo_pessoa" => $user->tipo_pessoa,
                "documento" => $user->documento,
                "logradouro" => $user->logradouro,
                "numero" => $user->numero,
                "complemento" => $user->complemento,
                "bairro" => $user->bairro,
                "cidade" => $user->cidade,
                "nascimento" => $user->nascimento,
                "uf" => $user->uf
            ];

            foreach($attributes as $attr) {
                $list[$user->id][$attr->attribute] = $attr->value;
            }

            $user = null;
            $attributes = null;
        }

        return $list;
    }

    /**
     * Retorna um user específico
     *
     * @param   int     $id_user
     *
     * @return
     */
    public static function getUser($id_user)
    {
        $user = DB::table('users')
                ->select([
                    "*",
                ])
                ->where("id", $id_user)
                ->first();

        $attributes = DB::table('user_values')
                    ->select([
                        'user_values.user_id',
                        'user_values.value',
                        'user_attributes.attribute'
                    ])
                    ->join('user_attributes', 'user_attributes.id', '=', 'user_values.user_attribute_id')
                    ->where("user_values.user_id", $id_user)
                    ->get();

        $attrList = [];
        foreach($attributes as $attr) {
            $attrList[$attr->attribute] = $attr->value;
        }

        return array_merge($attrList, collect($user)->toArray());
    }
}
