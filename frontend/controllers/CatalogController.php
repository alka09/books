<?php


namespace frontend\controllers;

use frontend\models\Book;
use frontend\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuthor($name): string
    {
        $author = $this->findAuthorModel($name);

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

}