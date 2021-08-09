<?php get_header() ?>

<div class="card shadow-sm border-0">
    <div class="card-body py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-11 text-center">
                <img class="mb-3" style="height: 130px" src="https://static.xx.fbcdn.net/rsrc.php/y7/r/s_LXY1yMsCT.svg" alt="">
                <h3 class="fw-bold">This Page Isn't Available</h3>
                <p class="small text-muted mb-4">
                    The link may be broken, or the page may have been removed. Check to see if the link you're trying to open is correct.
                </p>
                <div class="row">
                    <div class="col">
                        <a href="<?= home_url() ?>" class="btn d-flex align-items-center btn-primary w-100 py-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"></path></svg>
                            </span> 
                            <span class="mx-auto">Back Home</span>                    
                        </a>
                    </div>
                    <div class="col">
                        <a href="<?= home_url() ?>" class="btn d-flex align-items-center btn-light w-100 py-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M21 4H2v2h2.3l3.521 9.683A2.004 2.004 0 0 0 9.7 17H18v-2H9.7l-.728-2H18c.4 0 .762-.238.919-.606l3-7A.998.998 0 0 0 21 4z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="16.5" cy="19.5" r="1.5"></circle></svg>
                            </span> 
                            <span class="mx-auto">Back Home</span>                    
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>