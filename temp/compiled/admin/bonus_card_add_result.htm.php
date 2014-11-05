<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/bonus_card_list.js')); ?>
<script>
    redirect_to_main();
</script>
<div align="center">
    <p>
        <?php if ($this->_var['state']): ?>
            <span>成功创建</span>

        <?php else: ?>
            <span><?php echo $this->_var['message']; ?></span>
        <?php endif; ?>
    </p>
</div>
<?php echo $this->fetch('pagefooter.htm'); ?>
