<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/helpers.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | JobYaari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/style.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>

<main class="container">
    <!-- Main Heading -->
    <div style="text-align: center; margin-top: 60px;">
        <h1 style="font-size: 56px; font-weight: 900; line-height: 1.2;">If you are looking for <span style="color: var(--primary);">help</span>, you are in the <br> right <span style="color: #ffcc00;">place</span></h1>
    </div>

    <!-- Hero Cards -->
    <div class="contact-hero-grid">
        <div class="contact-card blue">
            <div class="contact-card-text">
                <h2>For Jobseekers</h2>
                <p style="font-size: 15px; opacity: 0.9; line-height: 1.6;">Got a question or need help using JobYaari? Our Student Help Center is the place to start.</p>
            </div>
            <div class="contact-card-img">
                <img src="https://cdn-icons-png.flaticon.com/512/3222/3222800.png" style="width: 140px; filter: brightness(0) invert(1);" alt="Jobseekers">
            </div>
        </div>
        <div class="contact-card yellow">
            <div class="contact-card-text">
                <h2>For Partnership</h2>
                <p style="font-size: 15px; opacity: 0.8; line-height: 1.6;">Looking to collaborate or affiliation? Connect with our business team to explore how we can grow together.</p>
            </div>
            <div class="contact-card-img">
                <img src="https://cdn-icons-png.flaticon.com/512/1534/1534938.png" style="width: 140px;" alt="Partnership">
            </div>
        </div>
    </div>

    <!-- Contact Form Box -->
    <section class="contact-form-box">
        <div>
            <h2>Contact Us</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label>Mobile No.</label>
                    <div style="display: flex; gap: 10px;">
                        <select style="width: 100px; padding: 15px; border-radius: 50px; border: none; background: #eef7ff;">
                            <option>🇮🇳 +91</option>
                        </select>
                        <input type="text" name="mobile" placeholder="Phone number" style="flex: 1;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" placeholder="How can we help?"></textarea>
                </div>
                <button type="submit" class="btn-yellow">Submit</button>
            </form>

            <div style="margin-top: 30px; display: flex; gap: 20px;">
                <a href="https://www.instagram.com/jobyaari/" style="color: white; font-size: 24px;" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.facebook.com/jobyaari/" style="color: white; font-size: 24px;" target="_blank"><i class="fab fa-facebook"></i></a>
            </div>
        </div>
        <div style="text-align: center;">
            <img src="https://cdn-icons-png.flaticon.com/512/9464/9464016.png" style="width: 100%; max-width: 450px;" alt="Support">
        </div>
    </section>

    <!-- Bottom CTA -->
    <section style="text-align: center; padding: 60px 0;">
        <h2 style="font-size: 42px; font-weight: 900; margin-bottom: 50px;">Your Government <span style="color: var(--primary);">Career Starts Here</span></h2>
        <div class="cta-boxes">
            <div class="cta-box blue-box" style="background: #eef7ff; color: #333;">
                <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="fas fa-paper-plane" style="color: var(--primary); font-size: 30px;"></i>
                </div>
                <h3 style="font-size: 24px; margin-bottom: 15px;">Never Miss a Job Alert</h3>
                <p style="font-size: 14px; margin-bottom: 25px; color: #666;">Get notified instantly when new jobs match your skills.</p>
                <a href="#" class="btn" style="background: var(--primary); color: white; border-radius: 50px; padding: 12px 50px;">Join</a>
            </div>
            <div class="cta-box whatsapp">
                <h3 style="font-size: 24px; margin-bottom: 15px;">WhatsApp</h3>
                <p style="font-size: 14px; margin-bottom: 25px;">Get daily alerts and PDF notifications instantly on your phone.</p>
                <a href="#" class="btn" style="background: white; color: #25d366; border-radius: 50px; padding: 12px 50px;">Follow</a>
            </div>
            <div class="cta-box telegram">
                <h3 style="font-size: 24px; margin-bottom: 15px;">Telegram</h3>
                <p style="font-size: 14px; margin-bottom: 25px;">Join our community for the fastest updates on your mobile device.</p>
                <a href="#" class="btn" style="background: white; color: #0088cc; border-radius: 50px; padding: 12px 50px;">Follow</a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
