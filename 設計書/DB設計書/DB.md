# DB定義書
## ER図
[ER図]( https://github.com/Aso2001385/2021sys-design/blob/main/sample/ER.md )

### user
|和名|属性名|型|PK|NN|FK|
|:---|:---|:---|:---:|:---:|:---:|
|ユーザー番号|user_id|int(20)|〇|〇||
|ユーザー名|user_name|varchar(50)||〇||
|レコード作成日時|user_created|datetime||〇||
|レコード更新日時|user_updated|datetime||〇||
|レコード削除日時|user_deleted|datetime||||




### purchase_detail
|和名|属性名|型|PK|NN|FK|
|:---|:---|:---|:---:|:---:|:---:|
|オーダー番号|order_id|bigint(20)|〇|〇|〇|
|明細番号|detail_id|bigint(20)|〇|〇||
|商品コード|item_code|int(11)||〇|〇|
|商品価格|price|int(11)||〇||
|数量|num|int(11)||〇||

### customers
|和名|属性名|型|PK|NN|FK|
|:---|:---|:---|:---:|:---:|:---:|
|顧客コード|customer_code|varchar(50)|〇|〇||
|パスワード|pass|varchar(50)||〇||
|名前|name|varchar(20)||〇||
|住所|address|varchar(100)||〇||
|電話番号|tel|varchar(20)||〇||
|メールアドレス|mail|varchar(100)||〇||
|削除フラグ|del_flag|int(11)||||
|登録日|reg_date|date||〇||
