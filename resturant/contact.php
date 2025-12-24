<?php include('partials-front/menu.php')?>

<!-- Contact Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Get in Touch With Us</h2>
    </div>
</section>

<section class="contact">
    <div class="container">
        <h2 class="text-center">Contact Us</h2>

        <form action="#" class="order">
            <fieldset>
                <legend>Send us a Message</legend>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Shrabani Mishra" class="input-responsive"
                    required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. shrabani@example.com" class="input-responsive"
                    required>

                <div class="order-label">Phone</div>
                <input type="tel" name="phone" placeholder="E.g. +91 9876543210" class="input-responsive">

                <div class="order-label">Message</div>
                <textarea name="message" rows="6" placeholder="Write your message here..." class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
            </fieldset>
        </form>

        <div class="contact-info text-center" style="margin-top: 40px;">
            <h3>Our Location</h3>
            <p>📍 Kolkata, West Bengal
            <p>📞 +91 98765 43210</p>
            <p>✉️ contact@shrabanimishra.com</p>
        </div>
    </div>
</section>
<!-- Contact Section Ends Here -->

<?php include('partials-front/footer.php');