<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BookAuthor */

$this->title = 'Update Book Author: ' . $model->book_id;
$this->params['breadcrumbs'][] = ['label' => 'Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_id, 'url' => ['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
