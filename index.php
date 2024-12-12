<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUHA SUSHI</title>
    <!-- <link rel="stylesheet" href="/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Icon library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <?php wp_head() ?>
</head>

<body>


    <section class="section-header">
        <nav class="navbar pt-2 d-flex justify-content-center navbar-expand-lg fixed-top">
            <div class="container-fluid container">
                <a class="navbar-brand p-2" href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_aloha.png" alt="Sushi Image">
                </a>
                <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <a class="navbar-brand d-flex align-items-center gap-2" href="/aloha_sushi">
                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_aloha.png" alt="Sushi Image">
                        </a>
                        <button type="button" class="btn-close shadow-none" style="filter: invert(100%) brightness(85%);" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center gap-3 flex-grow-1">
                            <li class="nav-item">
                                <a class="nav-link <?php echo is_page('home') ? 'active' : ''; ?>" aria-current="page" href="<?php echo home_url('/'); ?>">HOME</a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link <?php echo is_page('menu') ? 'active' : ''; ?>" href="<?php echo home_url('/menu'); ?>">MENU</a>
                            </li>
                        </ul>
                        <div>
                            <button><i class="fa-solid fa-truck-fast"></i> ORDER NOW</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <div class="section-hero-container">
        <section class="section-hero">
            <div class="section-top container mb-5">
                <h1>ALOHA<span>SUSHI</span></h1>
                <div class="section-top-content">
                    <div class="section-top-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dicta ut explicabo vel quisquam molestias libero ipsa? Illum necessitatibus cumque, animi, rerum similique deleniti deserunt itaque vero dicta, voluptate pariatur.</p>
                        <!-- <button><i class="fa-solid fa-truck-fast"></i> ORDER NOW</button> -->
                    </div>
                    <div class="section-top-img">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/imgs/plate-4.png" alt="Sushi Image">
                    </div>
                    <div class="section-top-imgs">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/imgs/plate-1.jpg" alt="Sushi Image">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/imgs/plate-2.jpg" alt="Sushi Image">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/imgs/plate-3.png" alt="Sushi Image">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/imgs/plate-4.png" alt="Sushi Image">
                    </div>


                </div>
            </div>

            <div id="scroll-container">
                <div id="scroll-text">
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>

                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>

                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                </div>
            </div>

            <div id="scroll-container-bottom">

                <div id="scroll-text-bottom">
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>

                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>

                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-burger"></i>
                        <h1>FAST SHIPPING</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-pizza-slice"></i>
                        <h1>30 MINUTES</h1>
                    </div>
                    <div>
                        <i class="fa-solid fa-french-fries"></i>
                        <h1>SO HOT</h1>
                    </div>
                </div>
            </div>
        </section>
    </div>







    <!-- CATEGORY -->
    <section class="section-categories container">

        <!-- Display Categories -->
        <div class="title-top">
            <h1>OUR BEST <span>CATEGORIES</span></h1>
            <button>SEE ALL <i class="fas fa-arrow-right"></i></button>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $args = array(
                    'taxonomy'   => 'product_cat',
                    'orderby'    => 'name',
                    'hide_empty' => true,
                );
                $categories = get_terms($args);

                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        // Get category details
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = wp_get_attachment_url($thumbnail_id);
                        $product_count = isset($category->count) ? $category->count : 0;

                        // Output each category as a slide
                        echo '<div class="swiper-slide">';
                        echo '<div class="category">';
                        if ($image_url) {
                            echo '<a class="" href="' . esc_url(get_term_link($category)) . '">';
                            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                            echo '</a>';
                        }
                        echo '<a class="category-content" href="' . esc_url(get_term_link($category)) . '">';
                        echo '<h2>' . esc_html(strtoupper($category->name)) . '</h2>';
                        echo '<h4>' . esc_html($product_count) . ' products</h4>';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="bottom-arc"></div>

            <!-- Add Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

            <!-- Add Navigation (Optional) -->
            <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
        </div>

    </section>
    <!-- WHY -->
    <section class="section-why">
        <div class="wave-top"></div>
        <div class="container">
            <div class="image-container">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/img-1.png" alt="Sushi Image">
            </div>
            <div class="content">
                <h2 class="title">WHY CHOOSE <span>US</span></h2>
                <p>The mouth-watering aroma of sizzling burgers now fills the streets of Birmingham thanks to the passionate pursuit of three brothers</p>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">🏠</div>
                        <h3>A NEW LOOK ON THE RIGHT DOOR!</h3>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🥗</div>
                        <h3>THE USE OF NATURAL BEST QUALITY PRODUCTS</h3>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🚚</div>
                        <h3>FASTEST ON YOUR DOOR STEP</h3>
                    </div>
                </div>

                <button class="order-btn">ORDER NOW →</button>
            </div>
        </div>
        <div class="wave-bottom"></div>
    </section>
    <!-- PRODUCTS -->
    <section class="section-products container">
        <!-- Display Products -->
        <div class="title-top">
            <h1>OUR BEST <span> DISHES</span></h1>
            <button>SEE ALL <i class="fas fa-arrow-right"></i></button>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12,
                );
                $loop = new WP_Query($args);

                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                ?>

                        <div class="swiper-slide">
                            <div class="product">
                                <a class="a" onclick="showProductDetails('<?php echo esc_attr($product->get_id()); ?>')">
                                    <div class="product-top">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail('medium', ['class' => 'img']);
                                        } ?>
                                        <div class="product-recepies">
                                            <p>Lorem.</p>
                                            <p>Lorem.</p>
                                            <p>Lorem.</p>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h2><?php the_title(); ?></h2>
                                        <p>Lorem ipsum | dolor | sit amet | consectetur.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3><?php echo get_post_meta(get_the_ID(), '_price', true); ?>$</h3>
                                            <a href="">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-details">
                                        <ul class="product-details">
                                            <li><strong>SKU:</strong> <?php echo esc_html($product->get_sku() ?: 'N/A'); ?></li>
                                            <li><strong>Stock:</strong> <?php echo esc_html($product->is_in_stock() ? 'In Stock' : 'Out of Stock'); ?></li>
                                            <li><strong>Category:</strong>
                                                <?php
                                                $categories = wp_get_post_terms($product->get_id(), 'product_cat', ['fields' => 'names']);
                                                echo !empty($categories) ? esc_html(implode(', ', $categories)) : 'N/A';
                                                ?>
                                            </li>
                                            <li><strong>Tags:</strong>
                                                <?php
                                                $tags = wp_get_post_terms($product->get_id(), 'product_tag', ['fields' => 'names']);
                                                echo !empty($tags) ? esc_html(implode(', ', $tags)) : 'N/A';
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    endwhile;
                } else {
                    echo 'No products found.';
                }
                wp_reset_postdata();
                ?>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Add Navigation (Optional) -->
            <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
        </div>





    </section>
    <!-- PROMO -->
    <div class="promo">
        <div class="promo-img">
            <img src="<?php echo get_template_directory_uri(); ?>/imgs/bg-promo-2.png" alt="Sushi Image">
        </div>
        <div class="promo-section">
            <div class="container">
                <p>40% OFF ALL PREMIUM PIZZAS</p>
                <h1>HAPPY SUNDAY</h1>
                <a href="#" class="order-btn">ORDER NOW</a>
                <div class="promo-img-1">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/img-5.png" alt="Sushi Image">
                </div>
                <div class="promo-img-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/img-1.png" alt="Sushi Image">
                </div>
            </div>
        </div>
        <div class="promo-img products-img-rotate">
            <img src="<?php echo get_template_directory_uri(); ?>/imgs/bg-promo-2.png" alt="Sushi Image">
        </div>
    </div>
    <!-- ORDER -->
    <section class="section-order" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out">
        <a href="">
            <div class="order-img container">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/promo-bg-3.png" alt="Sushi Image">
            </div>
        </a>
    </section>
    <!-- DISHES -->
    <section class="section-products-dishes">
        <div>
            <img src="<?php echo get_template_directory_uri(); ?>/imgs/top-promo.png" alt="Sushi Image">
        </div>
        <!-- Display Products -->
        <div class="title-top container">
            <h1>OUR BEST <span>DISHES</span></h1>
            <button>SEE ALL <i class="fas fa-arrow-right"></i></button>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12,
                );
                $loop = new WP_Query($args);

                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                ?>

                        <div class="swiper-slide">
                            <div class="product">
                                <a class="a" href="<?php the_permalink(); ?>">
                                    <div class="product-top">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail('medium', ['class' => 'img']);
                                        } ?>
                                        <div class="product-recepies">
                                            <p>Lorem.</p>
                                            <p>Lorem.</p>
                                            <p>Lorem.</p>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h2><?php the_title(); ?></h2>
                                        <p>Lorem ipsum | dolor | sit amet | consectetur.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3><?php echo get_post_meta(get_the_ID(), '_price', true); ?>$</h3>
                                            <a href="">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    endwhile;
                } else {
                    echo 'No products found.';
                }
                wp_reset_postdata();
                ?>
            </div>

            <!-- Add Pagination -->
            <!-- <div class="swiper-pagination"></div> -->

            <!-- Add Navigation (Optional) -->
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->
        </div>
        <div class="products-img-rotate">
            <img src="<?php echo get_template_directory_uri(); ?>/imgs/top-promo.png" alt="Sushi Image">
        </div>
    </section>
    <!-- PROMOTION -->
    <section class="section-promo-container">
        <div class="section-promo container">
            <div class="promo-img">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/promo-1.jpg" alt="Sushi Image">
            </div>
            <div class="promo-content">
                <div class="promo-content-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/promo-bg-1.jpg" alt="Sushi Image">
                </div>
                <div class="promo-content-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/promo-bg-3.png" alt="Sushi Image">
                </div>
            </div>
        </div>
    </section>









    <section class="section-newsletter-container">
        <div class="section-newsletter container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1>JOIN FOR HOT OFFERS!</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem eveniet nesciunt fugiat itaque unde non debitis sit porro, obcaecati ex. Eius voluptate perspiciatis facilis, inventore cupiditate suscipit eum voluptates voluptas!
                </p>
            </div>
            <div>
                <form id="newsletter-form">
                    <input type="email" name="email" id="email" placeholder="Enter your adress email" required>
                    <button><i class="fa-solid fa-paper-plane me-1"></i> Subscribe</button>
                </form>
            </div>
            <img class="newsletter-img-left" src="<?php echo get_template_directory_uri(); ?>/imgs/img-2.png" alt="Sushi Image">
            <img class="newsletter-img-right" src="<?php echo get_template_directory_uri(); ?>/imgs/img-1.png" alt="Sushi Image">

        </div>
    </section>
    <section class="section-footer-container">
        <div class="section-footer container">
            <div class="section-footer-infos">
                <div>
                    <h3>ALOHA</h3>
                    <a class="" href="/aloha_sushi">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_aloha.png" alt="Sushi Image">
                    </a>
                    <h3>SUSHI</h3>
                </div>

                <ul>
                    <li><i class="fa-solid fa-angle-right"></i>Rue de la Régence 32, 4000 Liège, Belgique</li>
                    <li><i class="fa-solid fa-angle-right"></i>alohasushi@gmail.com</li>
                    <li><i class="fa-solid fa-angle-right"></i>+(32) 672453218</li>
                </ul>
            </div>
            <div>
                <h4>PRODUCTS</h4>
                <ul>
                    <li><i class="fa-solid fa-angle-right"></i>Temaki</li>
                    <li><i class="fa-solid fa-angle-right"></i>Uramaki</li>
                    <li><i class="fa-solid fa-angle-right"></i>Chirashi</li>
                    <li><i class="fa-solid fa-angle-right"></i>Sachimis</li>
                    <li><i class="fa-solid fa-angle-right"></i>baki
                    <li>
                </ul>
            </div>

            <div>
                <h4>QUICK LINKS</h4>
                <ul>
                    <li><i class="fa-solid fa-angle-right"></i>HOME</li>
                    <li><i class="fa-solid fa-angle-right"></i>MENU</li>
                </ul>
            </div>
            <div>
                <h4>OPENING HOURS</h4>
                <ul>
                    <li><i class="fa-solid fa-angle-right"></i>Monday – Friday:
                        <strong>8am – 4pm</strong>
                    </li>
                    <li><i class="fa-solid fa-angle-right"></i>Saturday:
                        <strong>08:00 – 12:00 Uhr</strong>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section-copy-right">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <p class="mt-3">
                    ©2024
                    <strong>ALOHASUSHI.</strong>
                    All Rights Reserved
                </p>
            </div>
            <div>
                <a href=""><i class="fa-brands fa-cc-visa"></i></a>
                <a href=""><i class="fa-brands fa-cc-mastercard"></i></a>
            </div>
            <div>
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </section>




    <!-- Product-details -->
    <div id="productDetailsPopup" class="product-details-popup" style="display: none;">
        <div class="product-details-content">
            <button class="close-popup" onclick="closeProductDetails()">&times;</button>
            <div id="productDetailsContent">
            </div>
        </div>
    </div>
    <script>
        <?php
        // Add these PHP variables for JavaScript use  
        $rest_url = esc_url_raw(rest_url('wc/v3/products/'));
        $consumer_key = 'ck_f5d8deff64ccc2b212ac0bccbef080cf01d83dcf';
        $consumer_secret = 'cs_43aaddf2a71885419fac899add730358422d23df';
        ?>

        function showProductDetails(productId) {
            const popup = document.getElementById('productDetailsPopup');
            const content = document.getElementById('productDetailsContent');

            content.innerHTML = '<p>Loading...</p>';
            popup.style.display = 'block';

            // Using WooCommerce REST API with authentication  
            fetch(`<?php echo $rest_url; ?>${productId}`, {
                    headers: {
                        'Authorization': 'Basic ' + btoa('<?php echo $consumer_key; ?>:<?php echo $consumer_secret; ?>')
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(product => {
                    const imageSrc = product.images && product.images.length > 0 ? product.images[0].src : '';
                    const imageAlt = product.name || 'Product Image';

                    content.innerHTML = `  
            <div class="product-popup-content">  
                <h2>${product.name}</h2>  
                <img src="${imageSrc}" alt="${imageAlt}">  
                <div class="product-description">${product.description}</div>  
                <div class="product-price">  
                    <strong>Price:</strong> ${product.sale_price}  
                </div>  
                <div class="product-meta">
                    <p><strong>Categories:</strong> ${product.categories.map(cat => cat.name).join(', ')}</p>
                </div>  
                <button class="add-to-cart-btn" onclick="addToCart(${product.id})">Add to Cart</button>  
            </div>  
        `;
                })
                .catch(error => {
                    content.innerHTML = '<p>Error loading product details. Please try again.</p>';
                    console.error('Error:', error);
                });
        }

        function closeProductDetails() {
            document.getElementById('productDetailsPopup').style.display = 'none';
        }

        function addToCart(productId) {
            // Add your add to cart functionality here  
            window.location.href = `/?add-to-cart=${productId}`;
        }
    </script>






























    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const slider = document.querySelector(".slider");
            const categories = document.querySelectorAll(".category");
            const prevBtn = document.querySelector(".prev-btn");
            const nextBtn = document.querySelector(".next-btn");

            if (!slider || !categories.length || !prevBtn || !nextBtn) {
                return;
            }

            let currentIndex = 0;

            const updateSliderPosition = () => {
                const categoryWidth = categories[0].clientWidth;
                slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            };

            const loopSlider = () => {
                if (currentIndex === categories.length) {
                    currentIndex = 0;
                } else if (currentIndex < 0) {
                    currentIndex = categories.length - 1;
                }
                updateSliderPosition();
            };


            nextBtn.addEventListener("click", () => {
                currentIndex++;
                loopSlider();
            });

            prevBtn.addEventListener("click", () => {
                currentIndex--;
                loopSlider();
            });

            const autoplay = true;
            const interval = 3000;

            if (autoplay) {
                setInterval(() => {
                    currentIndex++;
                    loopSlider();
                }, interval);
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const swiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                },
                speed: 5000,
                slidesPerView: 'auto',
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        // slidesPerView: 1,
                        spaceBetween: 30,
                    },
                    800: {
                        // slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1000: {
                        // slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1224: {
                        // slidesPerView: 4,
                        spaceBetween: 30,
                    }
                }
            });
        });
    </script>


    <script>
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const responseDiv = document.getElementById('newsletter-response');

            fetch(newsletterAjax.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'subscribe_newsletter',
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        responseDiv.innerHTML = `<p style="color: green;">${data.data.message}</p>`;
                    } else {
                        responseDiv.innerHTML = `<p style="color: red;">${data.data.message}</p>`;
                    }
                })
                .catch(error => {
                    responseDiv.innerHTML = `<p style="color: red;">An error occurred. Please try again later.</p>`;
                });
        });
    </script>
    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- AOS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>