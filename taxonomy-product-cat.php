<?php
    // Inlude header
    get_header();
    $category = $wp_query->get_queried_object();

    // Return the current page number
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    print_r($paged);
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 3,
        'order' => get_query_var( 'order_by' ) ?? 1,
        'post_status' => 'publish',
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'terms'    => $category->term_id,
            ),
        ),
    );
    $q = new WP_Query($args);
?>
<div class="row">
    <div class="col-lg-3">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body border-bottom">
                <h6 class="fw-bold mb-2">Brands</h6>
                <div class="">
                    <a class="btn me-2 mb-2" style="background-color: rgba(0,0,0,0.05);color: rgba(0,0,0,0.85);" href="#">Oppo</a>
                    <a class="btn me-2 mb-2" style="background-color: rgba(0,0,0,0.05);color: rgba(0,0,0,0.85);" href="#">Italian Home</a>
                    <a class="btn me-2 mb-2" style="background-color: rgba(0,0,0,0.05);color: rgba(0,0,0,0.85);" href="#">Vivo</a>
                    <a class="btn me-2 mb-2" style="background-color: rgba(0,0,0,0.05);color: rgba(0,0,0,0.85);" href="#">Huawei</a>
                </div>
            </div>
            <div class="card-body border-bottom">
                <h6 class="fw-bold mb-2">Condition</h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="0" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">New</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Used</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Renewed</label>
                </div>
            </div>
            <div class="card-body border-bottom">
                <h6 class="fw-bold mb-2">Prix</h6>
                <div class="row g-0">
                    <div class="col-lg-6 pe-1">
                        <input type="text" name="min_price" placeholder="Min pirce" class="form-control">
                    </div>
                    <div class="col-lg-6 ps-1">
                        <input type="text" name="max_price" placeholder="Max pirce" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="fw-bold mb-2">Rating</h6>
                <?php for($i=4; $i >= 1; $i--): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="f_rating" id="plus-<?= $i ?>-stars">
                        <label class="form-check-label d-flex align-items-center" for="plus-<?= $i ?>-stars">
                            <div class="me-2">
                                <?php get_template_part('templates/r_stars', null, array('rating' => $i)) ?>
                            </div>
                            <div class="d-inline-block small">ou plus</div>
                        </label>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body border-bottom">
                <h6 class="fw-bold mb-2">Explorer autres catégories</h6>
                
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-center py-4">
                    <h4 class="fw-bold"><?= $category->name ?></h4>
                    <div class="bg-primary mb-3 mx-auto" style="height: 3px;width: 55px"></div>
                    <p class="small text-muted mb-0"><?= $category->description ?></p>
                </div>
                <?php if($q->have_posts()): ?>
                <hr>
                <div class="d-flex align-items-center mb-4">
                    <p class="mb-0 me-auto text-secondary">Il'y a <?= $category->count ?> produits</p>
                    <div class="dropdown ms-auto">
                        <button class="btn dropdown-toggle" style="background-color: rgba(0,0,0,0.05);color: rgba(0,0,0,0.85);" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 245px" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item py-2" href="#">Default sorting</a></li>
                            <li><a class="dropdown-item py-2" href="#">Sort by popularity</a></li>
                            <li><a class="dropdown-item py-2" href="#">Sort by average rating</a></li>
                            <li><a class="dropdown-item py-2" href="#">Sort by price: low to high</a></li>
                            <li><a class="dropdown-item py-2" href="#">Sort by price: high to low</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                <?php while($q->have_posts()): $q->the_post(); $product = wc_get_product( get_the_ID() ); ?>
                    <div class="col-lg-3">
                        <div class="d-flex flex-column mb-4">
                            <img height="80" class="w-100 mb-2" src="<?= get_the_post_thumbnail_url() ?>" alt="">
                            <a class="d-flex mb-1 text-decoration-none text-dark" href="<?= the_permalink() ?>">
                                <small class="text-truncate"><?php the_title() ?></small>
                            </a>
                            <h6 class="fw-bold small mb-1"><?= $product->is_on_sale() ? $product->sale_price : $product->regular_price ?> Dhs</h6>
                            <?php if($product->is_on_sale()): ?>
                                <div class="d-flex align-items-center very-small">
                                    <s class="text-muted me-2"><?= $product->regular_price ?> Dhs</s>
                                    <div class="text-primary fw-medium rounded" style="background: #e7f0ff;padding: 3px 4px;"><?= calculate_discount_percentage($product->regular_price, $product->sale_price) ?>%</div>
                                </div>
                            <?php endif; ?>
                            <div class="mt-2">
                                <?php get_template_part('templates/r_stars', null, array('rating' => $product->get_average_rating())) ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
                <?php if($q->max_num_pages > 1): ?>
                <div class="pagination d-flex align-items-center justify-content-center py-3">
                    <?php if(get_previous_posts_link()): ?>
                        <a class="btn text-primary border shadow-sm me-2 d-flex align-items-center px-3" href="<?= get_previous_posts_page_link() ?>">
                            <div class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                            </div>
                            <span class="mx-auto">Previous</span>
                        </a>
                    <?php endif;
                    for($i = 1; $i <= $q->max_num_pages;$i++): ?>
                        <a class="btn shadow-sm mx-1 <?= $i == $paged ? 'btn-primary fw-bold' : 'text-primary border' ?>" href="<?= get_pagenum_link($i) ?>"><?= $i ?></a>
                    <?php endfor;
                    if(get_next_posts_link()): ?>
                        <a class="btn text-primary border shadow-sm ms-2 d-flex align-items-center px-3" href="<?= get_next_posts_page_link() ?>">
                            <span class="mx-auto">Next</span>
                            <div class="ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php else: ?>
                    <div class="d-flex align-items-center flex-column py-3">
                        <img class="mb-2" style="height: 80px;width: 80px" src="https://www.jumia.ma/assets_he/images/binoculars.41e1bc35.svg" alt="">
                        <h4 class="fw-bold">Aucun produit trouvée</h4>
                        <p class="small text-muted">Il n'existe aucun produit pour ce moment pour cette catégorie</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>