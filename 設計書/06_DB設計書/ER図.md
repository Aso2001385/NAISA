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
  }

  entity "顧客マスタ" as customers <<M,Color_M>> {
    + customer_code [PK]
    --
    pass
    name
    address
    tel
    mail
    del_flag 
    reg_date
  }

  entity "カテゴリマスタ" as category <<M,Color_M>> {
    + category_id [PK]
    --
    name 
    reg_date 
  }

  entity "商品マスタ" as items <<M,Color_M>> {
    + item_code [PK]
    --
    item_name
    price
    category_id [FK]
    image
    detail
    del_flag
    reg_date
  }
  
}

  customers |o-r-o{ purchase
  purchase ||-r-|{ purchase_detail
  purchase_detail }-d-|| items
  items }o-l-|| category
  
