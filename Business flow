```uml 
@startuml 
 center header <size:20><b>メイン処理</b></size>

 opt ログイン
  alt 未登録
  hnote across: ユーザー登録処理
  end
  hnote across: ログイン処理
 end

 loop 購入処理成功まで
  loop 商品を見つけるまで
   hnote across: 商品サーチ処理
  end

　opt 商品クリック(詳細表示)
ユーザー -> Webサーバー : 商品クリック
Webサーバー -> DBサーバー : 商品照会
DBサーバー -> Webサーバー : 照会結果
Webサーバー -> ユーザー : 詳細情報表示
opt 戻る機能
ユーザー -> Webサーバー : 戻る処理
end

  opt カート追加
   ユーザー -> Webサーバー:商品投入(更新申請)
   Webサーバー -> Webサーバー:カート内情報更新処理
   Webサーバー ->ユーザー:カート内情報更新
  end
  opt カート削除
   ユーザー -> Webサーバー:カート内商品削除(更新申請)
   Webサーバー -> Webサーバー:カート内情報更新処理
   Webサーバー ->ユーザー:カート内情報更新
  end

  opt 購入
   opt 未ログイン
     hnote across: ログイン処理
   end
   hnote across: 購入処理
  end

 end
 
 loop 出品終了まで
  hnote across: 出品処理
 end

 opt ログアウト
  hnote across: ログアウト処理
 end
@enduml
```

 ```uml
@startuml
 center header <size:20><b>登録</b></size>
opt 未登録
 ユーザー -> Webサーバー : ユーザー登録(情報を入力)
 Webサーバー -> DBサーバー : ユーザー登録
 DBサーバー -> DBサーバー : 登録処理
 DBサーバー -> Webサーバー : 登録結果

 alt 登録成功
 Webサーバー -> ユーザー : 登録成功
 else 登録失敗
 Webサーバー -> ユーザー : 登録失敗
end
@enduml
```

```uml
@startuml
 center header <size:20><b>ログイン処理</b></size>
 loop ログイン成功まで
  opt 未登録
   ユーザー -> Webサーバー:ユーザー登録
   Webサーバー -> DBサーバー:ユーザー登録
   DBサーバー -> DBサーバー:登録処理
   DBサーバー -> Webサーバー:処理結果

 

   alt 登録成功
     Webサーバー ->ユーザー:登録メッセージの表示
   else 登録失敗
     Webサーバー ->ユーザー:失敗メッセージの表示
   end
  end

 

  ユーザー -> Webサーバー:ログイン
  Webサーバー -> DBサーバー:ログイン
  DBサーバー -> DBサーバー:ログイン処理および認証
  DBサーバー -> Webサーバー:認証結果
  
  alt 認証成功
   Webサーバー ->ユーザー:成功表示
  else 認証失敗
   Webサーバー ->ユーザー:失敗表示
  end
 end
  
@enduml
```
```uml
@startuml
 center header <size:20><b>ログアウト処理</b></size>
 loop ログアウト成功まで
  ユーザー -> Webサーバー:ログアウト
  Webサーバー -> DBサーバー:ログアウト申請
  DBサーバー -> DBサーバー:ログアウト処理
  alt 処理成功
   DBサーバー -> Webサーバー:ログアウト処理結果
  else 処理失敗
   Webサーバー ->ユーザー:ログアウトメッセージ表示
  end
 end
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
 
  opt 画像アップロード
    ユーザー -> Webサーバー:画像アップロード
    Webサーバー -> DBサーバー:画像登録
    DBサーバー -> DBサーバー:登録処理
    DBサーバー -> Webサーバー:処理結果

    alt 登録成功
      Webサーバー ->ユーザー:登録メッセージの表示
    else 登録失敗
      Webサーバー ->ユーザー:失敗メッセージの表示
    end
   end

   opt 説明入力
    ユーザー -> Webサーバー:テキストアップロード
    Webサーバー -> DBサーバー:テキスト登録
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
