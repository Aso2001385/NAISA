```uml
@startuml
!define Color_T Lime
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
  
  entity "カテゴリマスタ" as category <<M,Color_M>> {
    + category_id [PK]
    --
    category_name
    category_created
    category_updated
    category_deleted
 
  }
  
  entity "カテゴリマスタ" as category <<M,Color_M>> {
    + category_id [PK]
    --
    category_name
    category_created
    category_updated
    category_deleted
 
  }
  
  entity "カテゴリマスタ" as category <<M,Color_M>> {
    + category_id [PK]
    --
    category_name
    category_created
    category_updated
    category_deleted
 
  }
  
  entity "カテゴリマスタ" as category <<M,Color_M>> {
    + category_id [PK]
    --
    category_name
    category_created
    category_updated
    category_deleted
 
  }
  
  
  
}

  customers |o-r-o{ purchase
  purchase ||-r-|{ purchase_detail
  purchase_detail }-d-|| items
  items }o-l-|| category
  
