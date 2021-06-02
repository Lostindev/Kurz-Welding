</head>

<body class="home">
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="owl-carousel owl-theme row cols-xl-3 cols-md-2 cols-1 w-100" id="nav-owl" data-owl-options="{
                    'items': 3,
                    'dots': false,
                    'loop': false,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '768': {
                            'items': 2
                        },
                        '1200': {
                            'items': 3
                        }
                    }
                }">
                    <div class="icon-box icon-box-tiny text-center">
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white">
                                <i class="icon-box-icon d-icon-truck" style="font-size: 3.2rem;"></i>
                                Free Shipping on Orders Over $99
                            </h4>
                        </div>
                    </div>
                    <div class="icon-box icon-box-tiny text-center">
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white">
                            <i class="fas fa-plus-square" style="font-size: 2rem"></i>
                               &nbsp New Products Added Weekly
                            </h4>
                        </div>
                    </div>
                    <div class="icon-box icon-box-tiny text-center">
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white">
                                <i class="fas fa-user" style="font-size: 2rem"></i>
                                &nbsp 15% OFF for New Users
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle has-center sticky-header fix-top sticky-content">
                <div class="container-fluid">
                    <div class="header-left">
                        <a href="#" class="mobile-menu-toggle text-dark">
                            <i class="d-icon-bars2"></i>
                        </a>
                        <div class="dropdown currency-dropdown mt-1">
                            <a href="#currency">USD</a>
                            <ul class="dropdown-box">
                                <li><a href="#USD">USD</a></li>
                                <li><a href="#EUR">EUR</a></li>
                            </ul>
                        </div>
                        <!-- End DropDown Menu -->
                        <div class="dropdown language-dropdown mt-1">
                            <a href="#language">ENG</a>
                            <ul class="dropdown-box">
                                <li>
                                    <a href="#USD">ENG</a>
                                </li>
                                <li>
                                    <a href="#EUR">FRH</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End DropDown Menu -->
                        <div class="header-search hs-toggle search-left">
                            <a href="#" class="search-toggle d-flex align-items-center">
                                <i class="d-icon-search"></i>
                                <span class="ml-1 text-uppercase">Search</span>
                            </a>
                            <form action="#" class="input-wrapper">
                                <input type="text" class="form-control" name="search" autocomplete="off"
                                    placeholder="Search your keyword..." required />
                                <button class="btn btn-search" type="submit">
                                    <i class="d-icon-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End Header Search -->
                    </div>
                    <div class="header-center">
                        <a href="/" class="logo mr-1">
                            <img src="/img/logo.png" alt="logo"  />
                        </a>
                        <!-- End Logo -->
                    </div>
                    <div class="header-right">
                        <?php if(userLoggedIn()): ?>
                            <a class="account-link" href="/users" style=" display: flex;
                                align-items: center;
                                margin-right: 3.2rem;
                                padding-bottom: .2rem;
                                margin-top: .5rem;">
                            <i class="d-icon-user" style="font-size: 2.7rem;color:#11a3bf"></i>
                        </a>

                        <?php else:?>
                            <a class="login-link" href="/theme/ajax/login.html">
                            <i class="d-icon-user" ></i>
                            </a>
                        <?php endif; ?>


                        <!-- End Login -->
                        <a class="wishlist" href="wishlist.html">
                            <i class="d-icon-heart"></i>
                        </a>
                        <span class="divider"></span>
                        <!-- End Divider -->
                        <div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
                            <a href="#" class="cart-toggle label-block link">
                                <div class="cart-label d-lg-show">
                                    <span class="cart-name">Shopping Cart:</span>
                                    <span class="cart-price">$<?php if(isset($_SESSION['varPrice'])):?>
                                    <?php $sum = array_sum($_SESSION['varPrice']);?>
                                    <?php echo $sum.'.00'; ?>
                                    <?php else:?>
                                    <?php echo "0.00";?></span>
                                    <?php endif; ?>
                                
                                </span>
                                </div>
                                <i class="d-icon-bag"><span class="cart-count"><?php if(isset($_SESSION['varPrice'])):?>
                                    <?php echo count($_SESSION['varPrice']); ?>
                                    <?php else:?>
                                    <?php echo "0";?></span>
                                    <?php endif; ?>
                                </span></i>
                            </a>
                            <div class="cart-overlay"></div>
                            <!-- End Cart Toggle -->
                            <div class="dropdown-box">
                                <div class="cart-header">
                                    <h4 class="cart-title">Shopping Cart</h4>
                                    <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">close<i
                                            class="d-icon-arrow-right"></i><span class="sr-only">Cart</span></a>
                                </div>
                                <div class="products scrollable">
                                <?php $a = -1 ?>
								<?php if(isset($_SESSION['varPrice'])): ?>
                                <?php $cart = loadCart() ;?>
                                <?php foreach ($cart->getResult() as $row):?>
								<?php $a++ ;?>
                                    <div class="product product-cart">
                                        <figure class="product-media">
                                            <a href="product.html">
                                                <img src="<?php echo site_url('/img/products/'.$row->pDp)?>" alt="product" width="80"
                                                    height="88" />
                                            </a>
                                            <button class="btn btn-link btn-close">
                                                <i class="fas fa-times"></i><span class="sr-only">Close</span>
                                            </button>
                                        </figure>
                                        <div class="product-detail">
                                            <a href="product.html" class="product-name"><?php echo $row->pName; ?></a>
                                            <div class="price-box">
                                                <span class="product-quantity">1</span>
                                                <span class="product-price"><?php echo '$'.$_SESSION['varPrice'][$a]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Cart Product -->
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                </div>
                                <!-- End of Products  -->
                                <div class="cart-total">
                                    <label>Subtotal:</label>
                                    <span class="price">$<?php if(isset($_SESSION['varPrice'])):?>
                                        <?php echo array_sum($_SESSION['varPrice']);?>
                                    <?php else:?>
                                    <?php echo "0";?></span>
                                    <?php endif; ?>
                                </div>
                                <!-- End of Cart Total -->
                                <div class="cart-action">
                                    <a href="/shop/cart" class="btn btn-dark btn-link">View Cart</a>
                                    <a href="/shop/checkout" class="btn btn-dark"><span>Go To Checkout</span></a>
                                </div>
                                <!-- End of Cart Action -->
                            </div>
                            <!-- End Dropdown Box -->
                        </div>
                        <div class="header-search hs-toggle mobile-search">
                            <a href="#" class="search-toggle">
                                <i class="d-icon-search"></i>
                            </a>
                            <form action="#" class="input-wrapper">
                                <input type="text" class="form-control" name="search" autocomplete="off"
                                    placeholder="Search your keyword..." required />
                                <button class="btn btn-search" type="submit">
                                    <i class="d-icon-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End of Header Search -->
                    </div>
                </div>

            </div>
            <!-- End Header Middle -->

            <div class="header-bottom has-center">
                <div class="container-fluid">
                    <div class="header-left">

                    </div>
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu">
                                <li <?php echo $uri; if($uri ==""){echo 'class="active"';}?>>
                                    <a href="/">Home</a>
                                </li>
                                <li <?php if($uri =="shop"){echo 'class="active"';}?>>
                                    <a href="/shop">Shop</a>
                                    <div class="megamenu">
                                        <div class="row">
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                                                <h4 class="menu-title">Categories</h4>
                                             
                                                <?php if(count(fetchCategories()) > 0):?>
                                                    <?php $i=1; ?>
                                                    <?php foreach(fetchCategories() as $category): 
                                                        if ($i++ == 8) break;
                                                       ?>
                   
                                                <ul>
                                                    <?php $cUrl = (str_replace(' ', '-', strtolower($category['cName'])));?>
                                                    <li><a href="<?php echo base_url('/'.'categories/'.$category['cId'].'/'.$cUrl); ?>"><?php echo $category['cName']; ?></a></li>
                                                </ul>
                                                <?php endforeach;?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-4">
                                                <h4 class="menu-title"><br></h4>
                                                <?php if(count(fetchCategoriesTwo()) > 0):?>
                                                    <?php $i=1; ?>
                                                    <?php foreach(fetchCategoriesTwo() as $category): ?>
                                                    
                                                <ul>
                                                    <?php $cUrl = (str_replace(' ', '-', strtolower($category['cName'])));?>
                                                    <li> <a href="<?php echo base_url('/'.'categories/'.$category['cId'].'/'.$cUrl); ?>"><?php echo $category['cName']; ?></a></li>
                                                </ul>
                                                <?php endforeach;?>
                                                <?php endif; ?>
                                            </div>
                                            <div
                                                class="col-6 col-sm-4 col-md-3 col-lg-4 menu-banner menu-banner1 banner banner-fixed">
                                                <figure>
                                                    <img src="/theme/images/menu/banner-1.jpg" alt="Menu banner" width="221"
                                                        height="330" />
                                                </figure>
                                                <div class="banner-content y-50">
                                                    <h4 class="banner-subtitle font-weight-bold text-primary ls-m">Sale.
                                                    </h4>
                                                    <h3 class="banner-title font-weight-bold"><span
                                                            class="text-uppercase">Up to</span>70% Off</h3>
                                                    <a href="demo17-shop.html" class="btn btn-link btn-underline">shop
                                                        now<i class="d-icon-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- End Megamenu -->
                                        </div>
                                    </div>
                                </li>
                                <li <?php if($uri =="custom"){echo 'class="active"';}?>>
                                <a href="/custom">Custom Order</a>
                                </li>
                                <li <?php if($uri =="gallery"){echo 'class="active"';}?>>
                                <a href="/gallery">Gallery</a>
                                </li>
                                <li <?php if($uri2 =="about-us"){echo 'class="active"';}?>>
                                <a href="/home/about-us">About Us</a>
                                </li>
                                <li <?php if($uri2 =="contact-us"){echo 'class="active"';}?>>
                                <a href="/home/contact-us">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-right">
                    </div>
                </div>
            </div>
        </header>
         <!-- End Header -->

        <!--Check Flashdata-->
         <?php echo checkFlash(); ?>