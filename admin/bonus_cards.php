<?php
/**
 *
 * ecshop 购物卡插件
 * Created by PhpStorm.
 * User: youngershen
 * Date: 14-11-5
 * Time: 上午10:07
 */


define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');

$act = "list";

if(defined($_REQUEST['act'])){
    $act = $$_REQUEST['act'];
}

// card_type  operations
function get_all_card_type(){
    $sql = "select  id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type";
    $res =$GLOBALS['db']->getAll($sql);
    return $res;
}

function add_card_type(){

}
// card_type operation end

//card operation
function get_all_card(){
    $sql = "select id, keycode, type, is_recharged, user, created_time, modified_time, recharged_time, is_avaliable, time_start, time_start from user_bonus_card";
    $res = $GLOBALS['db']->getAll($sql);
    return $res;
}
// card operation end
if("list" == $act){

    get_all_card_type();
    echo "test";
}
?>