<?php
    get_header();
    $product = wc_get_product();
    the_post();
?>
	<script type="text/template" id="tmpl-variation-template">
	<div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
	<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
	<div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>

	<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $product->get_available_variations() ) ) ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>
	
		<?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
			<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
		<?php else : ?>
			<table class="variations" cellspacing="0">
				<tbody>
                  <?php foreach ( $product->get_variation_attributes() as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
							<td class="value">
								<?php
									$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
									wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
									// echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
								?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
	
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	
			<div class="single_variation_wrap">
				<?php
					/**
					 * woocommerce_before_single_variation Hook.
					 */
					do_action( 'woocommerce_before_single_variation' );
	
					/**
					 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
					 * @since 2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );
	
					/**
					 * woocommerce_after_single_variation Hook.
					 */
					do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
	
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<?php endif; ?>
	
		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb small mb-3">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= home_url() ?>">Home</a></li>
        <?php foreach($product->category_ids as $category_id):
            $category = get_term($category_id);
            ?>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="<?= get_term_link($category_id)  ?>"><?= $category->name ?></a></li>
        <?php endforeach; ?>
        
        <li class="breadcrumb-item active" aria-current="page"><?= $product->name ?></li>
    </ol>
</nav>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-5">
                        <img class="w-100" src="<?= wp_get_attachment_url($product->image_id) ?>" alt="">
                    </div>
                    <div class="col-lg-7">
                        <section class="mb-3 pb-2 border-bottom">
                            <h4 class="fw-normal mb-3"><?= $product->name ?></h4>
                            <div class="mb-2">
                                <?php get_template_part('templates/r_stars', null, array('rating' => $product->get_average_rating())) ?>
                            </div>
                        </section>
                        <?php if($product->is_type('variable')):
                                $max_price = $product->get_variation_price( 'min', true );
                                $min_price = $product->get_variation_price( 'max', true );
                            ?>
                            <section class="mb-3 pb-2">
                                <h4 class="fw-bold mb-3"><?= $min_price != $max_price ? number_format($min_price, 2) . ' - ' . number_format($max_price, 2) : number_format($max_price, 2) ?> Dhs</h4>
                                <?php foreach($product->get_variation_attributes() as $k => $attributes):
                                $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $k ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $k ) ] ) ) : $product->get_variation_default_attribute( $k );
                                ?>
                                    <div class="variation-attribute mb-3" id="<?= sanitize_title($k) ?>">
                                        <p class="small mb-1">
                                            <span class="text-muted"><?= wc_attribute_label($k) ?></span>
                                            <span id="attribute_<?= $k ?>"></span>
                                        </p>
                                        <div class="d-flex align-items-center">
                                        <?php foreach($attributes as $attribute): ?>
                                            <div class="d-block px-3 py-2 border small rounded-3 me-2 <?= $selected == $attribute ? 'fw-bold border-primary text-primary' : '' ?>"><?= $attribute ?></div>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </section>
                        <?php else: ?>
                            <section class="mb-3 pb-2">
                                <h4 class="fw-bold"><?= number_format($product->sale_price, 2) ?> Dhs</h4>
                                <div class="d-flex align-items-center mb-2">
                                    <p class="text-muted mb-0 me-2 small"><s><?= number_format($product->regular_price, 2) ?> Dhs</s></p>
                                    <div class="text-primary very-small fw-bold" style="background: #e7f0ff;padding: 3px 4px;border-radius: 2px;"><?= calculate_discount_percentage($product->regular_price, $product->sale_price) ?>%</div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <section class="mb-3 pb-2">
                            <h6 class="text-uppercase fw-bold small mb-3">Promotions</h6>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-3 text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="m21 2-5 5-4-5-4 5-5-5v13h18zM5 21h14a2 2 0 0 0 2-2v-2H3v2a2 2 0 0 0 2 2z"></path></svg>
                                </div>
                                <a class="small text-decoration-none" href="#">Livraison gratuite à Casablanca, Rabat, Marrakech ou Tanger avec Jumia Prime, abonnez-vous maintenant</a>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-3 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M19.148 2.971A2.008 2.008 0 0 0 17.434 2H6.566c-.698 0-1.355.372-1.714.971L2.143 7.485A.995.995 0 0 0 2 8a3.97 3.97 0 0 0 1 2.618V19c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-8.382A3.97 3.97 0 0 0 22 8a.995.995 0 0 0-.143-.515l-2.709-4.514zm.836 5.28A2.003 2.003 0 0 1 18 10c-1.103 0-2-.897-2-2 0-.068-.025-.128-.039-.192l.02-.004L15.22 4h2.214l2.55 4.251zM10.819 4h2.361l.813 4.065C13.958 9.137 13.08 10 12 10s-1.958-.863-1.993-1.935L10.819 4zM6.566 4H8.78l-.76 3.804.02.004C8.025 7.872 8 7.932 8 8c0 1.103-.897 2-2 2a2.003 2.003 0 0 1-1.984-1.749L6.566 4zM10 19v-3h4v3h-4zm6 0v-3c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v3H5v-7.142c.321.083.652.142 1 .142a3.99 3.99 0 0 0 3-1.357c.733.832 1.807 1.357 3 1.357s2.267-.525 3-1.357A3.99 3.99 0 0 0 18 12c.348 0 .679-.059 1-.142V19h-3z"></path></svg>
                                </div>
                                <a class="small text-decoration-none" href="#">Profitez de 6% de remise sur les recharges téléphoniques sur JumiaPay. Utilisez le code: MOB6</a>
                            </div>
                        </section>
                        <section class="mb-3 pb-2">
                            <h6 class="text-uppercase fw-bold small mb-3">A propos du produit</h6>
                            <div>
                                <?= $product->short_description ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <?php if(!$product->is_type('variable')): ?>
                <div class="mb-2">
                    <h4 class="fw-bold"><?= number_format($product->sale_price, 2) ?> Dhs</h4>
                    <p class="small text-muted">+ 0.00 Dhs du livraison</p>
                </div>
                <?php endif; ?>
                <h6 class="mt-3 fw-bold text-<?= $product->is_in_stock() ? 'success' : 'danger' ?>"><?= $product->is_in_stock() ? 'In Stock' : 'Out Of Stock' ?></h6>
                <div class="form-group mb-2">
                    <label class="small mb-2" for="quantity">Quantity</label>
                    <div class="d-flex align-items-center mb-3">
                        <button class="btn btn-sm btn-light border shadow-sm rounded" id="p-quantity-minus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M5 11h14v2H5z"></path></svg>
                        </button>
                        <input type="number" class="form-control form-control-inline mx-2 text-center" id="p-quantity" value="1" min="0" max="30" step="1"/>
                        <button class="btn btn-sm btn-light shadow-sm rounded" id="p-quantity-add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
                        </button>                        
                    </div>
                </div>
                <div class="d-grid gap-2 mb-4">
                    <button class="btn btn-primary btn-sm py-2 shadow-sm" type="button">Ajouter au panier</button>
                    <button class="btn border btn-sm py-2 shadow-sm" type="button">J'achète maitenant</button>
                </div>
                <section>
                    <div class="d-flex justify-content-start">
                        <div class="me-2">
                            <svg viewBox="0 0 24 24" class="border" width="40" height="40"><use xlink:href="https://www.jumia.ma/assets_he/images/i-icons.e70b7734.svg#truck"></use></svg>
                        </div>
                        <div>
                            <h6 class="small">Livraison à domicile</h6>
                            <p class="very-small">Prêt pour livraison entre <span class="fw-bold">17 août et 26 août</span> si vous commandez d'ici.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="me-2">
                            <svg viewBox="0 0 24 24" class="border" width="40" height="40"><use xlink:href="https://www.jumia.ma/assets_he/images/i-icons.e70b7734.svg#truck"></use></svg>
                        </div>
                        <div>
                            <h6 class="small">Politique de retour</h6>
                            <p class="very-small">Retour gratuit dans les 15 jours pour les articles provenant de boutiques officielles et dans les 7 jours pour le reste.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>  
    </div>
