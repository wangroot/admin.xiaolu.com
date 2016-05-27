<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;    

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

<div class="nav-side-menu">
    <div class="brand"><img class="site-logo" src="./images/admin-logo.png"></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">

            <li>
                <a class="admin-home" href="<?= Yii::$app->homeUrl ?>">首页</a>
            </li>

            <?php if(Yii::$app->user->can('/adsplatform/strategy/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/strategy/index']) ?>">流量策略</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/adsplatform/position/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/position/index']) ?>">广告类型管理</a>
                </li>
            <?php endif; ?>

            <?php if(Yii::$app->user->can('/adsplatform/ad/list')):?>
            <li>
                <a href="<?= Url::to(['/adsplatform/ad/list']) ?>">联盟广告管理</a>
            </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/adsplatform/ad/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/ad/index']) ?>"><i class="fa "></i>自主广告管理</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/adsplatform/ad-analysis/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/ad-analysis/index']) ?>"><i class=""></i>广告报表</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/coop-income/index')):?>
                <li>
                    <a href="<?= Url::to(['/coop-income/index'])?>"><i class=""></i>第三方广告报表</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/adsplatform/channel/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/channel/index']) ?>"><i class="fa "></i>渠道管理</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/adsplatform/provider/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/provider/index']) ?>"><i class="fa "></i>广告商管理</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/admin-user/index')):?>
                <li>
                    <a href="<?= Url::to(['/admin-user/index']) ?>"><i class="fa  "></i>后台管理</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/admin/role/index')):?>
                <li>
                    <a href="<?= Url::to(['/admin/role/index']) ?>"><i class="fa  "></i>角色管理</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/adsplatform/admin-log/index')):?>
                <li>
                    <a href="<?= Url::to(['/adsplatform/admin-log/index']) ?>"><i class="fa  "></i>操作日志</a>
                </li>
            <?php endif;?>

            <?php if(Yii::$app->user->can('/datadict/index')):?>
                <li>
                    <a href="<?= Url::to(['/datadict/index']) ?>"><i class="fa "></i>字典管理</a>
                </li>
            <?php endif;?>

        </ul>
    </div>
</div>

<div id="wrapper">

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="panel">
                <div class="panel-body breadcrumb-nav">
                    <div class="pull-left">
                         <?= Breadcrumbs::widget([
                             'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                         ]);?>
                    </div>
                     <div class="pull-right">
                        <div class="" id="dropdown-menu-click">
                            <div class="" id="dropdown-menu-user">
                                <img class="padding-right-10" src="./images/fa-user.png">
                                <span class="padding-right-10"><?= Yii::$app->user->identity->username?></span>
                                <span class="caret"></span>
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a id="user-logout" href="javascript:;" data-param="<?= Yii::$app->getRequest()->getCsrfToken()?>" data-url="<?= Url::toRoute(['/site/logout'])?>">
                                        退出
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
            <?= $content ?>

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


