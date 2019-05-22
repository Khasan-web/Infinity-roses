<?php
    $keywords_arr = explode(' ', $category['keywords']);
?>
<?php if (!in_array('unique', $keywords_arr)):?>
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