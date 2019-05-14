<option value="<?= $category['id']?>" 
<?php 
    if ($category['id'] == $this->model->parent_id && $category['id']) { 
        echo 'selected'; 
    }
    if ($category['id'] == $this->model->id) { 
        echo 'disabled'; 
    }
?>>
    <?= $tab . $category['name_en']?>
</option>
<?php if(isset($category['childs'])):?>
    <ul>
        <?= $this->getMenuHtml($category['childs'], $tab . '-')?>
    </ul>
<?php endif;?>