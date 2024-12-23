<?php
/* Template Name: Contact Page */
get_header();
?>



<section class="contact-container">
    <div class="contact container">
        <section class="contact-info">
            <div class="contact-images">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/contact.png" alt="Sushi Chef at Work">
            </div>
        </section>

        <section class="contact-form">

            <h2>SEND US A <span>MESSAGE</span></h2>
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <input type="hidden" name="action" value="contact_form_submission">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
            <div class="contact-content">
                <h2>Get in <span>Touch</span></h2>
                <ul>
                    <li><i class="fa fa-map-marker-alt"></i> <strong>Rue de la Régence 32, 4000 Liège, Belgique</strong></li>
                    <li><i class="fa fa-phone-alt"></i> <strong>+(32) 672453218</strong> </li>
                    <li><i class="fa fa-envelope"></i><strong>alohasushi@gmail.com</strong>  </li>
                    <li><i class="fa fa-clock"></i> <strong>Mon-Sun: 11:00 AM - 10:00 PM</strong> </li>
                </ul>
            </div>
        </section>
    </div>

</section>

<!-- Map -->
<section class="map-container container">
    <h2>FIND US <span>HERE</span></h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2530.1941582115296!2d5.572415511778313!3d50.64208517151106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c0fbee0ca2d2d1%3A0xe32e77e918f2042!2sAloha%20Sushi!5e0!3m2!1sfr!2sbe!4v1734953620141!5m2!1sfr!2sbe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<?php get_footer(); ?>