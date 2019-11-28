<?php

namespace app\controllers;

class SiteController extends Controller
{
    public function actionIndex()
    {
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
