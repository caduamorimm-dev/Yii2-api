<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController // pesquisar o que activerController
{
    public $modelClass = 'app\models\User';

    public function actionIndex()    // retorna todos os usuários
    {
        $users = User::find()->all(); 
        return $users;
    }

    public function actionView(User $user) // pesquisar o que model binding    --   Verificar um usuario 
    {
        return $user; 
    }

    public function actionCreate() // criar ususario 
        {
            $user = new User();

            if ($user->load(Yii::$app->request->bodyParams, '') && $user->save()) {
                Yii::$app->response->setStatusCode(201);
                return [
                    'status' => 'success',
                    'message' => 'Usuário criado com sucesso.',
                    'user' => $user,
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Falha para salvar o usuário.',
                    'errors' => $user->getErrors(),
                ];
            }
        }

        public function actionUpdate(User $user) // atualizar usuario
        {
            if ($user->load(Yii::$app->request->bodyParams, '') && $user->save()) {
                Yii::$app->response->setStatusCode(201);
                return [
                    'status' => 'success',
                    'message' => 'Usuário atualizado com sucesso.',
                    'user' => $user,
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Falha para atualizar o usuário.',
                    'errors' => $user->getErrors(),
                ];
            }
        }

        public function actionDelete(User $user) // deletar usuario
        {
            if ($user->delete()) {
                Yii::$app->response->setStatusCode(201);
                return [
                    'status' => 'success',
                    'message' => 'Usario deletado com sucesso.',
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Falha ao deletar o usuário.',
                ];
            }
        }

}