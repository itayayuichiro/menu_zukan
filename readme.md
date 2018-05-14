# 商品API

## 概要

商品の検索・管理するWeb API

具体的な機能
* 商品の登録
* 商品の検索
* 商品の変更
* 商品の削除

今回は商品のサンプルデータとして、とある居酒屋のメニュー情報を利用する。

## 使用した技術要素

* 言語:php(7.1.7)
* フレームワーク:Laravel(5.5.40)
* データベース:MySQL(5.7.21)


## 全体の設計・構成についての説明


### Route
| Method    | path          | 機能          | アクション                                      | Middleware   |
|-----------|--------------|---------------|---------------------------------------------|--------------|
| GET  | /api/menus        | 一覧表示   | MenuController@index   | web          |
| POST      | /api/menus        | 商品の登録   | MenuController@store   | web          |
| GET  | /api/menus/search | 商品の検索     | MenuController@search  | web          |
| GET  | /api/menus/{menu} | 詳細表示    | MenuController@show    | web          |
| PUT or PATCH | /api/menus/{menu} | 商品更新  | MenuController@update  | web          |
| DELETE    | /api/menus/{menu} | 商品削除 | MenuController@destroy | web   |


### リクエスト/レスポンス例

#### 一覧表示

**URL**
/api/menus

**メソッド**
GET

**リクエスト**
```
curl --request GET \  --url http://localhost:8080/api/menus
```

**レスポンス**
```
[
    {
        "id": 1,
        "title": "トリュフ風きも焼",
        "description": "あの食材がなんと298円！肝との相性も抜群。絶対に注文したい一品！",
        "price": 230,
        "image_base64": "/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAUgAA..."
    },
    {
        "id": 2,
        "title": "むね肉からし高菜焼",
        "description": "ごま油で和えたからし高菜をむね肉の串にトッピング。ピリッと来る辛味との相性は抜群！",
        "price": 250,
        "image_base64": "/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAUgAA..."
    },
    ・
    ・
    ・
 ]

```
* id:商品ID
* title:商品タイトル商品画像
* description:説明文
* price:価格
* image_base64:商品画像（base64エンコード）

#### 商品の登録

**URL**
/api/menus

**メソッド**
POST

リクエスト
```
curl --request POST \
  --url http://localhost:8080/api/menus \
  --header 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  --form 'title=新メニュー（豆）' \
  --form 'description=美味しい豆' \
  --form price=100 \
  --form 'image_base64=/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAUgAA/+4AJkFk...'
```

* title:商品タイトル商品画像(最大100文字)
* description:説明文(最大500文字)
* price:価格
* image_base64:商品画像（base64エンコード）

レスポンス(成功)
```
{
    "result": "success"
}
```
レスポンス（失敗：タイトルの長さが許容量を超えていた）
```
{
    "result": "error",
    "message": {
        "errorInfo": [
            "22001",
            1406,
            "Data too long for column 'title' at row 1"
        ]
    }
}
```
* result:登録に成功したか(成功: success,失敗: error)
* message:失敗した理由

#### 商品の検索
**URL**
/api/menus/search

**メソッド**
GET

**リクエスト**
```
curl --request GET \
  --url 'http://localhost:8080/api/menus/search?keyword=%E7%84%BC'
```
* keyword:検索したいワード

**レスポンス**
```
[
    {
        "id": 62,
        "title": "カシスシャーベット",
        "description": "欧州では伝統的なリキュール素材のカシス。爽やかな酸味と甘味をシャーベットで。",
        "price": 250,
        "image_base64": "/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAUgAA..."
    },
    {
        "id": 94,
        "title": "カシスミルク",
        "description": "フルーティーな香りと味わいのリキュール。香りと味わいを牛乳割りでまろやかに。",
        "price": 265,
        "image_base64": null
    },
    {
        "id": 95,
        "title": "カシスソーダ",
        "description": "フルーティーな香りと味わいのリキュール。すっきりとした飲みやすい味わい。",
        "price": 270,
        "image_base64": null
    },
    {
        "id": 96,
        "title": "カシスオレンジ",
        "description": "フルーティーな香りと味わいのリキュール。カシスとオレンジのフルーティーさが香る。",
        "price": 250,
        "image_base64": null
    },
    {
        "id": 97,
        "title": "カシスウーロン",
        "description": "フルーティーな香りと味わいのリキュール。ウーロン茶のさっぱりとした味わい。",
        "price": 250,
        "image_base64": null
    }
]
```
* id:商品ID
* title:商品タイトル商品画像
* description:説明文
* price:価格
* image_base64:商品画像（base64エンコード）

#### 商品削除
**URL**
/api/menus/{id}

**メソッド**
DELETE

**リクエスト**
```
curl --request DELETE \
  --url http://localhost:8080/api/menus/126
```
* id:削除したい商品のID

**レスポンス(成功)**
```
{
    "result": "success"
}
```
**レスポンス(失敗)**
```
{
    "result": "error",
    "message": "ID not found"
}
```
* result:登録に成功したか(成功: success,失敗: error)
* message:失敗した理由

#### menus/show/{id}(詳細表示)
リクエスト例
```
curl --request GET \
  --url http://localhost:8080/menus/2
```

レスポンス(成功)
```
{
    "id": 2,
    "title": "むね肉からし高菜焼",
    "description": "ごま油で和えたからし高菜をむね肉の串にトッピング。ピリッと来る辛味との相性は抜群！",
    "price": 250,
    "image_base64": "/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAUgAA/+4AJkF..."
}
```

* title:商品タイトル商品画像(最大100文字)
* description:説明文(最大500文字)
* price:価格
* image_base64:商品画像（base64エンコード）

レスポンス(失敗)
```
{
    "result": "error",
    "message": "ID not found"
}
```
* result:登録に成功したか(成功: success,失敗: error)
* message:失敗した理由


#### 商品の更新

**URL**
/api/menus/{id}

**メソッド**
POST

リクエスト
```
curl --request POST \
  --url http://localhost:8080/api/menus \
  --header 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  --form 'title=新メニュー（豆）' \
  --form 'description=美味しい豆' \
  --form price=100 \
  --form 'image_base64=/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAUgAA/+4AJkFk...'
```

* title:商品タイトル商品画像(最大100文字)
* description:説明文(最大500文字)
* price:価格
* image_base64:商品画像（base64エンコード）

レスポンス(成功)
```
{
    "result": "success"
}
```
レスポンス（失敗：タイトルの長さが許容量を超えていた）
```
{
    "result": "error",
    "message": {
        "errorInfo": [
            "22001",
            1406,
            "Data too long for column 'title' at row 1"
        ]
    }
}
```
* result:登録に成功したか(成功: success,失敗: error)
* message:失敗した理由

## 開発環境のセットアップ手順

1. DBを作成
1. ソースコードをcloneする
1. SQLダンプをインポート(/menu_zukan/app/ddl/kensyu_2018-05-09.sql.gz)
1. /menu_zukan/app/config/database.phpの42行目以降のmysqlの設定を自分の環境に合わせる。

```
'mysql' => [
    'driver' => 'mysql',
    'host' => '自身のMYSQLホスト名',
    'database' => 'DB名',
    'username' => 'ユーザー名',
    'password' => 'パスワード',
    'unix_socket' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
],

```

1. cd /menu_zukanでmenu_zukanディレクトリに移動
1. 以下のようにドキュメントルートを指定して実行
```
php -S localhost:8080 -t ./public/
```


## 動作確認できるURI

http://kensyu.jeez.jp/


**例**

商品の一覧
http://kensyu.jeez.jp/api/menus

