<?php

namespace common\modules\shortlink\controllers;

use common\modules\shortlink\forms\LinkForm;
use common\modules\shortlink\services\interfaces\ShortlinkServiceInterface;
use Yii;
use yii\web\Controller;

final class ShortlinkController extends Controller
{
    public function actionCreate()
    {
        $linkForm = new LinkForm();

        if ($this->request->isPost) {
            if ($linkForm->load($this->request->post(), '') && $linkForm->validate()) {

                $link = Yii::$container->get(ShortlinkServiceInterface::class)->short($linkForm);

                Yii::$app->session->addFlash('success', 'Запись успешно создана!');

                return $this->redirect([
                    'view',
                    'hash' => $link->hash,
                ]);
            }
        }

        return $this->render('create', [
            'form' => $linkForm,
        ]);
    }

    public function actionView(string $hash)
    {
        $link = Yii::$container->get(ShortlinkServiceInterface::class)->getOne($hash);

        return $this->render('view', [
            'model' => $link,
        ]);
    }

    public function actionGo(string $hash)
    {
        $link = Yii::$container->get(ShortlinkServiceInterface::class)->getOne($hash);

        // Здесть можем получать статистику по переходам

        return $this->redirect($link->url);
    }
}
