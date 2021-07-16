<?php

use frontend\models\admin\search\BookSearch;
use frontend\models\Book;
use frontend\models\Author;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
//            'created_at',
            [
                'label' => 'created_at',
                'attribute' => 'created_at',
                'format' => ['date', 'php:d-m-Y']
            ],
            'name',
//            'description:ntext',
            [
                'label' => 'description',
                'attribute' => 'description',
                'contentOptions' => ['style' => 'white-space: normal;']

            ],
            [
                'label' => 'Authors',
                'attribute' => 'author_id',
                'filter' => Author::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function (Book $book) {
                    return implode(', ', ArrayHelper::map($book->authors, 'id', 'name'));
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
