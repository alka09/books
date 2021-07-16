<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];

//$crumbs = [];
//$parent = $model->category;
//$crumbs[] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
//while ($parent = $parent->parent) {
//    $crumbs[] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
//}
//$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], array_reverse($crumbs));

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'label' => 'Authors',
                        'value' => implode(', ', ArrayHelper::map($model->authors, 'id', 'name')),
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($model->description) ?>
        </div>
    </div>
</div>

