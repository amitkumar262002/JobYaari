<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/helpers.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | JobYaari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/css/style.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../templates/header.php'; ?>

<main class="container">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>About <span>Jobyaari</span></h1>
            <p style="font-size: 18px; color: #666; margin-bottom: 20px; line-height: 1.8;">
                Jobyaari is a government job discovery platform designed to simplify the job search process for aspirants across India.
            </p>
            <p style="font-size: 18px; color: #666; line-height: 1.8;">
                We provide accurate, verified, and up-to-date government job notifications in one place. With smart filters and easy navigation, Jobyaari helps candidates quickly find the right government job based on their qualification, category, and preferences.
            </p>
            <div class="feature-stats">
                <div class="stat-box blue">
                    <h2 style="font-size: 32px; font-weight: 900;">50k+</h2>
                    <p style="font-size: 14px; font-weight: 700;">aspirants</p>
                    <p style="font-size: 12px; margin-top: 10px; opacity: 0.8;">Over 50,000 job aspirants trust JobYaari.</p>
                </div>
                <div class="stat-box light">
                    <div style="width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h2 style="font-size: 24px; font-weight: 900;">Alerts</h2>
                    <p style="font-size: 12px; margin-top: 10px;">Get verified government job notifications updated daily.</p>
                </div>
                <div class="stat-box light">
                    <h2 style="font-size: 32px; font-weight: 900;">#01</h2>
                    <p style="font-size: 12px; margin-top: 10px;">India's 1st Job searching portal with lots of filter.</p>
                </div>
            </div>
        </div>
        <div class="about-hero-image">
            <img src="https://img.freepik.com/free-photo/portrait-successful-smiling-business-woman-suit-working-it-modern-office-standing-near-window-with-laptop_1262-18451.jpg" style="width: 100%; border-radius: 30px; position: relative; z-index: 1;" alt="About Jobyaari">
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-grid">
        <div style="text-align: center;">
            <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" style="width: 300px;" alt="Mission">
        </div>
        <div>
            <h2 style="font-size: 36px; font-weight: 900; margin-bottom: 40px;">Our <span>Mission</span></h2>
            <div class="mission-points">
                <div class="mission-item">
                    <h4>Empower Every Job Aspirant</h4>
                    <p style="font-size: 14px; color: #666;">We aim to support government job aspirants by providing accurate, timely information.</p>
                </div>
                <div class="mission-item">
                    <h4>Equal Career Opportunities</h4>
                    <p style="font-size: 14px; color: #666;">Jobyaari is committed to bridging the information gap for all backgrounds.</p>
                </div>
                <div class="mission-item">
                    <h4>Trusted Job Information</h4>
                    <p style="font-size: 14px; color: #666;">Our mission is to ensure every job notification comes from reliable sources.</p>
                </div>
                <div class="mission-item">
                    <h4>Simplify the Job Search</h4>
                    <p style="font-size: 14px; color: #666;">We work to reduce confusion by organizing complex details into user-friendly formats.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose -->
    <section style="padding: 80px 0; background: #f8fbff; border-radius: 50px; margin: 50px 0;">
        <h2 style="text-align: center; font-size: 36px; font-weight: 900; margin-bottom: 50px;">Why Choose <span>Jobyaari</span></h2>
        <div class="why-grid">
            <div class="why-card">
                <i class="fas fa-check-circle"></i>
                <h4 style="margin-bottom: 15px;">Verified & Reliable Information</h4>
                <p style="font-size: 14px; color: #666;">We publish government job notifications only after verifying from official sources.</p>
            </div>
            <div class="why-card">
                <i class="fas fa-clock"></i>
                <h4 style="margin-bottom: 15px;">Timely Updates</h4>
                <p style="font-size: 14px; color: #666;">Stay ahead with daily updates on government jobs, exams, admit cards, and results.</p>
            </div>
            <div class="why-card">
                <i class="fas fa-code"></i>
                <h4 style="margin-bottom: 15px;">User-Friendly Platform</h4>
                <p style="font-size: 14px; color: #666;">Smart filters help you quickly find relevant government jobs based on your needs.</p>
            </div>
            <div class="why-card">
                <i class="fas fa-briefcase"></i>
                <h4 style="margin-bottom: 15px;">Built for India's Job Aspirants</h4>
                <p style="font-size: 14px; color: #666;">Jobyaari is designed keeping real aspirants in mind—simple, fast, and accessible.</p>
            </div>
        </div>
    </section>

    <!-- CTA Boxes -->
    <section style="text-align: center; padding: 60px 0;">
        <h2 style="font-size: 42px; font-weight: 900; margin-bottom: 50px;">Your Government <span>Career Starts Here</span></h2>
        <div class="cta-boxes">
            <div class="cta-box blue-box">
                <h3 style="font-size: 24px; margin-bottom: 15px;">Never Miss a Job Alert</h3>
                <p style="font-size: 14px; margin-bottom: 25px;">Get notified instantly when new jobs that match your skills are posted.</p>
                <a href="#" class="btn" style="background: white; color: var(--primary); border-radius: 50px; padding: 12px 50px;">Join</a>
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
