
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/bonus_card_list.js')); ?>
<script>
    redirect_to_main();
</script>
        <div align="center">
            <p>
                <?php if ($this->_var['state']): ?>
                删除成功

                <?php else: ?>
                删除失败
                <?php endif; ?>
            </p>
        </div>
<?php echo $this->fetch('pagefooter.htm'); ?>
