<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\BookAuthor */

$this->title = 'Create Book Author';
$this->params['breadcrumbs'][] = ['label' => 'Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
