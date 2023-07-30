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

    public function actionBooks(){
        Yii::$app->db->createCommand()->batchInsert('book',[
            'name',
            'isbn',
            'year',
            'description',
            'created_at',
            'updated_at'
        ],
        [
            [
                'Евгений Онегин',
                '978-5-17-080739-1',
                1833,
                '«Евге́ний Оне́гин» — роман в стихах Александра Сергеевича Пушкина, написанный в 1823—1831 годах, одно из самых значительных произведений русской литературы. Поэма состоит из 8 глав («книг»), содержащих 389 стихотворных строф («стихов»).',
                time(),
                time()
            ],
            [
                'Мёртвые души',
                '978-5-17-080739-2',
                1842,
                '«Мёртвые ду́ши» — поэма Николая Васильевича Гоголя, написанная в 1835—1842 годах и изданная в 1842 году. Поэма состоит из двух частей: первая часть была опубликована в 1842 году, вторая — в 1855 году.',
                time(),
                time()
            ],
            [
                'Герой нашего времени',
                '978-5-17-080739-3',
                1840,
                '«Геро́й на́шего вре́мени» — роман Михаила Юрьевича Лермонтова, написанный в 1839—1840 годах и опубликованный в 1840 году. В романе описываются приключения героя-бунтаря Печорина, который, по словам автора, является «продуктом времени», «героем нашего времени».',
                time(),
                time()
            ]
        ])->execute();
        return ExitCode::OK;
    }
}