/**
 * Created by youngershen-mac-book-pro on 14-11-5.
 */

var redirect_to_main = function(){
    window.location.href = "bonus_cards.php?act=list";
}

var add_card = function(){
    window.location.href = "bonus_cards.php?act=add";
}
var card_admin = function(){
    window.location.href = "bonus_cards.php?act=list";
}
var type_admin = function(){
    window.location.href = "bonus_cards.php?act=list&page_type=bonus_card_type"
}
var add_card_type = function(){

    window.location.href = "bonus_cards.php?act=add&page_type=bonus_card_type";
}