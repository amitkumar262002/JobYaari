<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- About -->
            <div class="footer-col">
                <a href="<?= base_url('public/index.php') ?>" class="brand" style="margin-bottom: 20px;">
                    <span>JY</span> JobYaari
                </a>
                <h3 style="margin-top: 20px;">About Us</h3>
                <p>We provide latest job notifications, internships, admit cards, exam alerts, and results to help students and job seekers stay updated.</p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/jobyaari/" class="fb" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/jobyaari/" class="ig" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/jobyaari/" class="li" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.youtube.com/@jobyaari" class="yt" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="<?= base_url('public/listing.php?type=job') ?>">Latest Jobs</a></li>
                    <li><a href="<?= base_url('public/listing.php?type=admit_card') ?>">Admit Cards</a></li>
                    <li><a href="<?= base_url('public/listing.php?type=result') ?>">Exam Results</a></li>
                    <li><a href="<?= base_url('public/listing.php?type=job') ?>">Government Jobs</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="footer-col">
                <h3>Support</h3>
                <ul class="footer-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Apps -->
            <div class="footer-col">
                <h3>Launching soon!</h3>
                <p>Stay Tuned!</p>
                <div class="app-btns">
                    <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play"></a>
                    <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" alt="App Store"></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> JobYaari. All Rights Reserved. | Made with <i class="fas fa-heart" style="color: red;"></i> in India</p>
        </div>
    </div>
</footer>
