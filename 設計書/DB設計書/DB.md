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
|ペナルティ|user_penalty|int||〇||デフォルト0|
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
|商品画像|item_image|varchar(50)||〇||画像特定用コード|
|メーカー名|item_maker|varchar(50)|||||
|商品名読み|item_makerRead|varchar(50)||||カタカナ|
|色コード|item_color|int|||||
|サイズタイプ|item_sizeType|varchar(20)||||
|サイズ|item_size|varchar(20)||||||
|レコード作成日時|item_created|datetime||〇||タイムスタンプ|
|レコード更新日時|item_updated|datetime||〇||タイムスタンプ|
|取引開始日時|item_start||||now関数|

## カテゴリマスタ
###category
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|カテゴリ番号|category_id|int|〇|〇|||
|カテゴリ名|category_name|varchar(50)|〇||||
|レコード作成日時|category_created|datetime||〇||タイムスタンプ|
|レコード更新日時|category_updated|datetime||〇||タイムスタンプ|
|レコード削除日時|category_deleted|datetime||||タイムスタンプ|

##取引テーブル
###order
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品番号|order_item_id|int|〇|〇|〇||
|注文者番号|order_user_id|int||〇|〇||
|商品画像|order_item_image|varchar(50)||〇|〇||
|届先郵便番号|order_post|varchar(50)||〇|||
|届先住所|order_addless|varchar(80)||〇|||
|発送通知日時|order_send|datetime||||now関数|
|受取通知日時|order_recived|datetime||||now関数|
|レコード作成日時|order_created|datetime||〇||タイムスタンプ|
|レコード更新日時|order_updated|datetime||〇||タイムスタンプ|
|取引完了日時|order_completion|datetime||||now関数|
|取引中止日時|order_stop|datetime||||now関数|


##商品コメントテーブル
###comment(名称が浮かばない)
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品コメント番号|comment_id|int|〇|〇|||
|商品番号|comment_item_id|int||〇|〇||
|ユーザー番号|comment_user_id|int||〇|〇||
|ユーザー名|comment_user_name|varchar(50)||〇|〇||
|コメント内容|comment_contents|varchar(200)||〇|〇||
|プライベートフラグ|comment_private|int|||||
|レコード作成日時|comment_created|datetime||〇||タイムスタンプ|
|レコード更新日時|comment_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|comment_deleted|datetime||||タイムスタンプ|


##取引コメントテーブル
###comment(名称が浮かばない)
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|取引コメント番号|comment_item_id|int|〇|〇|〇||
|商品番号|comment_item_id|int||〇|〇||
|ユーザー番号|comment_user_id|int||〇|〇||
|ユーザー名|comment_user_name|varchar(50)||〇|〇||
|コメント内容|comment_contents|varchar(200)||〇|〇||
|レコード作成日時|comment_created|datetime||〇||タイムスタンプ|
|レコード更新日時|comment_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|comment_deleted|datetime||||タイムスタンプ|


##商品コメント通報テーブル
###commentReport(名称が浮かばない)
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|commentReport_id|int|〇|〇|〇||
|商品コメント番号|commentReport_comment_item_id|int||〇|〇||
|商品番号|commentReport_item_id|int||〇|〇||
|ユーザー番号|commentReport_user_id|int||〇|〇||
|通報理由|commentReport_reason|varchar(50)||〇|〇||
|通報内容|commentReport_contents|varchar(200)||〇|〇||
|レコード作成日時|commentReport_created|datetime||〇||タイムスタンプ|
|レコード更新日時|commentReport_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|commentReport_deleted|datetime||||タイムスタンプ|

##注文コメント通報テーブル
###commentReport(名称が浮かばない)
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|注文通報番号|commentReport_id|int|〇|〇|〇||
|取引コメント番号|commentReport_comment_item_id|int||〇|〇||
|商品番号|commentReport_item_id|int||〇|〇||
|ユーザー番号|commentReport_user_id|int||〇|〇||
|通報理由|commentReport_reason|varchar(50)||〇|〇||
|通報内容|commentReport_contents|varchar(200)||〇|〇||
|レコード作成日時|commentReport_created|datetime||〇||タイムスタンプ|
|レコード更新日時|commentReport_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|commentReport_deleted|datetime||||タイムスタンプ|


##商品通報テーブル
###itemReport(名称が浮かばない)
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|itemReport_id|int|〇|〇|〇||
|商品番号|itemReport_item_id|int||〇|〇||
|通報理由|commentReport_reason|varchar(50)||〇|〇||
|通報内容|commentReport_contents|varchar(200)||〇|〇||
|レコード作成日時|commentReport_created|datetime||〇||タイムスタンプ|
|レコード更新日時|commentReport_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|commentReport_deleted|datetime||||タイムスタンプ|
