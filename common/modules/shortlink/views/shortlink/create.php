<?php

/** @var yii\web\View $this */
/** @var common\modules\shortlink\forms\LinkForm $form */

$this->title = 'Сокращение ссылки';

?>

<div class="shortlink-create">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <?= $this->render('_form', [
                    'form' => $form,
                ]) ?>
            </div>
        </div>
    </div>
</div>

