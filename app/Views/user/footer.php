<footer class="footer appear-animate" data-animation-options="{ 'delay': '.2s' }">
            <div class="footer-middle">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="widget widget-about">
                                <a href="/" class="logo-footer mb-5">
                                    <img src="/img/logo.png" alt="logo-footer" width="308"
                                        height="86" />
                                </a>
                                <div class="widget-body">
                                    <p class="ls-s">Kurz Metal Art is a family owned business located in Youngstown, Ohio.<br><br>
                                    <a href="mailto:kurzwelding@gmail.com">kurzwelding@gmail.com</a>
                                </div>
                            </div>
                            <!-- End of Widget -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Account</h4>
                                <ul class="widget-body">
                                    <li><a href="/users">My Account</a></li>
                                    <li><a href="/home/about-us">Our Guarantees</a></li>
                                    <li><a href="/home/terms-and-conditions">Terms And Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Site Map</a></li>
                                </ul>
                            </div>
                            <!-- End of Widget -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Get Help</h4>
                                <ul class="widget-body">
                                    <li><a href="/home/frequently-asked-questions">Shipping &amp; Delivery</a></li>
                                    <li><a href="/users">Order Status</a></li>
                                    <li><a href="/home/frequently-asked-questions">F.A.Q.</a></li>
                                    <li><a href="/home/contact-us">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- End of Widget -->
                        </div>
                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">About Us</h4>
                                <ul class="widget-body">
                                    <li><a href="/home/about-us">About Us</a></li>
                                    <li><a href="/users">Order History</a></li>
                                    <li><a href="/home/returns">Returns</a></li>
                                    <li><a href="/custom">Start Custom Order</a></li>
                                </ul>
                            </div>
                            <!-- End of Widget -->
                        </div>
                        <div class="col-xl-3 col-lg-8">
                            <div class="widget mb-4">
                                <h4 class="widget-title">Subscribe to our newsletter</h4>
                                <div class="widget-body widget-newsletter mt-1">
                                    <form action="#" class="input-wrapper input-wrapper-inline mb-5">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email address here..." required />
                                        <button class="btn btn-primary font-weight-bold" type="submit">subscribe <i
                                                class="d-icon-arrow-right"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="footer-info d-flex align-items-center justify-content-between">
                                <figure class="payment">
                                    <img src="/theme/images/demos/demo4/payment.png" alt="payment" width="135" height="24" />
                                </figure>
                                <div class="social-links">
                                    <a href="https://www.facebook.com/Kurz-Welding-Fabrication-101022675070967" target="_BLANK" class="social-link social-facebook fab fa-facebook-f"></a>
                                    <a href="https://www.etsy.com/shop/KurzMetalArt" target="_BLANK" class="social-link social-linkedin fab fa-etsy"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of FooterMiddle -->
            <div class="footer-bottom d-block text-center">
            <div class="footer-copyright text-center py-3">Website Design by
                <a target="_BLANK" style="color:mediumpurple;" href="https://pivotgrowth.io"> pivotgrowth.io</a>
            </div>
            </div>
            <!-- End of FooterBottom -->
        </footer>
        <!-- End Footer -->
    </div>

        <!-- Sticky Footer -->
    <!-- Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="/" class="sticky-link active">
            <i class="d-icon-home"></i>
            <span>Home</span>
        </a>
        <a href="/shop" class="sticky-link">
            <i class="d-icon-volume"></i>
            <span>Categories</span>
        </a>
        <a href="/wishlist" class="sticky-link">
            <i class="d-icon-heart"></i>
            <span>Wishlist</span>
        </a>
        <a href="/users" class="sticky-link">
            <i class="d-icon-user"></i>
            <span>Account</span>
        </a>
    </div>
    <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="d-icon-arrow-up"></i></a>

    <!-- MobileMenu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay">
        </div>
        <!-- End Overlay -->
        <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
        <!-- End CloseButton -->
        <div class="mobile-menu-container scrollable">
            <form action="#" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off"
                    placeholder="Search your keyword..." required />
                <button class="btn btn-search" type="submit">
                    <i class="d-icon-search"></i>
                </button>
            </form>
            <!-- End Search Form -->
            <ul class="mobile-menu mmenu-anim">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/shop">Categories</a>
                    <ul>
                        <li>
                        <?php if(count(fetchCategories()) > 0):?>
                            <?php $i=1; ?>
                            <?php foreach(fetchCategories() as $category): ?>
                   
                            <?php $cUrl = (str_replace(' ', '-', strtolower($category['cName'])));?>
                            <a href="<?php echo base_url('/'.'categories/'.$category['cId'].'/'.$cUrl); ?>"><?php echo $category['cName']; ?></a>
                            <?php endforeach;?>
                        <?php endif; ?>
                            </li></ul>
                        
                
                <li>
                    <a href="/custom">Custom Order</a>
                </li>
                <li>
                    <a href="/gallery">Gallery</a>
                </li>
                <li>
                    <a href="/home/about-us">About Us</a>
                </li>
                <li>
                    <a href="/home/contact-us">Contact</a>
                </li>

            </ul>
        </div>
    </div>

    <div class="newsletter-popup mfp-hide" id="newsletter-popup" style="background-image: url(/img/newsletter-popup.png)">
        <div class="newsletter-content">
            <h4 class="text-uppercase text-dark">Up to <span class="text-primary">20% Off</span></h4>
            <h2 class="font-weight-semi-bold">Sign up to <span>Kurz Metal Metal</span></h2>
            <p class="text-grey">Subscribe to our newsletter to receive timely updates from your favorite
                products.</p>
            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email" name="email" id="email2" placeholder="Email address here..."
                    required="">
                <button class="btn btn-dark" type="submit">SUBMIT</button>
            </form>
            <div class="form-checkbox justify-content-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                    required />
                <label for="hide-newsletter-popup">Don't show this popup again</label>
            </div>
        </div>
    </div>
    
    <!-- Plugins JS File -->
    <script src="/theme/vendor/jquery/jquery.min.js"></script>
    <script src="/theme/vendor/elevatezoom/jquery.elevatezoom.min.js"></script>
    <script src="/theme/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="/theme/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="/theme/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/theme/vendor/isotope/isotope.pkgd.min.js"></script>
    <!-- Main JS File -->
    <script src="/theme/js/main.js"></script>

   
    <script src="/js/userBPopup.js"></script>
    <script src="/js/addCart.js"></script>
    <script src="/js/charge.js"></script>


</body>
</html>