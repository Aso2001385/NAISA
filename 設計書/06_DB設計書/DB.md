# DB定義書
## ER図
[ER図](https://github.com/Aso2001385/NAISA/blob/main/%E8%A8%AD%E8%A8%88%E6%9B%B8/06_DB%E8%A8%AD%E8%A8%88%E6%9B%B8/ER%E5%9B%B3.md)

## ユーザーテーブル
### user
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|ユーザー番号|user_id|int(20)|〇|〇|||
|ユーザー名|user_name|varchar(50)||〇|||
|メールアドレス|user_mail|varchar(50)||〇||unique|
|パスワード|user_psw|vatchara(20)||〇||||
|電話番号|user_tel|varchar(50)||〇|||
|郵便番号|user_post|varchar(50)|||||
|住所|user_address|varchar(80)|||||
|出品数|user_sale|int||〇|||
|~~グッド数~~|user_good|int||〇||デフォルト0|
|~~バッド数~~|user_bad|int||〇||デフォルト0|
|ペナルティ|user_penalty|int||〇||デフォルト0|
|レコード作成日時|user_created|datetime||〇||タイムスタンプ|
|レコード更新日時|user_updated|datetime||〇||タイムスタンプ|
|レコード削除日時|user_deleted|datetime||||now関数|

## クレジットカードテーブル
### card
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|ユーザー番号|card_user_id|int|〇|〇|||
|カード項番|card_id|int||〇||識別ID|
|カード番号|card_code|varchar(19)||〇|||
|月有効期限|card_month|int||〇|||
|年有効期限|card_year|int||〇|||
|セキュリティコード|card_security|varchar(19)||〇|||
|レコード作成日時|card_created|datetime||〇||タイムスタンプ|
|レコード削除日時|card_deleted|datetime||||now関数|


## 商品テーブル
### item
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品番号|item_id|int|〇|〇|||
|ユーザー番号|item_user_id|int||〇|〇||
|カテゴリID|item_category_id|int|||〇||
|商品価格|item_price|int||〇||下限三百,上限十万|
|商品名|item_name|varchar(50)||〇|〇||
|商品名読み|item_nameRead|varchar(120)||||カタカナ|
|配送方法|item_deliveryMethod|varchar(30)||〇||選択式|
|配送料負担|item_deliveryFee|varchar(30)||〇||選択式|
|発送日数|item_deliveryDays|int||〇||日数|
|配送元地域|item_deliveryPrefecture|varchar(10)||〇||選択式|
|商品説明|item_description|text|||〇|||
|レコード作成日時|item_created|datetime||〇||タイムスタンプ|
|レコード更新日時|item_updated|datetime||〇||タイムスタンプ|
|取引開始日時|item_start|darerime||||now関数|

## 取引テーブル
### order
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|注文番号|order_id|int|〇|〇|||
|商品番号|order_item_id|int||〇|〇||
|注文者番号|order_user_id|int||〇|〇||
|届先郵便番号|order_post|varchar(50)||〇|||
|届先住所|order_addless|varchar(80)||〇|||
|発送通知日時|order_send|datetime||||now関数|
|受取通知日時|order_recived|datetime||||now関数|
|レコード作成日時|order_created|datetime||〇||タイムスタンプ|
|レコード更新日時|order_updated|datetime||〇||タイムスタンプ|
|取引完了日時|order_completion|datetime||||now関数|
|取引中止日時|order_stop|datetime||||now関数|


## 商品コメントテーブル
### itemComment
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品コメント番号|itemComment_id|int|〇|〇|||
|商品番号|itemComment_item_id|int||〇|〇||
|ユーザー番号|itemComment_user_id|int||〇|〇||
|ユーザー名|itemComment_user_name|varchar(50)||〇|〇||
|コメント内容|itemComment_contents|varchar(255)||〇|〇||
|パッシブフラグ|itemComment_passive|int|||||
|レコード作成日時|itemComment_created|datetime||〇||タイムスタンプ|
|レコード更新日時|itemComment_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|itemComment_deleted|datetime||||タイムスタンプ|


## 取引コメントテーブル
### orderComment
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|取引コメント番号|orderComment_item_id|int|〇|〇|||
|商品番号|orderComment_item_id|int||〇|〇||
|ユーザー番号|orderComment_user_id|int||〇|〇||
|ユーザー名|orderComment_user_name|varchar(50)||〇|〇||
|コメント内容|orderComment_contents|varchar(200)||〇|〇||
|レコード作成日時|orderComment_created|datetime||〇||タイムスタンプ|
|レコード更新日時|orderComment_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|orderComment_deleted|datetime||||タイムスタンプ|


## 商品コメント通報テーブル
### itemCommentReport
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|itemCommentReport_id|int|〇|〇|||
|商品コメント番号|itemCommentReport_comment_item_id|int||〇|〇||
|商品番号|itemCommentReport_item_id|int||〇|〇||
|ユーザー番号|itemCommentReport_user_id|int||〇|〇||
|通報理由|itemCommentReport_reason|varchar(50)||〇|〇||
|通報内容|itemCommentReport_contents|varchar(200)||〇|〇||
|レコード作成日時|itemCommentReport_created|datetime||〇||タイムスタンプ|
|レコード更新日時|itemCommentReport_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|itemCommentReport_deleted|datetime||||now関数|

## 注文コメント通報テーブル
### orderCommentReport
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|注文通報番号|orderCommentReport_id|int|〇|〇|||
|取引コメント番号|orderCommentReport_comment_item_id|int||〇|〇||
|商品番号|orderCommentReport_item_id|int||〇|〇||
|ユーザー番号|orderCommentReport_user_id|int||〇|〇|注文者の番号|
|通報理由|orderCommentReport_reason|varchar(50)||〇|〇||
|通報内容|orderCommentReport_contents|varchar(200)||〇|〇||
|レコード作成日時|orderCommentReport_created|datetime||〇||タイムスタンプ|
|レコード更新日時|orderCommentReport_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|orderCommentReport_deleted|datetime||||now関数|

## 商品通報テーブル
### itemReport
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|itemReport_id|int|〇|〇|||
|商品番号|itemReport_item_id|int||〇|〇||
|ユーザー番号|itemReport_user_id|int||〇|〇|注文者の番号|
|通報理由|itemReport_reason|varchar(50)||〇|〇||
|通報内容|itemReport_contents|varchar(255)||〇|〇||
|レコード作成日時|itemReport_created|datetime||〇||タイムスタンプ|
|レコード更新日時|itemReport_updated|datetime||〇||タイムスタンプ|
|コメント削除日時|itemReport_deleted|datetime||||now関数|

## お知らせテーブル
### info
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|お知らせ番号|info_id|int|〇|〇|||
|対象ユーザー番号|info_user_id|int||||nullは全体公開|
|お知らせ件名|info_name|varchar(50)||〇|||
|お知らせ内容|info_contents|varchar(200)||〇|||
|レコード作成日時|info_created|datetime||〇||タイムスタンプ|
|レコード更新日時|info_updated|datetime||〇||タイムスタンプ|

## ペナルティテーブル
### penalty
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|ペナルティ番号|penalty_id|int|〇|〇|||
|ユーザー番号|penalty_user_id|int||〇|〇||
|加算点数|penalty_addPoints|int||〇|||
|加算時合計点数|penalty_allPoints|int||〇|||
|ペナルティ件名|penalty_name|varchar(50)||〇|||
|ペナルティ理由|penalty_contents|varchar(200)||〇|||
|レコード作成日時|penalty_created|datetime||〇||タイムスタンプ|
|レコード更新日時|penalty_updated|datetime||〇||タイムスタンプ|
