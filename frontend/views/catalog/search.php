<?php

use frontend\models\admin\search\BookSearch;
use frontend\models\SearchForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $searchModel BookSearch */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;

$model = new BookSearch();

?>
<div class="catalog-index">
    <h2>search</h2>
<!---->
<!--    <!-- Search -->-->
<!--    <section class="box search">-->
<!--        <form method="get" action="--><?//= Url::to(['/catalog/search']) ?><!-->">-->
<!--            <input type="text" class="text" name="search" placeholder="search">-->
<!--        </form>-->
<!--    </section>-->
<!---->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    --><?//= ListView::widget([
//        'dataProvider' => $dataProvider,
//        'layout' => "{items}\n{pager}",
//        'itemView' => '_item',
//    ]); ?>
</div>