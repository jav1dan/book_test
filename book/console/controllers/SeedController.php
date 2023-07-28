<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\db\Command;
use yii\console\ExitCode;

class SeedController extends Controller{
    public function actionAuthors(){
        Yii::$app->db->createCommand()->batchInsert('author',[
            'name',
            'surname',
            'fathername',
            'created_at',
            'updated_at'
        ],
        [
            [
                'Александр',
                'Пушкин',
                'Сергеевич',
                time(),
                time()
            ],
            [   'Михаил',
                'Лермонтов',
                'Юрьевич',
                time(),
                time()
            ],
            [
                'Николай',
                'Гоголь',
                'Васильевич',
                time(),
                time()
            ],
            [
                'Александр',
                'Грибоедов',
                'Сергеевич',
                time(),
                time()
            ],
            [
                'Александр',
                'Блок',
                'Александрович',
                time(),
                time()
            ]
        ])->execute();
        return ExitCode::OK;
    }
}