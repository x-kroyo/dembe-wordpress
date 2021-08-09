<?php get_header(); ?>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body border-bottom">
        <?php get_template_part( 'templates/title', null, array('title' => __('Panier (' . WC()->cart->get_cart_contents_count() . ' items)') )) ?>
        <div class="row">
            <div class="col-7">
                <h6 class="mb-0">Produit</h6>
            </div>
            <div class="col-1">
                <h6 class="mb-0 text-center">Quantité</h6>
            </div>
            <div class="col-2">
                <h6 class="mb-0 text-center">Prix Unitaire</h6>
            </div>
            <div class="col-2">
                <h6 class="mb-0 text-center">Sous Totale</h6>
            </div>
        </div>
    </div>
    <?php if(WC()->cart->is_empty() == false): ?>
        <?php foreach($woocommerce->cart->get_cart() as $item):
                $product = $item['data'];
                
        ?>
        <div class="card-body border-bottom">
            <div class="row align-items-center">
                <div class="col-7">
                    <div class="d-flex align-items-center">
                        <div class="me-3" style="width: 70px">
                            <img class="w-100 mb-2" src="<?= wp_get_attachment_url($product->image_id) ?>" alt="">
                        </div>
                        <div class="w-100">
                            <a class="small fw-bold text-decoration-none mb-1 d-block" href="<?= get_permalink($item['product_id']) ?>"><?= $product->name ?></a>
                            <?php if($product->is_type('variation')): ?>
                            <div class="d-block">
                                <?php foreach($product->get_attributes() as $k => $v): ?>
                                <span class="bagde rounded-3 border py-1 text-muted px-2 me-1 very-small"><?= ucfirst($k) ?>: <b><?= $v ?></b></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class="mt-3">
                                <?php get_template_part('templates/r_stars', null, array('rating' => $product->get_average_rating())) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="d-flex align-items-center mb-3">
                        <select name="quantity" id="quantity" class="form-select border-0" style="background-color: rgba(0,0,0,0.05);color: rgba(0,0,0,0.85);">
                            <?php for($i = 1; $i <= 30; $i++): ?>
                                <option value="<?= $i ?>" <?= $i == $item['quantity'] ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <h6 class="fw-bold text-success"><?= $product->price ?> Dhs</h6>
                    <?php if($product->is_on_sale()): ?>
                        <s class="small text-muted"><?= $product->regular_price ?> Dhs</s>
                        <div class="text-primary fw-bold d-inline-block very-small rounded" style="background: #e7f0ff;padding: 3px 4px;"><?= calculate_discount_percentage($product->regular_price, $product->sale_price) ?>%</div>
                    <?php endif; ?>
                </div>
                <div class="col-2">
                    <p class="very-small text-center mb-1 text-muted">Prix totale à payer</p>
                    <h5 class="fw-bold mb-0 text-center"><?= $product->price * $item['quantity'] ?> Dhs</h5>
                </div>
            </div>
            
        </div>
        <?php endforeach; ?>
        <div class="card-body py-3">
            <div class="row">
                <div class="col-10">
                    <h6 class="mb-0">Total TTC</h6>
                </div>
                <div class="col-2">
                    <h6 class="text-primary fw-bold text-center mb-0"><?= WC()->cart->total ?> Dhs</h6>
                </div>
            </div>
        </div>
    <?php else: ?>
        You cart is empty
    <?php endif; ?>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-3 col-md-3 col-sm-6 col-11">
                <a class="btn bg-white text-primary shadow-sm border d-flex align-items-center w-100 py-2" href="<?= home_url() ?>">
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M21.999 8a.997.997 0 0 0-.143-.515L19.147 2.97A2.01 2.01 0 0 0 17.433 2H6.565c-.698 0-1.355.372-1.714.971L2.142 7.485A.997.997 0 0 0 1.999 8c0 1.005.386 1.914 1 2.618V20a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-5h4v5a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-9.382c.614-.704 1-1.613 1-2.618zm-2.016.251A2.002 2.002 0 0 1 17.999 10c-1.103 0-2-.897-2-2 0-.068-.025-.128-.039-.192l.02-.004L15.219 4h2.214l2.55 4.251zm-9.977-.186L10.818 4h2.361l.813 4.065C13.957 9.138 13.079 10 11.999 10s-1.958-.862-1.993-1.935zM6.565 4h2.214l-.76 3.804.02.004c-.015.064-.04.124-.04.192 0 1.103-.897 2-2 2a2.002 2.002 0 0 1-1.984-1.749L6.565 4zm3.434 12h-4v-3h4v3z"></path></svg>
                    </div>
                    <span class="mx-auto">Continue votre achat</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-11">
                <a class="btn btn-primary shadow-sm ms-1 d-flex align-items-center w-100 py-2 fw-bold" href="<?= wc_get_checkout_url() ?>">
                    <span class="mx-auto">Checkout</span>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>