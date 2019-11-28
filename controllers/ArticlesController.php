<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\ErrorException;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ArticlesController extends Controller
{
    public function actionIndex()
    {
        return $this->asJson(['all' => 'articles']);
    }

    public function actionShow()
    {
        if (!$slug = Yii::$app->getRequest()->getQueryParam('slug')) {
            Yii::$app->getResponse()->setStatusCode(404);

            return $this->render('404.twig');
        }

        try {
            $yaml = YamlFrontMatter::parseFile('../content/' . $slug . '.md');
        } catch (ErrorException $e) {
            Yii::$app->getResponse()->setStatusCode(404);

            return $this->render('404.twig');
        }

        return $this->asJson([
            'meta' => $yaml->matter(),
            'body' => $yaml->body()
        ]);
    }
}
