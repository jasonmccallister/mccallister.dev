<?php

namespace app\controllers;

use Yii;
use yii\base\ErrorException;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ArticlesController extends Controller
{
    public function actionIndex()
    {
        return $this->asJson(['all' => 'articles']);
    }

    /**
     * Shows a specific article using the slug
     *
     * @return void
     */
    public function actionShow()
    {
        if (!$slug = Yii::$app->getRequest()->getQueryParam('slug')) {
            return $this->notFound();
        }

        try {
            $yaml = YamlFrontMatter::parseFile('../content/' . $slug . '.md');
        } catch (ErrorException $e) {
            return $this->notFound();
        }

        return $this->asJson([
            'meta' => $yaml->matter(),
            'body' => $yaml->body()
        ]);
    }
}
