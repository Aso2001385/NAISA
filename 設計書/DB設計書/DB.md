# DB定義書
## ER図
[ER図]( https://github.com/Aso2001385/2021sys-design/blob/main/sample/ER.md )

## ユーザーテーブル
### user
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|ユーザー番号|user_id|int(20)|〇|〇|||
|ユーザー名|user_name|varchar(50)||〇|||
|メールアドレス|user_mail|varchar(50)||〇|||
|電話番号|user_tel|varchar(50)||〇|||
|郵便番号|user_post|varchar(50)|||||
|住所|user_addless|varchar(80)|||||
|出品数|user_sale|int||〇|||
|グッド数|user_good|int||〇||デフォルト0|
|バッド数|user_bad|int||〇||デフォルト0|
|レコード作成日時|user_created|datetime||〇||タイムスタンプ|
|レコード更新日時|user_updated|datetime||〇||タイムスタンプ|
|レコード削除日時|user_deleted|datetime||||タイムスタンプ|

## 商品テーブル
### item
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品番号|item_id|int|〇|〇|||
|ユーザー番号|item_user_id|int||〇|〇||
|カテゴリID|item_category_id|int|||〇||
|商品価格|item_price|int||〇||下限三百,上限十万|
|商品名|item_name|varchar(50)||〇|〇||
|商品名読み|item_nameRead|varchar(50)||||カタカナ|
|メーカー名|item_maker|varchar(50)|||||
|商品名読み|item_makerRead|varchar(50)||||カタカナ|
|色|item_color|int|||||
|サイズタイプ|item_sizeType|varchar(20)||||
|サイズ|item_size|varchar(20)||||||

### カテゴリマスタ
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|カテゴリID|category_id|int|〇|〇||
|カテゴリ名|category_name||〇|||
|||||||
