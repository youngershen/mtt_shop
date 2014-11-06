
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/bonus_card_list.js')); ?>
<script>
</script>

<button onclick="card_admin()">充值卡管理</button> &nbsp <button onclick="type_admin()">充值卡类型管理</button>

<div align="center">
    <form action="bonus_cards.php?act=edit&page_type=bonus_card_type" method="post">
        <input type="text" hidden="hidden" value="<?php echo $this->_var['type']['id']; ?>" name="id"/>
        <span>金额:&nbsp</span>&nbsp<input type="text" name="bonus" value="<?php echo $this->_var['type']['bonus']; ?>"/>
        <br>
        <span>描述:&nbsp</span><input type="text" name="description" value="<?php echo $this->_var['type']['description']; ?>"/>
        <br>
        <span>是否可用:&nbsp</span>
        <select name="is_avaliable" >
            <option value="0" <?php if (! $this->_var['type']['is_avaliable']): ?> selected <?php endif; ?>>否</option>
            <option value="1" <?php if ($this->_var['type']['is_avaliable']): ?> selected <?php endif; ?>>是</option>
        </select>
        <button type="submit">提交</button>

    </form>
</div>
<script>
    //window.location.href = "bonus_cards.php?act=list&page_type=bonus_card_type";
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
