<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\extensions\widget\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Nav;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="后台管理">
    <meta name="author" content="ishengge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=  Yii::$app->homeUrl?>">广告后台管理</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown"  id="login-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= Yii::$app->user->identity->username?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i>个人信息</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i>邮件</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i>用户设置</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <?=
                        Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            '<i class="fa fa-fw fa-power-off"></i>登出',
                            ['class' => 'btn btn-link']
                        )
                        . Html::endForm()
                        ?>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav" id="nav-left-menu">
                <li>
                    <a href="<?= Yii::$app->homeUrl?>"><i class="fa "></i>首页</a>
                </li>
                <li>
                    <a href="<?= Url::to(['/adsplatform/strategy/index'])?>"><i class="fa "></i>流量策略</a>
                </li>
                <?php if(!in_array(Yii::$app->user->identity->username, ['guiyuan', 'chenfengxia'])){?>
                    <li>
                        <a href="<?= Url::to(['/adsplatform/position/index'])?>" ><i class="fa "></i>广告类型管理</a>
                    </li>
                <?php }?>

                <li>
                    <a href="<?= Url::to(['/adsplatform/ad/list'])?>" ><i class="fa "></i>联盟广告管理</a>
                </li>

                <li>
                    <a href="<?= Url::to(['/adsplatform/ad/index'])?>" ><i class="fa "></i>自主广告管理</a>
                </li>
                <li>
                    <a href="<?= Url::to(['/adsplatform/ad-analysis/index'])?>" ><i class=""></i>广告报表</a>
                </li>
                <?php if(!in_array(Yii::$app->user->identity->username, ['guiyuan', 'chenfengxia'])){?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/provider/index'])?>"><i class="fa "></i>广告商管理</a>
                </li>
                <li>
                    <a href="<?= Url::to(['/admin-user/index'])?>"><i class="fa  "></i>后台管理</a>
                </li>
                <li>
                    <a href="<?= Url::to(['/datadict/index'])?>"><i class="fa "></i>字典管理</a>
                </li>
                <?php }?>
            </ul>




        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        <?= Html::encode($this->title);?>
                    </h3>
                    <?=
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                    ?>
                </div>
            </div>
            <!-- /.row -->


            <?= $content?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

