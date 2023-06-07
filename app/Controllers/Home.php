<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'Homepage',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }
}
