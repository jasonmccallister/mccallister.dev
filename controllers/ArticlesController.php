<?php

namespace app\controllers;

use yii\web\Controller;

class ArticlesController extends Controller
{
    public function actionIndex()
    {
        return $this->asJson(['all' => 'articles']);
    }

    public function actionShow()
    {
        return $this->asJson(['one' => 'article']);
    }
}
