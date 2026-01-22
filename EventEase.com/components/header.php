<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EventEase - Premium Event Organizer di Pekanbaru. Mewujudkan pernikahan, acara korporat, dan pesta mewah.">
    <title>EventEase | Premium Event Organizer Pekanbaru</title>
    
    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="assets/js/script.js" defer></script>
</head>
<body>

    <div id="loader" style="position:fixed; width:100%; height:100%; background:#050505; z-index:999999; display:flex; flex-direction:column; justify-content:center; align-items:center;">
        <div style="overflow:hidden;">
            <h2 id="loader-text" style="letter-spacing:15px; font-weight:300; color:#fff; margin-bottom:10px; transform:translateY(100%); transition: 0.8s ease;">
                EVENT<span style="font-weight:800; background: var(--silver-metallic); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">EASE</span>
            </h2>
        </div>
        <div style="width:100px; height:1px; background:rgba(255,255,255,0.1); position:relative; overflow:hidden;">
            <div id="loader-bar" style="position:absolute; width:0%; height:100%; background:var(--silver-primary); transition: 1.5s ease;"></div>
        </div>
    </div>

    <nav id="navbar">
        <div class="container">
            <a href="index.php" class="logo">
                EVENT<span>EASE</span>
            </a>
            
            <ul class="nav-links">
                <?php $current = basename($_SERVER['PHP_SELF']); ?>
                <li><a href="index.php" class="<?= $current == 'index.php' ? 'active' : '' ?>">HOME</a></li>
                <li><a href="service.php" class="<?= ($current == 'service.php' || $current == 'services.php') ? 'active' : '' ?>">SERVICES</a></li>
                <li><a href="venues.php" class="<?= $current == 'venues.php' ? 'active' : '' ?>">VENUES</a></li>
                <li><a href="contact.php" class="<?= $current == 'contact.php' ? 'active' : '' ?>">CONTACT</a></li>
            </ul>

            <div class="mobile-toggle" id="mobile-menu-btn">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>

        <div class="mobile-nav" id="mobile-nav">
            <a href="index.php">HOME</a>
            <a href="service.php">SERVICES</a>
            <a href="venues.php">VENUES</a>
            <a href="contact.php">CONTACT</a>
        </div>
    </nav>

    <div class="nav-overlay" id="nav-overlay"></div>

    <style>
    /* Styling Tambahan untuk Header & Navigasi */
    .nav-links a.active {
        color: var(--silver-primary) !important;
        opacity: 1 !important;
        font-weight: 700;
    }

    .mobile-toggle {
        display: none;
        cursor: pointer;
        z-index: 10000;
    }

    .mobile-toggle .bar {
        width: 25px;
        height: 2px;
        background-color: #fff;
        margin: 5px 0;
        transition: 0.4s;
    }

    .mobile-nav {
        position: fixed;
        top: 0;
        right: -100%;
        width: 75%;
        height: 100vh;
        background: #0c0c0c;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        z-index: 9998;
        border-left: 1px solid rgba(255,255,255,0.05);
    }

    .mobile-nav.active {
        right: 0;
    }

    .mobile-nav a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        letter-spacing: 5px;
        margin: 20px 0;
        font-weight: 700;
        transition: 0.3s;
    }

    .mobile-nav a:hover {
        color: var(--silver-primary);
    }

    .nav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0,0,0,0.8);
        display: none;
        z-index: 9997;
        backdrop-filter: blur(5px);
    }

    .nav-overlay.active {
        display: block;
    }

    @media (max-width: 768px) {
        .nav-links { display: none; }
        .mobile-toggle { display: block; }
    }
    </style>