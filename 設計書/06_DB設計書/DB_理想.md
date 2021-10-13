## カテゴリテーブル
### category
|和名|属性名|型|PK|NN|FK|備考|
|:---|:---|:---|:---:|:---:|:---:|:---|
|カテゴリ番号|category_id|int|〇|〇|||
|カテゴリ名|category_name|varchar(50)|〇||||
|レコード作成日時|category_created|datetime||〇||タイムスタンプ|
|レコード更新日時|category_updated|datetime||〇||タイムスタンプ|
|レコード削除日時|category_deleted|datetime||||now関数|

## 商品テーブル(理想)
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
|色コード|item_color|char(6)|||||
|サイズタイプ|item_sizeType|varchar(20)||||
|サイズ|item_size|varchar(20)||||||
|レコード作成日時|item_created|datetime||〇||タイムスタンプ|
|レコード更新日時|item_updated|datetime||〇||タイムスタンプ|
|取引開始日時|item_start|darerime||||now関数|
