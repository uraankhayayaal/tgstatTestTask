<?php

use common\modules\shortlink\forms\LinkForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\modules\shortlink\forms\LinkForm $form */

?>

<div class="shortlink-form">

    <?= Html::beginForm('', 'post', ['enctype' => 'multipart/form-data']) ?>

        <div class="form-group">
            <label for="url">Введите ссылку для сокращения</label>
            <?= Html::input('text', 'url', $form->url, [
                'class' => 'form-control' . (isset($form->errors['url']) && $form->errors['url'] ? ' is-invalid' : ''),
                'maxlength' => true,
                'data-length' => 255,
                'placeholder' => LinkForm::labels()['url'],
            ]) ?>
            <small id="urlHelp" class="form-text text-muted">Ссылка должна начаться с: <b>http://</b> ил <b>https://</b></small>
            <?php if (isset($form->errors['url']) && $form->errors['url']) { ?>
                <div class="invalid-feedback">
                    <?php foreach ($form->errors['url'] as $error) { ?>
                        <span><?= $error ?></span><br>
                    <?php }?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group mt-2">
            <?= Html::submitButton('Сократить', ['class' => 'btn btn-primary']) ?>
        </div>

    <?= Html::endForm() ?>
</div>
