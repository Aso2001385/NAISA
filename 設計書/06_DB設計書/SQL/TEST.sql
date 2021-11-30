INSERT INTO `user`(`name`, `mail`, `pass`, `tel`, `post`, `address`) 
VALUES ('テスト君','mail-2001@s.asojuku.ac.jp','732ec97fdce14b1895cecf0c8010eefa6e902564992ed34cf17b6a80520dd79f',
'09012349876','3216789','架空県空想市妄想町12-3-45');

INSERT INTO `category`(`name`) VALUES ('衣料品'),('家電'),('ゲーム');

INSERT INTO `item`(`user_id`, `category_id`, `name`, `name_read`, `image`, `price`, `quality`, `delivery_method`, `delivery_fee`, `delivery_days`, `delivery_prefecture`, `description`) 
VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]','[value-18]')