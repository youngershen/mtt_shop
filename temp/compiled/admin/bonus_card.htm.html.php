<!-- $Id: bonus_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php echo $this->fetch('pageheader.htm'); ?>
    <div id = "bonus_card_menu">
        <button>充值卡管理</button> &nbsp <button>充值卡类型管理</button>
        <?php if ($this->_var['page_type'] == "bonus_card"): ?>
            bonus card
        <?php endif; ?>

        <?php if ($this->_var['page_tyoe'] == "bonus_card_type"): ?>
            bonus card type
        <?php endif; ?>

    </div>
<?php echo $this->fetch('pagefooter.htm'); ?>
