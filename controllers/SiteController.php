<?php

namespace app\controllers;

use Bref\Logger\StderrLogger;
use Parsedown;
use Yii;
use yii\web\Controller;

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
