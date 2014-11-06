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
define('PAGE_SIZE', 20);

require(dirname(__FILE__) . '/includes/init.php');

$act = "list";
$page_type = "bonus_card";
$current_page = 1;
//utils
function get_now_time(){
    return date('Y-m-d H:i:s',time()+8*3600);
}

function make_keycode(){
    $keycode = md5(microtime() . mt_rand(0,1000));
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
function find_all_card_type($start, $limit){

    if($limit > 0){
        $sql = "select  id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type limit " . $start . "," . $limit . ";";
        $res =$GLOBALS['db']->getAll($sql);
        return $res;

    }else{
        $sql = "select  id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type";
        $res =$GLOBALS['db']->getAll($sql);
        return $res;
    }
}
function get_all_card_type_count(){
    $sql = "select count(*) from user_bonus_card_type";
    $res = $GLOBALS['db']->getOne($sql);
    return $res;

}
function find_card_type_by_id($id){
    $sql = "select  id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type where id=" . $id . ";";
    $res = $GLOBALS['db']->getRow($sql);
    return $res;
}
function add_card_type($bonus, $des){

    //MySQL> INSERT INTO tbl_name (col1,col2) VALUES(col2*2,15);
    $created_time = get_now_time();
    $modified_time = get_now_time();
    $sql = "insert into user_bonus_card_type(bonus, description, modified_time, created_time) values(" . $bonus . ",'" .  $des .  "','" .  $modified_time .  "' ,'". $created_time ."' );";
    $res = $GLOBALS['db']->query($sql);
    return $res;
}
function find_card_type_by_keywards($keywards){

    $sql = "select id, bonus, description, is_avaliable, modified_time, created_time from user_bonus_card_type where description like '%" . $keywards . "%';";
    $res = $GLOBALS['db']->getAll($sql);
    return $res;

}
function delete_card_type_by_id($id){
    $sql = "select count(*) from user_bonus_card_type where id = " . $id . ";";
    $res = $GLOBALS['db']->getOne($sql);
    if((int)$res > 0){
        $sql = "delete from user_bonus_card_type where id = " . $id . ";";
        $res = $GLOBALS['db']->query($sql);
        if($res){
            return True;
        }else{
            return False;
        }
    }else{
        return False;
    }

}
function get_cards_count_by_card_type($id){
    $sql = "select count(*) from user_bonus_card where type = " . $id . ";";
    $res = $GLOBALS['db']->getOne($sql);
    return $res;
}
function get_cards_by_card_type($id, $start, $limit){
    $sql = "select user_bonus_card.id, keycode, description, bonus, is_recharged, user, user_bonus_card.rechagred_time, user_bonus_card.is_avaliable, time_start, time_end from user_bonus_card left join user_bonus_card_type on user_bonus_card.type = user_bonus_card_type.id where type = ". $id ." order by id " . " limit " . $start . "," . $limit . ";";
    $cards = $GLOBALS['db']->getAll($sql);
    return $cards;
}
function update_card_type($id, $bonus, $description, $is_avaliable){
    //　　UPDATE users SET age = 24 WHERE id = 123;
    $sql = "UPDATE user_bonus_card_type set bonus = " . $bonus . "," . "description='" . $description . "'," . "is_avaliable=" . $is_avaliable . " where id = " . $id . ";";
    $GLOBALS['db']->query($sql);
}
// card_type operation end

//card operation


function delete_bonus_card_by_id($id){
    $sql = "select count(*) from user_bonus_card where id = " . $id . ";";
    $res = $GLOBALS['db']->getOne($sql);
    if((int)$res > 0){
        $sql = "delete from user_bonus_card where id = " . $id . ";";
        $res = $GLOBALS['db']->query($sql);
        if($res){
            return True;
        }else{
            return False;
        }
    }else{
        return False;
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
        $sql = "select user_bonus_card.id, keycode, description, bonus, is_recharged, user, user_bonus_card.rechagred_time, user_bonus_card.is_avaliable, time_start, time_end from user_bonus_card left join user_bonus_card_type on user_bonus_card.type = user_bonus_card_type.id order by id " . " limit " . $start . "," . $limit . ";";
        $res = $GLOBALS['db']->getAll($sql);
        return $res;
    }else{
        $sql = "select user_bonus_card.id, keycode, description, bonus, is_recharged, user, user_bonus_card.rechagred_time, user_bonus_card.is_avaliable, time_start, time_end from user_bonus_card left join user_bonus_card_type on user_bonus_card.type = user_bonus_card_type.id ;";
        $res = $GLOBALS['db']->getAll($sql);
        echo json_encode($res);
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
if("bonus_card" == $page_type){
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

    }elseif("delete" == $act){
        $card_id = $_REQUEST['id'];
        $res = delete_bonus_card_by_id($card_id);
        if($res){
            $smarty->assign("state", True);
            $smarty->display("bonus_card_delete_result.htm");
        }
    }elseif("add" == $act){

        if($_REQUEST['count'] && $_REQUEST['start_time'] && $_REQUEST['end_time'] && $_REQUEST['type']){
            $count = $_REQUEST['count'];
            $start_time = $_REQUEST['start_time'];
            $end_time = $_REQUEST['end_time'];
            $type_id = $_REQUEST['type'];
            //check time
            $start_timedate = new DateTime($start_time);
            $end_timedate   = new DateTime($end_time);

            if( ($end_timedate->getTimestamp() - $start_timedate->getTimestamp() ) < 0){
                $smarty->assign("state", False);
                $smarty->assign("message", "时间错误");
                $smarty->display("bonus_card_add_result.htm");
            }
            if($count < 0 ){
                $smarty->assign("state", False);
                $smarty->assign("message", "数量不能为负数");
                $smarty->display("bonus_card_add_result.htm");
            }

            $res = add_card($type_id, $start_time, $end_time, $count);
            if($res > 0){
                $smarty->assign("state", True);
                $smarty->display("bonus_card_add_result.htm");

            }

        }else{
            $datetime = new DateTime('2008-08-11 14:52:10');
            $datetime2 = new DateTime('2008-08-22 14:52:10');
            //echo json_encode($datetime->getTimestamp() - $datetime2->getTimestamp()) ;
            $all_types = find_all_card_type(0,0);
            $smarty->assign("types", $all_types);
            $smarty->display("bonus_card_add.htm");
        }
    }

}elseif("bonus_card_type" == $page_type){
    $smarty->assign("page_type", $page_type);

    if($act == "list"){
        $record_count = get_all_card_type_count();
        $pager = pager($current_page, PAGE_SIZE, $record_count);
        $res = find_all_card_type((int)$pager['start'], (int)$pager['limit']);
        $smarty->assign("current_page", $current_page);
        $smarty->assign("prev", $pager['prev']);
        $smarty->assign("next", $pager['next']);
        $smarty->assign("record_count", $record_count);
        $smarty->assign("page_count", $pager['page_count']);
        $smarty->assign("filter", array('page'=>$current_page, 'page_size'=>PAGE_SIZE));
        $smarty->assign("cards_types", $res);
        $smarty->display("bonus_card_list.htm");
    }elseif($act=="delete"){
        $id = $_REQUEST['id'];
        $res = delete_card_type_by_id($id);
        if($res){
            $smarty->assign("state", True);
            $smarty->display("bonus_card_type_delete_result.htm");
        }else{
            $smarty->assign("state", False);
            $smarty->assign("message", "删除失败");
            $smarty->display("bonus_card_type_delete_result.htm");
        }
    }elseif($act=="view"){
        $id = $_REQUEST['id'];
        $card_type = find_card_type_by_id($id);
        $card_count = get_cards_count_by_card_type($id);
        $pager = pager($current_page, PAGE_SIZE, $card_count);
        $cards = get_cards_by_card_type($id, (int)$pager['start'], (int)$pager['limit']);
        $smarty->assign("type", $card_type);
        $smarty->assign("cards", $cards);
        $smarty->display("bonus_cards_type_view.htm");
    }elseif($act=="add"){
        if($_REQUEST['bonus'] && $_REQUEST['description']){
            $bonus = $_REQUEST['bonus'];
            $desc = $_REQUEST['description'];
            if(preg_match("/[\d+]/",$bonus)){
                if((int)$bonus < 0){
                    //error
                    $smarty->assign("state", False);
                    $smarty->assign("message", "金额不能小于0");
                    $smarty->display("bonus_card_type_add_result.htm");
                }else{
                    // correct
                    add_card_type($bonus, $desc);
                    $smarty->assign("state", True);
                    $smarty->display("bonus_card_type_add_result.htm");
                }

            }else{
                $smarty->assign("state", False);
                $smarty->assign("message", "金额必须是数字");
                $smarty->display("bonus_card_type_add_result.htm");
                //error
            }

            echo "post add";
        }else{
            $smarty->display("bonus_card_type_add.htm");

        }
    }elseif($act == "edit"){

        if($_REQUEST['id'] && $_REQUEST['bonus'] && $_REQUEST['description'] ){
            //do update
            $id = $_REQUEST['id'];
            $bonus = $_REQUEST['bonus'];
            $desc = $_REQUEST['description'];
            $is_avaliable = $_REQUEST['is_avaliable'];
            update_card_type($id, $bonus, $desc, $is_avaliable);
            echo "<script> window.location.href='bonus_cards.php?act=list&page_type=bonus_card_type'</script>";
        }else{
            $id = $_REQUEST['id'];
            $type = find_card_type_by_id($id);
            $smarty->assign("type", $type);
            $smarty->display("bonus_card_type_edit.htm");
        }
    }

}


?>