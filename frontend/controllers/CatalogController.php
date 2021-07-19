<?php


namespace frontend\controllers;

use frontend\models\Book;
use frontend\models\Author;
use frontend\models\admin\search\BookSearch;
use frontend\tests\functional\HomeCest;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{

    public function beforeAction($action)
    {
        $model = new BookSearch();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $q = Html::encode($model->q);
            return $this->redirect(Yii::$app->urlManager->createUrl(['catalog/search', 'q' => $q]));
        }
        return true;
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuthor($author): string
    {
        $author = $this->findAuthorModel($author);

        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->forAuthor($author->id)->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('author', [
            'author' => $author,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id): string
    {
        $model = $this->findBookModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param string $name
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAuthorModel(string $name): Author
    {
        if (($model = Author::findOne(['name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findBookModel(int $id): Book
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSearch(): string
    {
//        $model = new BookSearch();
//
//        $dataProvider = $model->search(Yii::$app->request->queryParams);
//
//        return $this->render('search', [
//            'dataProvider' => $dataProvider,
//        ]);

        return $this->render('search');

    }
}

