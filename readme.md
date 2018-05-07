# 商品API

## 概要

商品の検索・管理するWeb API

具体的な機能

* 商品の表示
* 商品の作成
* 商品の編集
* 商品の検索
* 商品の削除

## 使用した技術要素

* 言語:php(7.1.7)
* フレームワーク:Laravel(???)
* データベース:MySQL(5.7.21)


## 全体の設計・構成についての説明


### Route
| Domain | Method    | path          | 機能          | アクション                                      | Middleware   |
|--------|-----------|--------------|---------------|---------------------------------------------|--------------|
|        | GET  | /            |               | Closure                                     | web          |
|        | GET  | api/user     |               | Closure                                     | api,auth:api |
|        | GET  | menus        | 一覧表示   | MenuController@index   | web          |
|        | POST      | menus        | 商品の登録   | MenuController@store   | web          |
|        | GET  | menus/search | 商品の検索     | MenuController@search  | web          |
|        | GET  | menus/{menu} | 詳細表示    | MenuController@show    | web          |
|        | PUT or PATCH | menus/{menu} | 商品更新  | MenuController@update  | web          |
|        | DELETE    | menus/{menu} | 商品削除 | MenuController@destroy | web   


## 開発環境のセットアップ手順

1. DBを作成
1. SQLダンプをインポート(/menu_zukan/app/ddl/todo_2018-04-05.sql)
1. ソースコードをcloneする 
1. /todo_managementer/app/Config/database.phpの69行目以降(host/login/password/database)の値を、以下のように変更する

```
public $default = array(
	'datasource' => 'Database/Mysql',
	'persistent' => false,
	'host' => '自身のMYSQLホスト名',
	'login' => 'ユーザー名',
	'password' => 'パスワード',
	'database' => 'DB名',
	'prefix' => '',
	'timezone' => 'Asia/Tokyo',
	'encoding' => 'utf8',
);

```

1. cd /menu_zukanでmenu_zukanディレクトリに移動
1. 以下のようにドキュメントルートを指定して実行
```
php -S localhost:8080 -t ./public/
```


## 動作確認できるURI

http://ity-y.sakura.ne.jp/todo_managementer/
