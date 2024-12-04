<?php

/** @var yii\web\View $this */
/** @var common\modules\shortlink\models\Link $model */

use yii\helpers\Url;

$this->title = $model->url;

$link = Url::toRoute(['/' . $model->hash], strpos($model->url, 'https://') ? 'https' : 'http');

?>

<div class="shortlink-view">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h2><?= $model->url ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <a href="<?= $link ?>"><?= $link ?></a>
            </div>
        </div>
    </div>
</div>