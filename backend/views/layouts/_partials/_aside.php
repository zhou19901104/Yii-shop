<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>
<!-- .aside -->
<aside class="bg-black aside-md hidden-print hidden-xs <?= ArrayHelper::getValue($_COOKIE, 'nav-toggle-closed') == 'yes' ? 'nav-xs' : '' ?>" id="nav">
    <section class="vbox">
        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <!-- navUser -->
                    <?php // $this->render('_navUser') ?>
                <!-- / navUser -->
                <!-- nav -->
                    <?= $this->render('_nav') ?>
                <!-- / nav -->
            </div>
        </section>
        <footer class="footer hidden-xs no-padder text-center-nav-xs">
            <a href="#nav" id="nav-toggle" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
            <i class="i i-circleleft text"></i>
            <i class="i i-circleright text-active"></i>
            </a>
        </footer>
    </section>
</aside>
<!-- /.aside -->