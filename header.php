<!-- header.php -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
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

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- AOS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded and parsed');
            var elements = document.querySelectorAll('[data-aos]');
            console.log('AOS elements found:', elements.length);

            AOS.init();
        });
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Header Content -->
    <header>
        <section class="section-header">
            <nav class="navbar pt-2 d-flex justify-content-center navbar-expand-lg">
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
                                <li class="nav-item">
                                    <a class="nav-link <?php echo is_page('contact') ? 'active' : ''; ?>" href="<?php echo home_url('/contact'); ?>">CONTACT</a>
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
    </header>