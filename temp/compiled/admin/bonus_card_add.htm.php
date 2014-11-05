<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $this->_var['lang']['cp_home']; ?><?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?> <?php endif; ?></title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="styles/general.css" rel="stylesheet" type="text/css" />
    <link href="styles/main.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript">

    </script>
</head>
<body>

<h1>
    <?php if ($this->_var['action_link']): ?>
    <span class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></span>
    <?php endif; ?>
    <?php if ($this->_var['action_link2']): ?>
    <span class="action-span"><a href="<?php echo $this->_var['action_link2']['href']; ?>"><?php echo $this->_var['action_link2']['text']; ?></a>&nbsp;&nbsp;</span>
    <?php endif; ?>
    <span class="action-span1"><a href="index.php?act=main"><?php echo $this->_var['lang']['cp_home']; ?></a> </span><span id="search_id" class="action-span1"><?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?> <?php endif; ?></span>
    <div style="clear:both"></div>
</h1>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/bonus_card_list.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery-ui-1.11.2/external/jquery/jquery.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery-ui-1.11.2/jquery-ui.min.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery-ui-timepicker-addon.js')); ?>


<link rel="stylesheet" href="../js/jquery-ui-1.11.2/jquery-ui.min.css"/>
<link rel="stylesheet" href="../js/jquery-ui-1.11.2/jquery-ui.theme.min.css"/>
<link rel="stylesheet" href="../js/jquery-ui-1.11.2/jquery-ui.structure.min.css"/>
<link rel="stylesheet" href="../js/jquery-ui-timepicker-addon.css"/>


<script>
    $(document).ready(function(){
        $("#start_time").datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat:'HH:mm:ss',
                    stepHour: 2,
                    stepMinute: 10,
                    stepSecond: 10
                }
          );
        $("#end_time").datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat:'HH:mm:ss',
                    stepHour: 2,
                    stepMinute: 10,
                    stepSecond: 10
                }
        );

    });
</script>

<div id="add_bonus_card" align="center">
            <form action="bonus_cards.php?act=add" method="post">充值卡类型:&nbsp
                <select name="type" id="">
                    <?php $_from = $this->_var['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <option value="<?php echo $this->_var['item']['id']; ?>"><?php echo $this->_var['item']['description']; ?></option>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </select>
                <br>
                <span>开始时间:&nbsp</span><input type="text" name="start_time" id="start_time"/>
                <br>
                <span>结束时间:&nbsp</span><input type="text" name="end_time" id="end_time" />
                <br>

                <span>添加数量:&nbsp</span><input type="text" name="count"/>
                <br>
                <button type="submit">提交</button>
            </form>

        </div>
<?php echo $this->fetch('pagefooter.htm'); ?>
