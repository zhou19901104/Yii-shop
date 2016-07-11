<?php

use yii\helpers\Url;
use backend\widgets\Nav;
use yii\helpers\StringHelper;
?>
<!-- nav -->
<nav class="nav-primary hidden-xs">
    <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">目录</div>
    <?= Nav::widget([
        'items' => [
            [
                'label' => '统计分析',
                'url' => ['dashboard/index'],
                'icon' => 'i i-statistics icon',
                'rightIcon' => 'i i-circle-sm',
                'font' => 'font-bold',
            ],
            [
                'label' => '产品管理',
                'active' => StringHelper::startsWith($this->context->route, 'product') && !StringHelper::startsWith($this->context->route, 'product-order'),
                'icon' => 'i i-statistics icon',
                'rightIcon' => 'i i-circle-sm',
                'font' => 'font-bold',
                'items' => [
                     [
                        'label' => '产品列表',
                        'icon' => 'i i-dot icon',
                        'url' => ['product/index'],
                    ],
                    [
                        'label' => '添加产品',
                        'icon' => 'i i-dot icon',
                        'url' => ['product/create'],
                    ],
                    [
                        'label' => '分类列表',
                        'icon' => 'i i-dot icon',
                        'url' => ['product-category/index'],
                    ],
                    [
                        'label' => '添加分类',
                        'icon' => 'i i-dot icon',
                        'url' => ['product-category/create'],
                    ],
                    [
                        'label' => '属性分类',
                        'icon' => 'i i-dot icon',
                        'url' => ['product-attribute-category/index'],
                    ],
                    [
                        'label' => '属性列表',
                        'icon' => 'i i-dot icon',
                        'url' => ['product-attribute/index'],
                    ],
                    [
                        'label' => '添加属性',
                        'icon' => 'i i-dot icon',
                        'url' => ['product-attribute/create'],
                    ],
                ],
            ],
            [
                'label' => '订单管理',
                'active' => StringHelper::startsWith($this->context->route, 'product-order'),
                'icon' => 'i i-meter icon',
                'rightIcon' => 'i i-circle-sm',
                'font' => 'font-bold',
                'items' => [
                     [
                        'label' => '订单列表',
                        'icon' => 'i i-dot icon',
                        'url' => ['product-order/index'],
                    ],
                ],
            ],
        ],
    ]) ?>
    
    <div class="line dk hidden-nav-xs"></div>
    <div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm">快捷访问</div>
    <ul class="nav">
        <li>
            <a href="<?= Url::to(['product/index']) ?>">
            <i class="i i-circle-sm text-info-dk"></i>
            <span>产品列表</span>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['product-order/index']) ?>">
            <i class="i i-circle-sm text-success-dk"></i>
            <span>订单列表</span>
            </a>
        </li>
    </ul>
</nav>
<!-- / nav -->
