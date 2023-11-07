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
                    'message' => 'Company created successfully.',
                    'comapny' => $company,
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Failed to save the comapany.',
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
                    'message' => 'Company updated successfully.',
                    'company' => $company,
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Failed to update the company.',
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
                    'message' => 'Company deleted successfully.',
                ];
            } else {
                Yii::$app->response->statusCode = 422;
                return [
                    'status' => 'error',
                    'message' => 'Failed to delete the company.',
                ];
            }
        }
}