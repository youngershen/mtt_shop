####ecshop预付费卡插件

__需求分析__

	上架可以派发预付费卡片，用户可以通过该卡片进行充值,

__数据库设计__

__user_bonus_card__

	id => int pk
	keycode => varchar 255 unique index
	type => foreign_key => bonus_card_type
	is_recharged => bool
	user => foreign_key => user
	created_time => date_time
	recharge_time => date_time
	modified_time => date_time
	is_avaliable => bool
	time_start => date_time
	tme_to => date_time


__user_bonus_card_type__
	
	id => int pk
	bonus => float 
	describe => text
	is_avaliable => bool
	created_time => date_time
	modified_time => date_time
