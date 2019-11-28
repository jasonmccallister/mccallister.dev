<?php

namespace app\controllers;

use yii\web\Controller;
use Bref\Logger\StderrLogger;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $logger = new StderrLogger();

        $logger->error(print_r($_SERVER, true));

        return $this->asJson(['hello' => 'world']);
    }

    public function actionHome()
    {
        return $this->render('home.twig', [
            'hello' => 'world',
            'content' => 'some content',
        ]);
    }
}
