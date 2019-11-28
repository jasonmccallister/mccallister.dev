<?php

namespace app\controllers;

use Yii;
use Bref\Logger\StderrLogger;
use yii\web\Controller as YiiController;

class Controller extends YiiController
{
    /**
     * Returns a 404 not found template.
     *
     * @param string $view
     * @param string $message
     *
     * @return void
     */
    protected function notFound(
        string $view = '404.twig',
        string $message = 'The page you requested was not found',
        int $code = 404
    ) {
        Yii::$app->getResponse()->setStatusCode($code);

        return $this->render($view, [
            'message' => $message,
        ]);
    }
}
