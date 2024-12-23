<?php
/*  
Template Name: Menu page  
*/
get_header();
?>

<div class="menu">



    <div class="top-menu">
        <img class="background-image" src="<?php echo get_template_directory_uri(); ?>/imgs/bg-menu.avif" alt="Sushi Image">
        <div class="overlay"></div>
        <h1>OUR MENU 🍣</h1>
        <p>
             Plongez dans un océan de saveurs – Découvrez nos sushis frais, préparés avec passion!
        </p>
    </div>











    <!-- CATEGORY -->
    <section class="menu-categories mt-5">
        <h1>OUR <span>CATEGORIES</span></h1>
        <div class="container">
            <?php
            $args = array(
                'taxonomy'   => 'product_cat',
                'orderby'    => 'name',
                'hide_empty' => true,
            );
            $categories = get_terms($args);

            $selected_category_slug = isset($_GET['category']) ? sanitize_title($_GET['category']) : '';

            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    $product_count = isset($category->count) ? $category->count : 0;

                    $category_link = add_query_arg('category', $category->slug);

                    $is_active = ($category->slug == $selected_category_slug) ? 'active' : '';

                    echo '<div class="menu-categorie ' . esc_attr($is_active) . '">';
                    if ($image_url) {
                        echo '<a href="' . esc_url($category_link) . '">';
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                        echo '</a>';
                    }
                    echo '<a href="' . esc_url($category_link) . '">';
                    echo '<h4>' . esc_html(strtoupper($category->name)) . '</h4>';
                    echo '</a>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </section>

    <!-- PRODUCTS -->
    <section class="menu-products  mt-5">
        <?php
        $tax_query = array();
        $is_category_selected = false;

        if ($selected_category_slug !== '') {
            $selected_category = get_term_by('slug', $selected_category_slug, 'product_cat');

            if ($selected_category) {
                $is_category_selected = true;

                $tax_query[] = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $selected_category->slug,
                );

                echo '<h1>PRODUCTS IN CATEGORY: ' . esc_html($selected_category->name) . '</h1>';
            } else {
                echo '<h1>ALL PRODUCTS</h1>';
                echo '<p>Invalid category selected. Displaying all products.</p>';
            }
        } else {
            echo '<h1>OUR <span>PRODUCTS</span></h1>';
        }

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 12,
        );

        if ($is_category_selected) {
            $args['tax_query'] = $tax_query;
        }

        $loop = new WP_Query($args);

        if ($loop->have_posts()) {
            echo '<div class="swiper-container container">';
            while ($loop->have_posts()) : $loop->the_post();
                global $product; // Ensure that $product is available  
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
            echo '</div>'; // Close the container div  
        } else {
            echo '<p>No products found.</p>';
        }
        wp_reset_postdata();
        ?>
    </section>
</div>



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

<?php get_footer() ?>