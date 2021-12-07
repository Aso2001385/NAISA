INSERT INTO `user`(`name`, `nick_name`, `mail`, `pass`, `tel`, `post`, `address`) 
VALUES ('テスト君','テストマン','mail-2001@s.asojuku.ac.jp','732ec97fdce14b1895cecf0c8010eefa6e902564992ed34cf17b6a80520dd79f',
'09012349876','3216789','架空県空想市妄想町12-3-45');

INSERT INTO `category`(`name`) VALUES ('衣料品'),('家電'),('ゲーム');

INSERT INTO `item`(`user_id`, `category_id`, `name`, `name_read`, `image`, `price`, `quality`, `delivery_method`, `delivery_fee`, `delivery_days`, `delivery_prefecture`, `description`) 
VALUES ('1','1','ボロくなったマフラー','ﾎﾞﾛｸﾅｯﾀﾏﾌﾗｰ','excellent','5000','美品','郵便','出品者負担','3','福岡県','ボロボロになったマフラーです。見た目は悪いですが使用には問題ありません。');

INSERT INTO `item`(`user_id`, `category_id`, `name`, `name_read`, `image`, `price`, `quality`, `delivery_method`, `delivery_fee`, `delivery_days`, `delivery_prefecture`, `description`) 
VALUES ('1','2','壊れかけた電子レンジ','ｺﾜﾚｶｹﾀﾃﾞﾝｼﾚﾝｼﾞ','excellent','50000','美品','郵便','出品者負担','3','福岡県','壊れかけた電子レンジです。時々スパークしますが、恐らく問題ありません。');

INSERT INTO `item`(`user_id`, `category_id`, `name`, `name_read`, `image`, `price`, `quality`, `delivery_method`, `delivery_fee`, `delivery_days`, `delivery_prefecture`, `description`) 
VALUES ('1','3','バグだらけのカセット','ﾊﾞｸﾞﾀﾞﾗｹﾉｶｾｯﾄ','excellent','500','美品','郵便','出品者負担','3','福岡県','バグだらけのカセットです。電脳世界に閉じ込められることもありますが、問題ありません。');

