```uml
@startuml
!define Color_T Lime
!define Color_I Yellow
!define Color_M DeepSkyBlue

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
    user_tel
    user_post
    user_address
    user_sale
    user_good
    user_bad
    user_created	
    user_updated	
    user_deleted
  }

  entity "商品テーブル" as item <<T,Color_T>> {
    + item_id [PK]
    --
    item_user_id
    item_category_id
    item_price
    item_name
    item_maker
    item_makerRead
    item_color
    item_sizeType
    item_size
    item_created
    item_updated
    item_start
  }

  entity "カテゴリマスタ" as category <<M,Color_M>> {
    + category_id [PK]
    --
    category_name
    category_created
    category_updated
    category_deleted
 
  }

  entity "取引テーブル" as order <<M,Color_M>> {
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
  
  entity "商品コメントテーブル" as itemComment <<M,Color_M>> {
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
  
  entity "取引コメントテーブル" as orderComment <<M,Color_M>> {
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
  
  entity "商品コメント通報テーブル" as itemCommentReport <<M,Color_M>> {
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
  
  entity "取引コメント通報テーブル" as orderCommentReport <<M,Color_M>> {
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
  
   entity "商品通報テーブル" as itemReport <<M,Color_M>> {
    + itemReport_id [PK]
    --
    itemReport_item_id
    itemReport_reason
    itemReport_contents
    itemReport_created	
    itemReport_updated
    itemReport_deleted
  }
  
   entity "お知らせテーブル" as info <<M,Color_M>> {
    + info_id [PK]
    --
    info_user_id
    info_name
    info_contents		
    info_created
    info_updated
  }
  
    entity "ペナルティテーブル" as penalty <<M,Color_M>> {
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

  user ||-r-o{ item
  user |o-d-o{  penalty
  item ||-d-o{ itemComment
  itemComment }o--o{ itemCommentReport
  item ||-r-|| order
  item ||-u-|| category
  item ||-r-o{ itemReport
  order ||--o{ orderComment
  orderComment ||--o{ orderCommentReport
  info }|--|{ user
  
  
