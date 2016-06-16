<?php

/*
 * Hosting Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-hosting
 * @package   hipanel-module-hosting
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

/**
 * @link    http://hiqdev.com/hipanel-module-hosting
 * @license http://hiqdev.com/hipanel-module-hosting/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hipanel\modules\hosting\controllers;

use hipanel\actions\IndexAction;
use hipanel\actions\OrientationAction;
use hipanel\actions\SmartUpdateAction;
use hipanel\actions\ValidateFormAction;
use hipanel\actions\ViewAction;
use hipanel\modules\hosting\models\Crontab;
use Yii;
use yii\base\Exception;
use yii\web\Response;

class CrontabController extends \hipanel\base\CrudController
{
    public function actions()
    {
        return [
            'set-orientation' => [
                'class' => OrientationAction::class,
                'allowedRoutes' => [
                    '/hosting/crontab/index'
                ]
            ],
            'index' => [
                'class' => IndexAction::class,
                'filterStorageMap' => [
                    'server' => 'server.server.name',
                    'account' => 'hosting.account.login',
                    'client_id' => 'client.client.id',
                ]
            ],
            'view' => [
                'class' => ViewAction::class,
            ],
            'update' => [
                'class' => SmartUpdateAction::class,
            ],
            'validate-form' => [
                'class' => ValidateFormAction::class,
            ],
        ];
    }

    public function actionRequestFetch()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $response = [];
        $id = Yii::$app->request->post('id');
        if ($id) {
            try {
                $response = Crontab::perform('RequestFetch', ['id' => $id]);
            } catch (Exception $e) {
                $response['error'] = $e->errorInfo['response'];
            }
        }
        return $response;
    }

    public function actionGetRequestState()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = [];
        $id = Yii::$app->request->post('id');
        if ($id) {
            try {
                $response = Crontab::perform('GetRequestState', ['id' => $id]);
            } catch (Exception $e) {
                $response['error'] = $e->errorInfo['response'];
            }
        }
        return $response;
    }

    public function actionGetInfo($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = [];
        if ($id) {
            try {
                $response = Crontab::perform('GetInfo', ['id' => $id]);
            } catch (Exception $e) {
                $response = $e->errorInfo['response'];
            }
        }
        return $response;
    }
}