</div>

<ul class="list-group list-group-flush shadow-sm rounded-3 mb-4">
    <li class="list-group-item py-3">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <h6 class="fw-bold mb-0"><?= __('Weight') ?></h6>
            </div>
            <div class="col-lg-8">
                <p class="mb-0"><?= $product->get_weight() ?> Kilograms</p>
            </div>
        </div>
    </li>
    <li class="list-group-item py-3">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <h6 class="fw-bold mb-0"><?= __('Dimensions ( Height × Length × Width )') ?></h6>
            </div>
            <div class="col-lg-8">
                <p class="mb-0"><?= $product->get_dimensions() ?></p>
            </div>
        </div>
    </li>
    <?php if($product->get_sku()): ?>
    <li class="list-group-item py-3">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <h6 class="fw-bold mb-0"><?= __('SKU') ?></h6>
            </div>
            <div class="col-lg-8">
                <p class="mb-0"><?= $product->get_sku() ?></p>
            </div>
        </div>
    </li>
    <?php endif; ?>
    <?php foreach($product->get_attributes() as $attribute): ?>
        <li class="list-group-item py-3">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-0"><?= $attribute['name'] ?></h6>
                </div>
                <div class="col-lg-8">
                    <p class="mb-0"><?= implode(', ', $attribute['options']) ?></p>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="post-description">
            <div class="text-center py-3 mb-4">
                <h3 class="fw-bold mb-3">Détails</h3>
                <div class="bg-primary mx-auto" style="height: 4px;width: 75px"></div>
            </div>
            <div><?= $product->description  ?></div>
        </div>
    </div>
