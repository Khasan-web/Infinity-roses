<?php if ($category['name_en'] != 'Wedding Decoration'):?>
<option value="<?= $category['id']?>" 
<?php 
    if ($category['id'] == $this->model->category_id) { 
        echo 'selected';
    }
?>>
    <?= $tab . $category['name_en']?>
</option>
<?php endif;?>
<?php if(isset($category['childs'])):?>
    <ul>
        <?= $this->getMenuHtml($category['childs'], $tab . '- ')?>
    </ul>
<?php endif;?>