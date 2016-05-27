<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\LoginAsset;
LoginAsset::register($this);

$this->title = '后台登陆';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage() ?>

<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="login-background">
    <div class="logo-background">
    </div>
</div>
<div class="container" style="margin-top: 37px">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => [
                'class' => 'form-inline',
                'style' => 'text-align: center;',
            ],
            'fieldConfig' => [
               // 'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['style' => 'padding-right:22px'],
            ],
        ]); ?>
    <div style="margin-left: 56px">
        <div class="row">
            <?= $form->field($model, 'username')
                ->textInput(["placeholder"=>"请输入账号",'required'=> 'required', 'autofocus'=>'autofocus', 'style'=>' width: 399px;
  height: 46px;' ])
                ->label()?>
        </div>

        <div class="row">
            <?= $form->field($model, 'password')
                ->passwordInput(["class"=>"form-control" ,"placeholder"=>"请输入密码", "required"=>"required", 'style'=>' width: 399px;
  height: 46px;'])
                ->label()?>
        </div>
</div>
        <div class="row">
            <div class="checkbox" style="margin-right: 231px; margin-bottom: 20px">
                <label>
                    <input type="checkbox" value="remember-me">记住密码
                </label>
            </div>
        </div>

        <div class="row">
            <button class="btn"  style="margin-left: 100px; width: 400px; background-color: #3191ff; color: #FFFFFF" type="submit">登录</button>
        </div>

    <?php ActiveForm::end(); ?>
</div> <!-- /container -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>