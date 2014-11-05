
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/bonus_card_list.js')); ?>
<div id = "bonus_card_menu" class="list-div"  >
        <button>充值卡管理</button> &nbsp <button>充值卡类型管理</button>
        </br>
        <?php if ($this->_var['page_type'] == "bonus_card"): ?>
            <button onclick="add_card()">添加充值卡</button>
            </br>
            <table cellpadding="3" cellspacing="1">
                <th>ID</th>
                <th>序列号</th>
                <th>类型</th>
                <th>金额</th>
                <th>是否被使用</th>
                <th>充值用户</th>
                <th>充值时间</th>
                <th>是否可用</th>
                <th>有效期开始</th>
                <th>有效期结束</th>
                <th>操作</th>

                <?php $_from = $this->_var['cards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td><?php echo $this->_var['item']['id']; ?></td>
                        <td><?php echo $this->_var['item']['keycode']; ?></td>
                        <td><?php echo $this->_var['item']['description']; ?></td>
                        <td><?php echo $this->_var['item']['bonus']; ?></td>
                        <td>
                            <?php if ($this->_var['item']['is_recharged'] == 1): ?>
                            是
                            <?php else: ?>
                            否
                            <?php endif; ?>
                        </td>
                        <td><?php echo $this->_var['item']['user']; ?></td>
                        <td><?php echo $this->_var['item']['recharged_time']; ?></td>
                        <td>
                            <?php if ($this->_var['item']['is_avaliable']): ?>
                            是
                            <?php else: ?>
                            否
                            <?php endif; ?>
                        </td>
                        <td><?php echo $this->_var['item']['time_start']; ?></td>
                        <td><?php echo $this->_var['item']['time_end']; ?></td>
                        <td>
                            <a href="bonus_cards.php?act=delete&id=<?php echo $this->_var['item']['id']; ?>">删除</a> &nbsp
                        </td>
                    </tr>

                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

            </table>
            <table cellpadding="4" cellspacing="0">
                <tr>
                    <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
                </tr>
            </table>

        <?php endif; ?>

        <?php if ($this->_var['page_type'] == "bonus_card_type"): ?>
        <button>添加充值卡类型</button>
         <table cellpadding="3" cellspacing="1">
            <th>ID</th>
            <th>金额</th>
            <th>描述</th>
            <th>是否可用</th>
            <th>更新时间</th>
            <th>创建时间</th>
            <th>操作</th>
             <?php $_from = $this->_var['cards_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                <tr>
                    <td><?php echo $this->_var['item']['id']; ?></td>
                    <td><?php echo $this->_var['item']['bonus']; ?></td>
                    <td><?php echo $this->_var['item']['description']; ?></td>
                    <td>
                        <?php if ($this->_var['item']['is_avaliable']): ?>
                        是
                        <?php else: ?>
                        否
                        <?php endif; ?>
                    </td>

                    <td><?php echo $this->_var['item']['modified_time']; ?></td>
                    <td><?php echo $this->_var['item']['created_time']; ?></td>
                    <td>
                        <a href="bonus_cards.php?act=delete&id=<?php echo $this->_var['item']['id']; ?>">删除</a> &nbsp
                        <a href="bonus_cards.php?act=delete&id=<?php echo $this->_var['item']['id']; ?>">查看</a> &nbsp

                    </td>
                </tr>

        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         </table>

    <table cellpadding="4" cellspacing="0">
        <tr>
            <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
        </tr>
    </table>
        <?php endif; ?>

    </div>
<?php echo $this->fetch('pagefooter.htm'); ?>
