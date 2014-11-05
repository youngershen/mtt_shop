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
define('PAGE_SIZE', 2);

require(dirname(__FILE__) . '/includes/init.php');

$act = "list";
$page_type = "bonus_card";
$current_page = 1;
//utils
function get_now_time(){
    return date('Y-m-d H:i:s',time()+8*3600);
}

function make_keycode(){
    $keycode = md5(time() . mt_rand(0,1000));
    return $keycode;
}
function pager($current, $pagesize, $recordcount){
    $pagecount = $recordcount % $pagesize == 0 ? (int)($recordcount / $pagesize) : (int)($recordcount / $pagesize) + 1;

    if($current == 1){
        return array('start'=>0, 'limit'=> $pagesize , 'prev' => 1, 'next' => 2, 'page_count' => $pagecount);
    }
    if($current == $pagecount){
        return array('start'=>$recordcount - $pagesize, 'limit'=>$pagesize , 'prev' => $current - 1, 'next' =>$current, 'page_count' => $pagecount);
    }

    if($current  > $pagecount || $current < 1){
        return array('start'=>0, 'limit'=> $pagesize , 'prev'=>1, 'next' => 2, 'page_count' => $pagecount);

    }
    return array('start'=>( $current- 1) * $pagesize, limit=>$pagesize, 'prev' => $current - 1,  'next'=>$current + 1, 'page_count' => $pagecount);
}

//utils end

if($_REQUEST['act']){
    $act = $_REQUEST['act'];
}

if($_REQUEST['page_type']){
    $page_type = $_REQUEST['page_type'];
}
if($_REQUEST['page']){
    $current_page = $_REQUEST['page'];
}


// card_type  operations
function find_all_card_type(){
    $sql = "select  id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type";
    $res =$GLOBALS['db']->getAll($sql);
    return $res;
}
function find_card_type_by_id($id){
    $sql = "select  id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type where id=" . $id . ";";
    $res = $GLOBALS['db']->getRow($sql);
    return $res;
}
function add_card_type($bonus, $des){

    //MySQL> INSERT INTO tbl_name (col1,col2) VALUES(col2*2,15);
    $modified_time = get_now_time();
    $sql = "insert into user_bonus_card_type(bonus, description, modified_time) values(" . $bonus . ",'" .  $des .  "','" .  $modified_time .  "');";
    $res = $GLOBALS['db']->query($sql);
    return $res;
}
function find_card_type_by_keywards($keywards){

    $sql = "select id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type where description like '%" . $keywards . "%';";
    $res = $GLOBALS['db']->getAll($sql);
    return $res;

}

// card_type operation end

//card operation
function delete_bonus_card_by_id($id){
    $sql = "select id from user_bonus_card where id = " . $id . ";";
    $res = $GLOBALS['db']->getRow($sql);
    if($res != False){
        $sql = "delete from user_bonus_card where id = " . $id . ";";
        $res = $GLOBALS['db']->query($sql);
        if($res){
            return True;
        }else{
            return False;
        }
    }else{

    }
}

function update_bonus_card_by_id($id, $type, $time_start, $time_end){


}

function get_all_card_count(){
    $sql = "select count(*) from user_bonus_card";
    $res = $GLOBALS['db']->getOne($sql);
    return $res;
}
function get_all_card($start, $limit){
    if($limit != 0){
        $sql = "select * from user_bonus_card left join user_bonus_card_type on user_bonus_card.type = user_bonus_card_type.id " . " limit " . $start . "," . $limit . ";";
        $res = $GLOBALS['db']->getAll($sql);
        return $res;
    }else{

        $sql = "select * from user_bonus_card left join user_bonus_card_type on user_bonus_card.type = user_bonus_card_type.id";
        $res = $GLOBALS['db']->getAll($sql);
        return $res;
    }

}
function add_card($type, $time_start, $time_end, $count){

    $card_type = find_card_type_by_id($type);
    if($card_type == False){
        return False;
    }else {
        for($i = 0 ; $i < $count; $i++) {
            $keycode = make_keycode();
            $nowtime = get_now_time();
            $sql = "insert into user_bonus_card(keycode, type, modified_time, time_start, time_end) values('" . $keycode . "'," . $type . ",'" . $nowtime . "','" . $time_start . "','" . $time_end . "');";
            $res = $GLOBALS['db']->query($sql);
        }
        return $res;
    }
}
// card operation end
if("list" == $act){

    $smarty->assign("page_type", $page_type);
    if($page_type == 'bonus_card'){
        $record_count = get_all_card_count();
        $pager = pager($current_page, PAGE_SIZE, $record_count);
        $res = get_all_card((int)$pager['start'], (int)$pager['limit']);
        $smarty->assign("current_page", $current_page);
        $smarty->assign("prev", $pager['prev']);
        $smarty->assign("next", $pager['next']);
        $smarty->assign("record_count", $record_count);
        $smarty->assign("page_count", $pager['page_count']);
        $smarty->assign("filter", array('page'=>$current_page, 'page_size'=>PAGE_SIZE));
        $smarty->assign("cards", $res);
    }
    $smarty->display("bonus_card_list.htm");
}
?>