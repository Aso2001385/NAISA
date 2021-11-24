# DB定義書
## ER図
[ER図](https://github.com/Aso2001385/NAISA/blob/main/%E8%A8%AD%E8%A8%88%E6%9B%B8/06_DB%E8%A8%AD%E8%A8%88%E6%9B%B8/ER%E5%9B%B3.md)

各表の下にある小さい表は、機能を追加する余裕があるときに組み込みたい情報群


## ユーザーテーブル
### user
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|ユーザー番号|id|int(20)|〇|〇|||
|ユーザー名|name|varchar(50)||〇|||
|メールアドレス|mail|varchar(50)||〇||unique|
|パスワード|pass|char(60)||〇||||
|電話番号|tel|varchar(50)||〇|||
|郵便番号|post|varchar(50)|||||
|住所|address|varchar(80)|||||
|出品数|saleCount|int||〇|||
|ペナルティ|penalty|int||〇||デフォルト0|
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|レコード削除日時|deleted|datetime||||now関数|

|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|~~グッド数~~|user_good|int||〇||デフォルト0|
|~~バッド数~~|user_bad|int||〇||デフォルト0|

## クレジットカードテーブル
### card
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|カード項番|id|int|〇|〇||識別ID|
|ユーザー番号|user_id|int||〇|||
|カード番号|code|varchar(19)||〇|||
|月有効期限|month|int||〇|||
|年有効期限|year|int||〇|||
|セキュリティコード|security|varchar(19)||〇|||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード削除日時|deleted|datetime||||now関数|


## 商品テーブル
### item
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品番号|id|int|〇|〇|||
|ユーザー番号|user_id|int||〇|〇||
|カテゴリID|category_id|int|||〇||
|商品名|name|varchar(50)||〇|〇||
|商品名読み|name_read|varchar(120)||||カタカナ|
|商品画像|image|varchar(100)||〇|〇||
|商品価格|price|int||〇||下限三百,上限十万|
|商品状態|quality|varchar(120)|||||
|配送方法|delivery_method|varchar(30)||〇||選択式|
|配送料負担|delivery_fee|varchar(30)||〇||選択式|
|発送日数|delivery_days|int||〇||日数|
|配送元地域|delivery_prefecture|varchar(10)||〇||選択式、県名|
|商品説明|description|text||||||
|商品コメント数|commentCount|int||〇||デフォルト0|
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|取引開始日時|start|darerime||||now関数|

|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|サイズタイプ|size_type|varchar(10)|||||
|サイズ|size|varchar(10)|||||
|カラー|color|int|||||
|メーカー名|maker|varchar(50)|||||

## 取引テーブル
### order
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|取引番号|id|int|〇|〇|||
|商品番号|item_id|int||〇|〇||
|注文者番号|user_id|int||〇|〇||
|カード番号|card_id|int||〇|〇||
|届先郵便番号|post|varchar(50)||〇|||
|届先住所|addless|varchar(80)||〇|||
|発送通知日時|send|datetime||||now関数|
|受取通知日時|recived|datetime||||now関数|
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|取引完了日時|completion|datetime||||now関数|
|取引中止日時|stop|datetime||||now関数|

## 商品コメントテーブル
### item_comment
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品コメント番号|id|int|〇|〇|||
|商品番号|item_id|int||〇|〇||
|ユーザー番号|user_id|int||〇|〇||
|コメント内容|contents|varchar(255)||〇|〇||
|パッシブフラグ|passive|int|||||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|コメント削除日時|deleted|datetime||||タイムスタンプ|


## 取引コメントテーブル
### item_comment
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|取引コメント番号|id|int|〇|〇|||
|取引番号|item_id|int||〇|〇||
|ユーザー番号|user_id|int||〇|〇||
|コメント内容|contents|varchar(200)||〇|〇||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|コメント削除日時|deleted|datetime||||タイムスタンプ|


## 商品コメント通報テーブル
### item_comment_Report
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|id|int|〇|〇|||
|商品コメント番号|item_comment_id|int||〇|〇||
|通報者番号|user_id|int||〇|〇||
|通報理由|reason|varchar(50)||〇|〇||
|通報内容|contents|varchar(200)||〇|〇||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|コメント削除日時|deleted|datetime||||now関数|

## 取引コメント通報テーブル
### order_comment_report
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|id|int|〇|〇|||
|取引コメント番号|order_comment_id|int||〇|〇||
|通報者番号|user_id|int||〇|〇||
|通報理由|reason|varchar(50)||〇|〇||
|通報内容|contents|varchar(200)||〇|〇||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|コメント削除日時|deleted|datetime||||now関数|

## 商品通報テーブル
### item_report
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|商品通報番号|id|int|〇|〇|||
|商品番号|item_id|int||〇|〇||
|通報者番号|user_id|int||〇|〇||
|通報理由|reason|varchar(50)||〇|〇||
|通報内容|contents|varchar(200)||〇|〇||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
|コメント削除日時|deleted|datetime||||now関数|

## お知らせテーブル
### info
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|お知らせ番号|id|int|〇|〇|||
|対象ユーザー番号|user_id|int||||nullは全体公開|
|お知らせ件名|name|varchar(50)||〇|||
|お知らせ内容|contents|varchar(200)||〇|||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|


## ログイン済お問い合わせテーブル
### login_inquiry
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|問い合わせ番号|id|int|〇|〇|||
|ユーザー番号|user_id|int||||nullは全体公開|
|問い合わせ件名|name|varchar(50)||〇|||
|問い合わせ内容|contents|varchar(200)||〇|||
|添付画像|image|varchar(200)||〇|||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|

## 未ログインお問い合わせテーブル
### inquiry
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|問い合わせ番号|id|int|〇|〇|||
|メールアドレス|mail|int||||nullは全体公開|
|問い合わせ件名|name|varchar(50)||〇|||
|問い合わせ内容|contents|varchar(200)||〇|||
|添付画像|image|varchar(200)||〇|||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|

## ペナルティテーブル
### penalty
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|ペナルティ番号|id|int|〇|〇|||
|ユーザー番号|user_id|int||〇|〇||
|加算点数|add_points|int||〇|||
|加算時合計点数|all_points|int||〇|||
|ペナルティ件名|name|varchar(50)||〇|||
|ペナルティ理由|contents|varchar(200)||〇|||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|

## オペレーターテーブル
### operator
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|オペレーターid|id|int|〇|〇|||
|ログインid|login_id|char(7)||〇|〇||
|パスワード|pass|char(60)||〇|||
|レコード作成日時|created|datetime||〇||タイムスタンプ|
|レコード更新日時|updated|datetime||〇||タイムスタンプ|