</div>


<?php if(comments_open()): ?>
<div class="post-reviews card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="text-center py-3 mb-4">
            <h3 class="fw-bold mb-3">Rating and Reviews</h3>
            <div class="bg-primary mx-auto" style="height: 4px;width: 75px"></div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="text-center mb-3">
                    <h1 class="text-warning fw-bold mb-1"><?= $product->get_average_rating() ?> de 5</h1>
                    <div class="d-flex justify-content-center mb-3">
                        <?php get_template_part('templates/r_stars', null, array('rating' => $product->get_average_rating())) ?>
                    </div>
                    <p class="text-center mb-0"><?= $product->get_rating_count() ?> avis</p>
                </div>
                <?php for($i = 5;$i >= 1;$i--): ?>
                <div class="row align-items-center mb-2">
                    <div class="col-3">
                        <div class="d-flex align-items-center">
                            <b><?= $i ?></b>
                            <div class="text-warning ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="progress w-100">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <p class="mb-0 text-right text-muted"><?= $i * 10 ?>%</p>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="col-lg-9">
                <div>
                    <?php // comments_template( 'woocommerce/single-product-reviews' ); ?>
                    <form action="<?= home_url() ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">
                    </form>
                </div>
                <?php foreach(get_comments(array('post_id' => get_the_ID())) as $comment):
                    $comment_meta = get_comment_meta( $comment->comment_ID );
                ?>
                    <div class="comment mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="user-comment-avatar" style="width: 26px;height: 26px">
                                <img class="w-100 h-100 rounded-circle" src="<?= get_avatar_url($comment->user_id) ?>" alt="">
                            </div>
                            <a class="ms-3 fw-bold small text-decoration-none" href="<?= $comment->comment_author_url ?>"><?= $comment->comment_author ?></a>
                            <?php if(array_key_exists('rating', $comment_meta)): ?>
                                <div class="ms-auto d-flex flex-column align-items-end">
                                    <?php get_template_part('templates/r_stars', null, array('rating' => $comment_meta['rating'][0])) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="comment-content">
                            <p class="small mb-2"><?= $comment->comment_content ?></p>
                        </div>
                        <!-- <small class="text-muted">Aug, 5 2020</small> -->
                    </div>
                <?php endforeach; ?>
                <div class="row justify-content-end mt-5">
                    <div class="col-lg-2 col-md-4 col-12">
                        <a class="btn btn-primary shadow-sm ms-1 d-flex align-items-center w-100" href="<?= wc_get_checkout_url() ?>">
                            <span class="mx-auto">Voir Plus</span>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="product-similars">
            <div class="text-center py-3 mb-4">
                <h3 class="fw-bold mb-3">Relative Products</h3>
                <div class="bg-primary mx-auto" style="height: 4px;width: 75px"></div>
            </div>
            <div class="row">
                <?php foreach(wc_get_related_products(get_the_ID(), 12) as $relative_id): $relative = wc_get_product($relative_id); ?>
                <div class="col-lg-2">
                    <div class="d-flex flex-column mb-4">
                        <img height="80" class="w-100 mb-2" src="<?= get_the_post_thumbnail_url($relative_id) ?>" alt="">
                        <a class="d-flex mb-1 text-decoration-none text-dark" href="<?= the_permalink($relative_id) ?>">
                            <small class="text-truncate"><?= $relative->name ?></small>
                        </a>
                        <h6 class="fw-bold small mb-1"><?= $relative->is_on_sale() ? $relative->sale_price : $relative->regular_price ?> Dhs</h6>
                        <?php if($relative->is_on_sale()): ?>
                            <div class="d-flex align-items-center very-small">
                                <s class="text-muted me-2"><?= $relative->regular_price ?> Dhs</s>
                                <div class="text-primary fw-medium rounded" style="background: #e7f0ff;padding: 3px 4px;"><?= calculate_discount_percentage($relative->regular_price, $relative->sale_price) ?>%</div>
                            </div>
                        <?php endif; ?>
                        <div class="mt-2">
                            <?php get_template_part('templates/r_stars', null, array('rating' => $relative->get_average_rating())) ?>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>