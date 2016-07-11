<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$security = Yii::$app->getSecurity();

return [
    'name' => $faker->company,
    'parent_id' => rand(0, 100),
    'display_order' => rand(0, 100),

    'status' => 1,
    'created_at' => time(),
    'updated_at' => time(),
];
