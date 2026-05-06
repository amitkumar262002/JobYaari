<header class="site-header">
    <div class="container nav-wrap">
        <a href="<?= base_url('public/index.php') ?>" class="brand">
            <span>JY</span> JobYaari
        </a>

        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>

        <nav id="mainNav">
            <a href="<?= base_url('public/index.php') ?>">Home</a>
            <div class="nav-item">
                <a href="<?= base_url('public/listing.php?type=job') ?>" style="display: flex; align-items: center; gap: 5px;">
                    Jobs <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <div class="mega-menu">
                    <div class="mega-col">
                        <h4>Pre-Graduate</h4>
                        <ul>
                            <li><a href="#">10th</a></li>
                            <li><a href="#">12th</a></li>
                            <li><a href="#">ITI</a></li>
                            <li><a href="#">Polytechnic</a></li>
                        </ul>
                    </div>
                    <div class="mega-col">
                        <h4>Graduate</h4>
                        <ul>
                            <li><a href="#">Any Graduate</a></li>
                            <li><a href="#">Engineering</a></li>
                            <li><a href="#">Science</a></li>
                            <li><a href="#">Arts</a></li>
                            <li><a href="#">Commerce</a></li>
                        </ul>
                    </div>
                    <div class="mega-col">
                        <h4>Post-Graduate</h4>
                        <ul>
                            <li><a href="#">Any Post-Graduate</a></li>
                            <li><a href="#">Engineering</a></li>
                            <li><a href="#">Science</a></li>
                            <li><a href="#">Arts</a></li>
                            <li><a href="#">Commerce</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('public/listing.php?type=admit_card') ?>">Admit Card</a>
            <a href="<?= base_url('public/listing.php?type=result') ?>">Result</a>
            <a href="<?= base_url('public/about.php') ?>">About</a>
            <a href="<?= base_url('public/listing.php?type=blog') ?>">Blogs</a>
            <a href="<?= base_url('public/contact.php') ?>">Contact</a>
        </nav>

        <div class="header-right">
            <a href="https://wa.me/910000000000" target="_blank" style="color: #25d366; font-size: 32px;"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</header>