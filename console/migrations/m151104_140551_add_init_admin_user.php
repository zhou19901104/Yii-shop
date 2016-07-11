<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\AdminUser;

class m151104_140551_add_init_admin_user extends Migration
{
    const INIT_ADMIN_EMAIL = 'suxiaolin@mail.com';

    public function up()
    {
        $adminUser = Yii::createObject(AdminUser::className());
        $adminUser->attributes = [
            'username' => '苏小林',
            'email' => self::INIT_ADMIN_EMAIL,
        ];
        $adminUser->setPassword('hahaha');
        $adminUser->generateAuthKey();
        $adminUser->save();
    }

    public function down()
    {
        if ($user = AdminUser::findOne(['email' => self::INIT_ADMIN_EMAIL])) {
            $user->delete();
        }
    }
}
