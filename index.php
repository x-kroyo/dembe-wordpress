<?php get_header();?>
<pre>
<?php var_dump(get_theme_mod('slider_animation_duration')) ?>
</pre>
<div class="row mb-5">
    <div class="col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <?php foreach(get_terms('product_cat', array('hide_empty' => 0, 'number' => 12)) as $category): ?>
                    <!-- <pre><?php var_dump($category) ?></pre> -->
                    <a class="d-flex text-decoration-none text-dark align-items-center py-1 small" href="<?= get_term_link($category->term_id) ?>">
                        <?= $category->name ?>
                    </a>
                <?php endforeach; ?>
                <?php if(wp_count_terms('product_cat', array('hide_empty' => 0)) > 12): ?>
                    <a class="d-flex text-decoration-none text-dark align-items-center py-1 small" href="<?= get_term_link($category->term_id) ?>">
                        Autres categories
                    </a>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
    <div class="col-lg-9">
    </div>
</div>
<div class="categories">
    <h5 class="text-uppercase mb-4">Découvrez notre catégories</h5>
    <div class="row">
        <?php foreach(get_terms('product_cat', array('hide_empty' => 0)) as $category): ?>
            <div class="col-2">
                <a href="<?= get_term_link($category->term_id) ?>" class="card shadow-sm border-0 mb-3 text-decoration-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img class="mx-auto mb-2" height="140" src="<?= wp_get_attachment_url(get_term_meta($category->term_id, 'thumbnail_id', true)) ?>" alt="">
                            <h6 class="text-truncate text-dark"><?= $category->name ?></h6>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php get_footer() ?>