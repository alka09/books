<?php


namespace frontend\controllers\admin;

use frontend\models\admin\search\BookAuthorSearch;
use frontend\models\BookAuthor;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BookAuthorsController implements the CRUD actions for BookAuthor model.
 */

class BookAuthorsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BookAuthor models
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookAuthorSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BookAuthor model.
     * @param integer $book_id
     * @param integer $author_id
     * @return mixed
     */
    public function actionView(int $book_id, int $author_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($book_id, $author_id),
        ]);
    }

    /**
     * Displays a single BookAuthor model.
     * @param integer $book_id
     * @param integer $author_id
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BookAuthor();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect((['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]));
        } else {
            return $this->redirect('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BookAuthor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $book_id
     * @param integer $author_id
     * @return mixed
     */
    public function actionUpdate(int $book_id, int $author_id)
    {
        $model = $this->findModel($book_id, $author_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BookAuthor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $book_id
     * @param integer $author_id
     * @return mixed
     */
    public function actionDelete(int $book_id, int $author_id)
    {
        $this->findModel($book_id, $author_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BookAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $book_id
     * @param integer $author_id
     * @return BookAuthor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $book_id, int $author_id)
    {
        if (($model = BookAuthor::findOne(['book_id' => $book_id, 'author_id' => $author_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}