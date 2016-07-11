<?php
use common\models\ProductCategory;
use yii\helpers\Url;
use yii\helpers\Html;

$this->registerJsFile('js/header.js', ['depends' => ['frontend\assets\AppAsset']]);
?>
<div style="clear:both;"></div>

<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl"><a href="<?= Yii::$app->homeUrl ?>"><img src="/images/logo.png" alt="京西商城"></a></h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="<?= Url::to(['search/index']) ?>" method="get" class="fl">
                    <input type="text" class="txt" value="<?php if (isset($keyword) && $keyword): ?><?= Html::encode($keyword) ?><?php else: ?>请输入商品关键字<?php endif; ?>" name="keyword" /><input type="submit" class="btn" value="搜索" />
                </form>
                <div class="form_right fl"></div>
            </div>
            
            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="">D-Link无线路由</a>
                <a href="">休闲男鞋</a>
                <a href="">TCL空调</a>
                <a href="">耐克篮球鞋</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->
        <div class="user fl">
            <dl>
                <dt>
                    <em></em>
                    <a href="">用户中心</a>
                    <b></b>
                </dt>
                <dd>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <div class="prompt">
                            您好，请<a href="">登录</a>
                        </div>
                    <?php endif; ?>
                    <div class="uclist mt10">
                        <ul class="list1 fl">
                            <li><a href="">用户信息></a></li>
                            <li><a href="">我的订单></a></li>
                            <li><a href="">收货地址></a></li>
                            <li><a href="">我的收藏></a></li>
                        </ul>

                        <ul class="fl">
                            <li><a href="">我的留言></a></li>
                            <li><a href="">我的红包></a></li>
                            <li><a href="">我的评论></a></li>
                            <li><a href="">资金管理></a></li>
                        </ul>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="viewlist mt10">
                        <h3>最近浏览的商品：</h3>
                        <ul>
                            <li><a href=""><img src="/images/view_list1.jpg" alt="" /></a></li>
                            <li><a href=""><img src="/images/view_list2.jpg" alt="" /></a></li>
                            <li><a href=""><img src="/images/view_list3.jpg" alt="" /></a></li>
                        </ul>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 用户中心 end-->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt>
                    <a href="<?= Url::to(['cart/step1']) ?>">去购物车结算</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        购物车中还没有商品，赶紧选购吧！
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->
    
    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <!--  商品分类部分 start-->
        <div class="category fl <?= $this->context->route == Yii::$app->defaultRoute ? '' : 'cat1' ?>"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd <?= $this->context->route == Yii::$app->defaultRoute ? '' : 'off' ?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>
            
            <div class="cat_bd <?= $this->context->route == Yii::$app->defaultRoute ? '' : 'none' ?>">
                <?php foreach(ProductCategory::getListByLevel(1) as $productCategory): ?>
                    <div class="cat">
                        <h3><a href=""><?= $productCategory->name ?></a> <b></b></h3>
                        <div class="cat_detail">
                            <?php foreach(ProductCategory::getListByParentId($productCategory->id) as $secondProductCategory): ?>
                                <dl class="dl_1st">
                                    <dt><a href=""><?= $secondProductCategory->name ?></a></dt>
                                    <?php $lastProductCategories = ProductCategory::getListByParentId($secondProductCategory->id); ?>
                                    <?php if ($lastProductCategories): ?>
                                        <dd>
                                            <? foreach($lastProductCategories as $lastProductCategory): ?>
                                                <a href=""><?= $lastProductCategory->name ?></a>
                                            <? endforeach; ?>
                                        </dd>
                                    <? endif; ?>
                                </dl>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!--  商品分类部分 end--> 

        <div class="navitems fl">
            <ul class="fl">
                <li class="current"><a href="<?= Yii::$app->homeUrl ?>">首页</a></li>
                <li><a href="javascript:">电脑频道</a></li>
                <li><a href="javascript:">家用电器</a></li>
                <li><a href="javascript:">品牌大全</a></li>
                <li><a href="javascript:">团购</a></li>
                <li><a href="javascript:">积分商城</a></li>
                <li><a href="javascript:">夺宝奇兵</a></li>
            </ul>
            <div class="right_corner fl"></div>
        </div>
    </div>
    <!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<div style="clear:both;"></div>
