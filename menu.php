<?php
/*  
Template Name: Aloha Menu  
*/
get_header();
?>
<div class="menu">
    
    <!-- <div class="top-menu">
        <img class="background-image" src="<?php echo get_template_directory_uri(); ?>/imgs/bg-menu.avif" alt="Sushi Image">
        <div class="overlay"></div>
        <h1>OUR MENU 🍣</h1>
        <p>
            Plongez dans un océan de saveurs – Découvrez nos sushis frais, préparés avec passion!
        </p>
        
    </div> -->


    <!-- CATEGORY -->
    <section class="menu-categories container">
        <!-- <h1>OUR <span>MENU 🍣</span></h1> -->
        <div class="container">
            <?php
            $args = array(
                'taxonomy'   => 'product_cat',
                'orderby'    => 'name',
                'hide_empty' => true,
            );
            $categories = get_terms($args);

            // Get the current active category from URL fragment  
            $current_category = isset($_GET['category']) ? sanitize_title($_GET['category']) : '';

            // Add "Top Ventes" as the first category  
            $is_top_active = ($current_category === 'top-ventes') ? 'active' : '';
            echo '<div class="menu-categorie ' . esc_attr($is_top_active) . '">';
            echo '<a href="#category-top-ventes" data-category="top-ventes">';
            echo '<img src="' . get_template_directory_uri() . '/imgs/plate-1.jpg" alt="Plate 1">';
            echo '<h4>Top Ventes</h4>';
            echo '</a>';
            echo '</div>';

            if (!empty($categories)) {
                foreach ($categories as $category) {
                    // Get category details  
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    $is_active = ($category->slug === $current_category) ? 'active' : '';

                    // Output each category  
                    echo '<div class="menu-categorie ' . esc_attr($is_active) . '">';
                    echo '<a href="#category-' . esc_attr($category->term_id) . '" data-category="' . esc_attr($category->slug) . '">';
                    if ($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                    }
                    echo '<h4>' . esc_html(strtoupper($category->name)) . '</h4>';
                    echo '</a>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </section>

    <!-- PRODUCTS -->
    <section class="menu-products container mb-5">
        <!-- Top Ventes Section -->
        <div id="category-top-ventes" class="category-section">
            <h2>Top Ventes</h2>
            <div class="products-container">
                <?php
                $top_ventes_args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => 'top-ventes',
                        ),
                    ),
                );

                $top_ventes_loop = new WP_Query($top_ventes_args);

                if ($top_ventes_loop->have_posts()) {
                    while ($top_ventes_loop->have_posts()) : $top_ventes_loop->the_post();
                        global $product;
                ?>
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
                            </a>
                            <div class="product-content">
                                <h2><?php the_title(); ?></h2>
                                <p>Lorem ipsum | dolor | sit amet | consectetur.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3><?php echo get_post_meta(get_the_ID(), '_price', true); ?>€</h3>
                                    <i onclick="addToCart(productId)" class="fa-solid fa-cart-shopping"></i>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                } else {
                    echo '<p>No products found in Top Ventes.</p>';
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <!-- Other Categories -->
        <?php
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'term_id',
                            'terms'    => $category->term_id,
                        ),
                    ),
                );

                $loop = new WP_Query($args);

                if ($loop->have_posts()) {
                    // Category section with ID for scrolling
                    echo '<div id="category-' . esc_attr($category->term_id) . '" class="category-section">';
                    echo '<h2>' . esc_html($category->name) . ' (' . $loop->found_posts . ')</h2>';
                    // echo '<div class="wave-bottom"></div>';
                    echo '<div class="products-container">';

                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
        ?>
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
                            </a>
                            <div class="product-content">
                                <h4><?php the_title(); ?></h4>
                                <p>Lorem ipsum | dolor | sit amet | consectetur.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3><?php echo get_post_meta(get_the_ID(), '_price', true); ?>€</h3>
                                    <i onclick="addToCart(productId)" class="fa-solid fa-cart-shopping"></i>
                                </div>
                            </div>
                        </div>
        <?php
                    endwhile;

                    echo '</div>'; // Close products-container
                    echo '</div>'; // Close category-section
                }

                wp_reset_postdata();
            }
        } else {
            echo '<p>No categories found.</p>';
        }
        ?>
    </section>

    <!-- Smooth Scrolling -->
    <script>
        document.querySelectorAll('.menu-categorie a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

    <!-- ACTIVE CATEGORY -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all category links  
            const categoryLinks = document.querySelectorAll('.menu-categorie a');

            // Add click event listener to each link  
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all categories  
                    document.querySelectorAll('.menu-categorie').forEach(cat => {
                        cat.classList.remove('active');
                    });

                    // Add active class to clicked category  
                    this.parentElement.classList.add('active');

                    // Smooth scroll to the section  
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    document.querySelector(targetId).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>

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

            content.innerHTML = '<div class="product-details-loading"><p class="loader"></p></div>';
            popup.style.display = 'flex';

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
                        <div>
                            <img src="${imageSrc}" alt="${imageAlt}"> 
                        </div>
                        <div> 
                            <div class="product-details-content-top">
                                <h2>${product.name}</h2>  
                                <div class="quantity-controls">
                                    <button onclick="decreaseQuantity()">-</button>
                                    <input type="number" id="productQuantity" value="0" min="0">
                                    <button onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                            
                            <div class="product-meta">
                                <p><strong>Categories:</strong> ${product.categories.map(cat => cat.name).join(', ')}</p>
                                <div class="product-description">${product.description}</div>
                            </div> 
                        </div> 
                        
                        <div class="product-details-buy">
                            <div class="product-price">  
                                <strong>${product.sale_price}€</strong>   
                            </div> 
                            <i class="fa-solid fa-cart-shopping add-to-cart-btn" onclick="addToCart(${product.id})"></i>
                        </div>
                        
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
            const quantity = document.getElementById('productQuantity');
            quantity.value = parseInt(quantity.value) + 1;
            // window.location.href = `/?add-to-cart=${productId}&quantity=${quantity}`;
        }

        function increaseQuantity() {
            const quantityInput = document.getElementById('productQuantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('productQuantity');
            if (quantityInput.value > 0) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
    </script>


</div>


<?php get_footer() ?>