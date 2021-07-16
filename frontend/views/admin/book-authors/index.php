<?php

use frontend\models\Book;
use frontend\models\Author;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\admin\search\BookAuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'book_id',
                'filter' => Book::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'book.name',
            ],
            [
                'attribute' => 'author_id',
                'filter' => Author::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'author.name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
