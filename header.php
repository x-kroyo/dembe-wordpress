<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title() ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php wp_head() ?>
</head>
<body <?= body_class('light') ?>>
    <div class="py-2 bg-primary text-white">
        <div class="container">
            <div class="row align-items-between">
                <div class="col-3">
                    <div class="d-flex align-itemx-center">
                        <small class="fw-medium">Vendre sur Foorks</small>
                    </div>
                </div>
                <div class="col-6"></div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
    <div class="bg-white shadow-sm py-4 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2">
                    <a href="<?= home_url() ?>" aria-label="Amazon.com">
                        <img style="height: 60px" src="https://upload.wikimedia.org/wikipedia/commons/4/48/EBay_logo.png" alt="Amazon.com">
                    </a>
                </div>
                <div class="col">
                    <form role="search" method="get" class="search-form" action="#">
                        <div class="d-flex align-items-center">
                            <div class="form-input position-relative me-2 flex-grow-1">
                                <input type="text" class="form-control search-input" value="" name="search" id="search" placeholder="Chercher un produit, une marque ou une catégorie..." aria-label="Chercher un produit, une marque ou une catégorie..." aria-describedby="button-addon2">
                                <div class="position-absolute text-secondary search-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>
                                </div>
                            </div>
                            <button class="btn btn-primary shadow-sm px-3 text-uppercase fw-bold py-2 small search-submit" type="submit">Rechercher</button>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    <div class="row align-items-center justify-content-end">
                        <div class="col-8">
                            <a class="d-flex text-decoration-none text-dark align-items-center justify-content-end" href="<?= get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __(is_user_logged_in() ? 'Votre compte' : 'Se connecter') ?>">
                                <div class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" style="fill: currentColor;transform: ;msFilter:;"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
                                </div>
                                <span class="text-truncate"><?= is_user_logged_in() ? wp_get_current_user()->nickname : __('Se connecter') ?></span>
                            </a>
                        </div>
                        <div class="col-3">
                            <a class="text-dark position-relative" href="<?= wc_get_cart_url() ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Your cart">
                                <span class="position-absolute top-0 start-100 translate-middle cart-badge very-small rounded-circle text-white rounded-circle d-flex align-items-center justify-content-center fw-bold">
                                    <?= WC()->cart->cart_contents_count ?>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M5 22h14a2 2 0 0 0 2-2V9a1 1 0 0 0-1-1h-3v-.777c0-2.609-1.903-4.945-4.5-5.198A5.005 5.005 0 0 0 7 7v1H4a1 1 0 0 0-1 1v11a2 2 0 0 0 2 2zm12-12v2h-2v-2h2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-2 3h2v2H7v-2z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container">