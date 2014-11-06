
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/bonus_card_list.js')); ?>
<script>
</script>
<div align="center">
    <p>
        <?php if ($this->_var['state']): ?>
        删除成功

        <?php else: ?>
            <?php echo $this->_var['message']; ?>
        <?php endif; ?>
    </p>
</div>
<script>
    window.location.href = "bonus_cards.php?act=list&page_type=bonus_card_type";
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
