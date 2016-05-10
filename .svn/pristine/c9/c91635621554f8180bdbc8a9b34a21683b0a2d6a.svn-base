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

<div class="container">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-signin'],
//            'fieldConfig' => [
//                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                'labelOptions' => ['class' => 'col-lg-1 control-label'],
//            ],
        ]); ?>
        <h2 class="form-signin-heading"><?= Html::encode($this->title) ?></h2>
        <label for="inputEmail" class="sr-only">后台账号</label>
        <?= $form->field($model, 'username')->textInput(["placeholder"=>"后台账号",'required'=> 'required', 'autofocus'=>'autofocus' ])->label(false)?>
        <label for="inputPassword" class="sr-only">后台密码</label>
        <?= $form->field($model, 'password')->passwordInput(["class"=>"form-control" ,"placeholder"=>"后台密码", "required"=>"required"])->label(false)?>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> 自动登陆
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
    <?php ActiveForm::end(); ?>
</div> <!-- /container -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>