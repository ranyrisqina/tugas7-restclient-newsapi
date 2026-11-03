<?php
// 1. Konfigurasi Endpoint API
$endpoint = "https://newsapi.org/v2/top-headlines";
$country = "us";
$category = "technology";
$apiKey = "1b2dd686ca9b458cb2620d6c06f80690";

// 2. URL lengkap beserta parameternya
$url = $endpoint . "?country=" . $country . "&category=" . $category . "&apiKey=" . $apiKey;

// 3. Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Tugas7RestClient/3.0'); 
$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
    exit;
}
curl_close($ch);

// 4. Decode JSON menjadi Array PHP
$data = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSpace - Portofolio Portal Berita</title>
    
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --surface: #ffffff;
            --background: #f1f5f9;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
        }
        
        /* 1. Glassmorphism Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }
        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        /* 2. Headline / Featured Hero Section */
        .hero-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            margin-top: 2rem;
            margin-bottom: 4rem;
            background: #000;
            position: relative;
            min-height: 450px;
            display: flex;
            align-items: flex-end;
        }
        .hero-img {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.55;
            transition: transform 0.8s ease;
        }
        .hero-card:hover .hero-img {
            transform: scale(1.05);
            opacity: 0.45;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 3rem;
            color: white;
            background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0) 100%);
            width: 100%;
        }
        .hero-badge {
            background: var(--primary);
            color: white;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            display: inline-block;
        }
        .hero-title {
            font-weight: 800;
            font-size: 2.5rem;
            line-height: 1.25;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        /* 3. Modern Grid Cards */
        .news-card {
            border: none;
            border-radius: 20px;
            background: var(--surface);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            overflow: hidden;
        }
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05);
        }
        .news-card .card-img-top {
            height: 220px;
            object-fit: cover;
        }
        .source-tag {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .card-title {
            font-weight: 700;
            font-size: 1.15rem;
            line-height: 1.4;
            margin-top: 0.5rem;
            color: var(--text-main);
        }
        .btn-read {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            padding: 8px 20px;
        }
        .btn-read:hover {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* 4. Section Title */
        .section-title {
            font-weight: 800;
            font-size: 1.75rem;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        footer {
            margin-top: 5rem;
            padding: 3rem 0;
            background: white;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            color: var(--text-muted);
            font-weight: 500;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="bi bi-rocket-takeoff-fill"></i> TechSpace</a>
        <div class="d-flex align-items-center">
            <span class="badge bg-dark rounded-pill py-2 px-3 fw-semibold shadow-sm">Tugas 7: REST Client Portfolio</span>
        </div>
    </div>
</nav>

<div class="container">
    <?php
    if (isset($data['status']) && $data['status'] == 'ok' && !empty($data['articles'])) {
        
        // Filter agar berita "[Removed]" tidak masuk ke tampilan
        $valid_articles = array_filter($data['articles'], function($a) {
            return !empty($a['title']) && $a['title'] != '[Removed]';
        });
        $valid_articles = array_values($valid_articles); // Reset index array

        if (count($valid_articles) > 0) {
            
            // ==========================================
            // BAGIAN 1: ARTIKEL UTAMA (HEADLINE HERO)
            // ==========================================
            $hero = $valid_articles[0];
            $heroImg = !empty($hero['urlToImage']) ? htmlspecialchars($hero['urlToImage']) : 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200&q=80';
            $heroTitle = htmlspecialchars($hero['title']);
            $heroSource = htmlspecialchars($hero['source']['name']);
            $heroUrl = htmlspecialchars($hero['url']);
            $heroDate = date('d M Y', strtotime($hero['publishedAt']));
            
            echo '
            <div class="hero-card shadow-lg">
                <img src="'.$heroImg.'" alt="Hero Image" class="hero-img">
                <div class="hero-content">
                    <span class="hero-badge">'.$heroSource.'</span>
                    <h1 class="hero-title">'.$heroTitle.'</h1>
                    <p class="mb-4 text-light opacity-75"><i class="bi bi-clock"></i> Dipublikasikan pada '.$heroDate.'</p>
                    <a href="'.$heroUrl.'" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 fw-bold border-0 shadow" style="background-color: #4f46e5;">Baca Berita Utama <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            ';

            // ==========================================
            // BAGIAN 2: ARTIKEL LAINNYA (GRID MODERN)
            // ==========================================
            echo '<h3 class="section-title">Semua Berita Terkini</h3>';
            echo '<div class="row g-4 mb-5">';
            
            // Looping dimulai dari index 1 (karena index 0 sudah dipakai Headline)
            for ($i = 1; $i < count($valid_articles); $i++) {
                $article = $valid_articles[$i];
                $img = !empty($article['urlToImage']) ? htmlspecialchars($article['urlToImage']) : 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&q=80';
                $title = htmlspecialchars($article['title']);
                $desc = !empty($article['description']) ? htmlspecialchars($article['description']) : 'Baca isi selengkapnya langsung melalui tautan sumber artikel ini.';
                $url = htmlspecialchars($article['url']);
                $source = htmlspecialchars($article['source']['name']);
                $date = date('d M Y', strtotime($article['publishedAt']));

                echo '
                <div class="col-md-6 col-lg-4">
                    <div class="card news-card">
                        <img src="'.$img.'" class="card-img-top" alt="News Image">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="source-tag mb-2">'.$source.'</span>
                            <h5 class="card-title mb-3">'.$title.'</h5>
                            <p class="text-muted small mb-3"><i class="bi bi-calendar-event"></i> '.$date.'</p>
                            <p class="card-text text-muted flex-grow-1" style="font-size: 0.9rem;">'.substr($desc, 0, 110).'...</p>
                            <a href="'.$url.'" target="_blank" class="btn btn-read w-100 mt-3">Baca Artikel</a>
                        </div>
                    </div>
                </div>';
            }
            echo '</div>';
            
        } else {
            echo '<div class="alert alert-warning mt-5">Tidak ada berita yang valid untuk ditampilkan.</div>';
        }
    } else {
        $errMsg = isset($data['message']) ? $data['message'] : 'Kesalahan tidak diketahui.';
        echo '<div class="alert alert-danger mt-5 fw-bold"><i class="bi bi-exclamation-triangle-fill"></i> Gagal memuat berita: '.$errMsg.'</div>';
    }
    ?>
</div>

<footer>
    <div class="container">
        <p class="mb-1 text-dark fw-bold">&copy; <?php echo date("Y"); ?> TechSpace - Portofolio Tugas 7 REST Client.</p>
        <p class="small opacity-75 mb-0">Developed using PHP Native cURL & Bootstrap 5 Framework</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>