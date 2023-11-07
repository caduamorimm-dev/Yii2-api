<?php

namespace app\controllers;

use Yii;
use app\models\Company;
use yii\rest\ActiveController;

class CompanyController extends ActiveController
{
    public $modelClass = 'app\models\Company';

    public function actionIndex() // verificar todos os company
    {
        $companies = Company::find()->all();
        return $companies;
    }

    public function actionView(Company $company)  // verificar um company especifico 
    {
        return $company;
    }

    public function actionCreate() // criar company
        {
            $company = new Company();

            if ($company->load(Yii::$app->request->bodyParams, '') && $company->save()) {
                Yii::$app->response->setStatusCode(201);
                return [
                    'status' => 'success',
                    'message' => 'Compania criada com sucesso.',
                    'comapny' => $company,
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Falha para salvar a Compania.',
                    'errors' => $company->getErrors(),
                ];
            }
        }

        public function actionUpdate(Company $company) // atualizar company
        {
            if ($company->load(Yii::$app->request->bodyParams, '') && $company->save()) {
                Yii::$app->response->setStatusCode(201);
                return [
                    'status' => 'success',
                    'message' => 'Compania atualizada com sucesso.',
                    'company' => $company,
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Falha para atualizar a compania.',
                    'errors' => $company->getErrors(),
                ];
            }
        }

        public function actionDelete(Company $company) // deletar company
        {
            if ($company->delete()) {
                Yii::$app->response->setStatusCode(201);
                return [
                    'status' => 'success',
                    'message' => 'Compania deletada com sucesso.',
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Falha ao deletar compania.',
                ];
            }
        }
}