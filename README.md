# ICShop-Yii
ICShop-Yii | 基于Yii的电子商城系统

===============================

目录结构
-------------------

```
common
    config/              包含 共享 配置
    mail/                包含 视图 文件集 为 邮件
    models/              包含 模型 使用 后台 和 前台
console
    config/              包含 命令行 配置
    controllers/         包含 命令行 控制器 (命令)
    migrations/          包含 数据库 迁移
    models/              包含 命令行-指定 模型
    runtime/             包含 文件集 被生成 在 运行过程中
backend
    assets/              包含 应用 样式 比如 JavaScript 和 CSS
    config/              包含 后台 配置
    controllers/         包含 网络 控制器类
    models/              包含 后台-指定 模型
    runtime/             包含 文件集 被生成 在 运行过程中
    views/               包含 视图 文件集 为 网络 应用
    web/                 包含 入口脚本 和 网络资源
frontend
    assets/              包含 应用 样式 比如 JavaScript 和 CSS
    config/              包含 前台 配置
    controllers/         包含 网络 控制器类
    models/              包含 前台-指定 模型
    runtime/             包含 文件集 被生成 在 运行过程中
    views/               包含 视图 文件集 为 网络 应用
    web/                 包含 入口脚本 和 网络资源
    widgets/             包含 前台 控件
vendor/                  包含 依赖的第三方包
environments/            包含 基于环境的配置文件覆写
tests                    包含 大量测试 为 高级 应用
    codeception/         包含 使用Codeception测试框架的测试文件
```
