```uml
@startuml
!define Color_T Lime
!define Color_R Red
!define Color_C DeepSkyBlue

skinparam class {
  BackgroundColor DarkGrey-Snow
  BorderColor Black
  ArrowColor Black
  IconFontColor Snow
}

package "ECサイト" as target_system{

  entity "ユーザーテーブル" as user <<T,Color_T>> {
    + user_id [PK]
    --
    user_name
    user_mail
    user_psw
    user_tel
    user_post
    user_address
    user_sale
    user_penalty
    user_created	
    user_updated	
    user_deleted
  }
  
    entity "クレジットカードテーブル" as card <<T,Color_T>> {
    + card_user_id [PK]
    --
    card_id
    card_code
    card_month
    card_year
    card_security
    card_created
    card_deleted
  }


  entity "商品テーブル" as item <<T,Color_T>> {
    + item_id [PK]
    --
    item_user_id
    item_category_id
    item_price
    item_name
    item_nameRead
    item_deliveryMethod
    item_deliveryFee
    item_deliveryDays
    item_deliveryPrefecture
    item_description
    item_created
    item_updated
    item_start
  }

  entity "カテゴリテーブル" as category <<T,Color_T>> {
    + category_id [PK]
    --
    category_name
    category_created
    category_updated
    category_deleted

 
  }

  entity "取引テーブル" as order <<T,Color_T>> {
    + order_item_id [PK]
    --
    order_user_id
    order_item_image
    order_post
    order_addless
    order_send
    order_recived
    order_created
    order_updated
    order_completion
   	order_stop
  }
  
  entity "商品コメントテーブル" as itemComment <<C,Color_C>> {
    + itemComment_id [PK]
    --
    itemComment_item_id	
    itemComment_user_id
    itemComment_user_name
    itemComment_contents
    itemComment_private
    itemComment_created
    itemComment_updated
    itemComment_deleted
  }
  
  entity "取引コメントテーブル" as orderComment <<C,Color_C>> {
    + orderComment_id [PK]
    --
    orderComment_item_id
    orderComment_user_id	
    orderComment_user_name
    orderComment_contents
    orderComment_created
    orderComment_updated
    orderComment_deleted	
  }
  
  entity "商品コメント通報テーブル" as itemCommentReport <<R,Color_R>> {
    + itemCommentReport_id [PK]
    --
    itemCommentReport_itemComment_id
    itemCommentReport_item_id
    itemCommentReport_user_id
    itemCommentReport_reason
    itemCommentReport_contents
    itemCommentReport_created
    itemCommentReport_updated
    itemCommentReport_deleted
  }
  
  entity "取引コメント通報テーブル" as orderCommentReport <<R,Color_R>> {
    + orderCommentReport_id [PK]
    --
    orderCommentReport_orderComment_id
    orderCommentReport_user_id
    orderCommentReport_reason
    orderCommentReport_contents
    orderCommentReport_created
    orderCommentReport_updated
    orderCommentReport_deleted
  }
  
   entity "商品通報テーブル" as itemReport <<R,Color_R>> {
    + itemReport_id [PK]
    --
    itemReport_item_id
    itemReport_reason
    itemReport_contents
    itemReport_created	
    itemReport_updated
    itemReport_deleted
  }
  
   entity "お知らせテーブル" as info <<T,Color_T>> {
    + info_id [PK]
    --
    info_user_id
    info_name
    info_contents		
    info_created
    info_updated
  }
  
    entity "ペナルティテーブル" as penalty <<R,Color_R>> {
    + penalty_id [PK]
    --
    penalty_user_id
    penalty_addPoints
    penalty_totalPoints
    penalty_name
    penalty_contents
    penalty_created
    penalty_updated
  }
  
}

  penalty }o-d-|| user
  penalty }-r[hidden]-{ info
  user ||-u-o{ info
  user ||-r-o{ card
  user ||-d-o{ item
  user ||-r-o{ itemComment
  card ||-d-o{ order
  item ||-l-o{ itemComment
  item ||-r-o| order
  item ||-d-o{ itemReport
  itemComment ||-d-o{ itemCommentReport
  order ||-r-o{ orderComment
  orderComment ||-d-o{ orderCommentReport
  
  
