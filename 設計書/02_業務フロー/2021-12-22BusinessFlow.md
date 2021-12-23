# メイン処理

* ログインフロー
* 出品フロー
* 購入フロー
* ログアウトフロー

```uml 
@startuml 
 center header <size:20><b>メイン処理</b></size>
 participant ユーザー as user
 participant Webサーバー as web
 participant DBサーバー as db

 opt ログイン
  hnote across: ログインフロー
 end
 
 opt 出品目的
   hnote across: 出品フロー
 else 購入目的
   hnote across: 購入フロー
 end
 
 opt ログアウト
  hnote across: ログアウトフロー
 end
@enduml
```

## ログインフロー

```uml
@startuml
 center header <size:20><b>ログインフロー</b></size>
 
 participant ユーザー as user
 participant Webサーバー as web
 participant DBサーバー as db
 
 loop ログイン成功まで
  opt 未登録
   user -> web:ユーザー情報入力
   web -> db:ユーザー登録リクエスト
   db -> db:登録処理
   db -> web:処理結果
   
   alt 登録成功
     web ->user:登録完了メッセージの表示
   else 登録失敗
     web ->user:登録失敗メッセージの表示
   end
  end
  
  user -> web:ログイン情報入力
  web -> db:メール照合リクエスト
  db -> db:メール検索処理
  db -> web:検索結果
  web -> web:パスワード照合処理
  
  alt 認証成功
   web ->user:成功表示
  else 認証失敗
   web ->user:失敗表示
  end
 end
  
@enduml
```

## ログアウトフロー

```uml
@startuml
 center header <size:20><b>ログアウトフロー</b></size>
 
 participant ユーザー as user
 participant Webサーバー as web
 
 loop ログアウト成功まで
  user -> web:ログアウトリクエスト
  web -> web:ログアウト処理(セッション消去)
  web -> user:処理結果
 end
@enduml
```

```uml
@startuml
 center header <size:20><b>出品フロー</b></size>
  
 participant 出品者 as seller
 participant Webサーバー as web
 participant DBサーバー as db

 seller -> web:商品情報入力
 web -> web:画像保存
 web -> db:登録リクエスト
 db -> db:登録処理
 db -> web:処理結果
 alt 失敗
 web -> web:画像消去
 end
 web -> seller:結果表示
 
 opt 商品確認
 seller -> web:商品確認
 web -> db:最新レコード取得リクエスト
 db -> db:検索処理
 db -> web:処理結果
 web -> seller:結果表示
 
@enduml
```


```uml
@startuml
 center header <size:20><b>商品サーチ処理</b></size>
 alt 商品一覧

 ユーザー -> Webサーバー:商品一覧閲覧
 Webサーバー -> DBサーバー:全商品情報要求
 DBサーバー -> DBサーバー:商品情報抽出処理
 DBサーバー -> Webサーバー:抽出結果
 Webサーバー -> ユーザー:商品一覧表示

 else 商品検索
  ユーザー -> Webサーバー:商品検索
  alt 商品名
   Webサーバー -> DBサーバー:商品情報要求(商品名送信)
  else カテゴリ
   Webサーバー -> DBサーバー:商品情報要求(カテゴリ送信)
  end
  DBサーバー -> DBサーバー:対象商品情報抽出処理
  DBサーバー -> Webサーバー:抽出結果
  Webサーバー -> ユーザー:対象商品一覧表示
 end
@enduml
```

```uml
@startuml
 center header <size:20><b>購入処理</b></size>
 loop 購入処理終了まで
  ユーザー -> Webサーバー:商品購入申請
  Webサーバー -> DBサーバー:商品購入処理
  DBサーバー -> DBサーバー:商品購入処理
  DBサーバー -> Webサーバー:処理結果
  Webサーバー -> ユーザー:結果表示
 end
@enduml
```

```uml
@startuml
center header <size:20><b>出品処理</b></size>
 loop 出品終了まで
 
  opt 未ログイン
     hnote across: ログイン処理
   end
 
  opt 商品登録
    ユーザー -> Webサーバー:商品情報
    Webサーバー -> DBサーバー:商品情報登録
    DBサーバー -> DBサーバー:登録処理
    DBサーバー -> Webサーバー:処理結果

    alt 登録成功
      Webサーバー ->ユーザー:登録メッセージの表示
    else 登録失敗
      Webサーバー ->ユーザー:失敗メッセージの表示
    end
   end

   
   
   opt 商品情報変更
    ユーザー -> Webサーバー:変更登録
    Webサーバー -> DBサーバー:変更登録
    DBサーバー -> DBサーバー:変更処理
    DBサーバー -> Webサーバー:処理結果

    alt 登録成功
      Webサーバー ->ユーザー:成功メッセージの表示
    else 登録失敗
      Webサーバー ->ユーザー:失敗メッセージの表示
    end
   end
   
   opt 商品情報削除
    ユーザー -> Webサーバー:削除申請
    Webサーバー -> DBサーバー:削除申請
    DBサーバー -> DBサーバー:削除処理
    DBサーバー -> Webサーバー:処理結果

    alt 登録成功
      Webサーバー ->ユーザー:成功メッセージの表示
    else 登録失敗
      Webサーバー ->ユーザー:失敗メッセージの表示
    end
   end
  
  end
@enduml
```
