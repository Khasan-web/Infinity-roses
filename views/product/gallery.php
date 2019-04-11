<section class="gallery section-basic text-center">
    <div class="gallery__title">
        <h2 class="prata fsize_h1">Our Gallery</h2>
    </div>
    <div class="gallery__categories">
        <?php foreach ($categories as $category):?>
        <button class="btn btn-outline-dark px-2 py-1 gallery__category" data-id="<?= $category['id']?>"><?= $category[$name]?></button>
        <?php endforeach;?>
        <button class="btn btn-dark px-2 py-1 gallery__show-all">All</button>
        <!-- php script to show galleries -->
    </div>
    <div class="gallery_images container">
        <?php foreach ($gallery as $image):?>
            <div class="item" href="web/upload/store/gallery/<?= $image->img?>" data-category="<?= $image->category->id?>">
                <img src="web/upload/store/gallery/<?= $image->img?>" class="img-thumbnail" alt="<?= $image->category->name_en?>">
            </div>
        <?php endforeach;?>
    </div>
    <div class="gallery__social-nets my-4">
        <span><?= Yii::t('app', 'Share to your friends')?>?</span>
        <div class="ya-share2" data-services="facebook,whatsapp,twitter,telegram"></div>
    </div>

</section>