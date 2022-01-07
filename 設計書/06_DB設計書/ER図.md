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
  
   entity "お知らせテーブル" as info <<T,Color_T>> {
    + info_id [PK]
    --
    info_user_id
    info_name
    info_contents		
    info_created
    info_updated
  }
  
}

  user ||-l-o{ info
  user ||-r-o{ card
  user ||-d-o{ item
  card ||-d-o{ order
  item ||-r-o| order
  order ||-r-o{ orderComment
  
