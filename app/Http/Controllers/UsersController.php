<?php
/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ZLX\Cache\Cache as ZLXCache;

use App\UsersModel;

class UsersController extends Controller
{
    /**
     * Lista todos os usuários cadastrados, com paginação, e Cache, em JSON
     *
     * @return void
     */
    public function listAll()
    {
        try {
            $_list = ZLXCache::remember("Users.list", function() {
                return UsersModel::getAllUsers();
            });

            if(!$_list)
                throw new \Exception("Nenhum resultado encontrado para a listagem de usuários.");

            return response()->json($_list);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Lista os dados de um usuário específico
     *
     * @param   int         $id_user
     *
     * @return void
     */
    public function specific($id_user)
    {
        try {
            $_user = ZLXCache::remember("Users.specific." . $id_user, function() use ($id_user) {
                return UsersModel::getUser($id_user);
            });

            return response()->json($_user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
