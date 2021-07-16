<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\BookAuthor */

$this->title = $model->book_id;
$this->params['breadcrumbs'][] = ['label' => 'Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'book_id' => $model->book_id, 'author_id' => $model->author_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'book_id' => $model->book_id, 'author_id' => $model->author_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'book_id',
                'value' => ArrayHelper::getValue($model, 'book.name'),
            ],
            [
                'attribute' => 'author_id',
                'value' => ArrayHelper::getValue($model, 'author.name'),
            ],
        ],
    ]) ?>

</div>
