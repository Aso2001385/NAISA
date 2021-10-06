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

  entity "購入テーブル" as purchase <<T,Color_T>> {
    + order_id [PK]
    --
    order_id
    customer_code
    purchase_date 
    total_price 
  }

  entity "購入詳細テーブル" as purchase_detail <<T,Color_T>> {
    + order_id [PK][FK]
    + detail_id [PK]
    --
    item_code
    price
    num
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
  
