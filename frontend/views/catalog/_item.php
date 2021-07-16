<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Book */

$authorLinks = [];
foreach ($model->authors as $author) {
$authorLinks[] = Html::a(Html::encode($author->name), ['author', 'author' => $author->name]);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
<?php if ($authorLinks): ?>
            <p>Tags: <?= implode(', ', $authorLinks) ?></p>
        <?php endif; ?>
        <div><?= Yii::$app->formatter->asNtext($model->description) ?></div>
    </div>
</div>

