<?php include 'header.php'; ?>
<?php
// Pagination variables
$toursPerPage = 6;
$tourData = [
    // This is where your tour data would be fetched from a database in a real application.
    // For this example, we'll use a placeholder to calculate total pages.
    'newZealand' => ['title' => 'Lawatan Kerja ke New Zealand'],
    'newYork' => ['title' => 'Lawatan ke New York'],
    'korea' => ['title' => 'Lawatan Korporat ke Korea'],
    'jakarta' => ['title' => 'Lawatan Bandar Jakarta'],
    'japan' => ['title' => 'Jelajahi Jepun'],
    'barbados' => ['title' => 'Lawatan Korporat ke Barbados'],
    'shanghai' => ['title' => 'Lawatan Kerja Rasmi ke Shanghai'],
    'germany' => ['title' => 'Lawatan Korporat ke Germany-Netherlands'],
    'sabah' => ['title' => 'Terokai Sabah Yang Liar'],
    'sarawak' => ['title' => 'Penemuan Budaya Sarawak'],
    'bintan' => ['title' => 'Lawatan Korporat ke Bintan'],
    'thailand' => ['title' => 'Lawatan Penerokaan Thailand'],
    'turki' => ['title' => 'Lawatan ke Istanbul, Turki'],
    'umrah' => ['title' => 'Perjalanan Umrah'],
    'vietnam' => ['title' => 'Perjalanan Budaya Vietnam']
];

$totalTours = count($tourData);
$totalPages = ceil($totalTours / $toursPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($currentPage - 1) * $toursPerPage;

$currentTours = array_slice(array_keys($tourData), $start, $toursPerPage);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tours | Qaid Travel</title>
    <link rel="stylesheet" href="style.css" />
<style>
    /* New styling for the header to use the image as a background */
        header {
            /* Menggunakan imej yang betul sebagai latar belakang */
            background-image: url('images/QAIDHEADER.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative; /* Needed for the overlay */
            padding-top: 150px; /* Menambah ruang di bahagian atas untuk logo */
            
        }
        
        /* Create a semi-transparent overlay for better text readability */
        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2); /* Menjadikan overlay lebih cerah */
            z-index: 1;

        }

        /* Ensure all content is on top of the overlay */
        .logo-box, .welcome-box, nav {
            position: relative;
            z-index: 2;
        }

        .logo-box {
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang putih dengan sedikit ketelusan */
            border: 2px solid #b41b1b; /* Border merah */
            border-radius: 10px; /* Rounded corners */
            position: absolute; /* Tetapkan posisi logo secara mutlak */
            top: 20px; /* Jarak dari atas */
            left: 50%;
            transform: translateX(-50%); /* Pusatkan logo */
        }

        .logo-box img {
            width: auto;
            height: 100px; /* Adjust height as needed */
            transform: translateY(8%);
        }

        .welcome-box {
            /* Mengubah gaya untuk membuat kotak putih */
            background-color: rgba(255, 255, 255, 0.9); /* Latar belakang putih dengan sedikit ketelusan */
            border: 2px solid #b41b1b; /* Border merah */
            border-radius: 10px; /* Rounded corners */
            padding: 20px;
            margin: 20px auto; /* Pusatkan kotak */
            max-width: 50%; /* Lebar maksimum */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .welcome-box h1 {
            font-size: 2.5rem;
            margin: 0;
            color: #b41b1b; /* Warna teks merah */
            text-shadow: none; /* Buang text-shadow */
        }

        .welcome-box p {
            font-size: 1rem;
            margin: 5px 0 0;
            color: #b41b1b; /* Warna teks merah */
            text-shadow: none; /* Buang text-shadow */
        }

        /* Navigation styling with a box background */
        nav {
            background-color: rgba(180, 27, 27, 0.9); /* Warna latar belakang navigasi yang sesuai */
            border: 2px solid #b41b1b; /* Border merah yang sama dengan welcome box */
            border-radius: 10px; /* Rounded corners */
            padding: 10px 0;
            margin: 20px auto;
            max-width: 80%; /* Lebar maksimum */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
        }

        

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .welcome-box h1 {
                font-size: 1.8rem;
            }
            .welcome-box p {
                font-size: 1rem;
            }
            nav ul {
                flex-direction: column;
                gap: 10px;
            }
            header {
                padding-top: 100px; /* Menyesuaikan padding untuk peranti mudah alih */
            }
            .logo-box {
                top: 10px;
            }
        }
    /* Existing CSS from your file */
    body {
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #cb4646; /* Keeping the light grey background from previous step */
    }

    .tour-list {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: flex-start; /* Ensures cards are aligned to the left */
        flex-grow: 1;
    }

    .tour-card {
        flex-basis: calc(33.333% - 20px);
        /* Preferred width for 3 cards per row */
        flex-grow: 0;
        /* Changed from 1 to 0: Prevents cards from growing and filling extra space */
        flex-shrink: 0;
        /* Prevents cards from shrinking */
        max-width: 350px;
        /* Caps the maximum width of a single card, adjust as needed */
        background-color: #fff;
        /* Keeping cards white as they are content containers */
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
        cursor: pointer;
    }

    .tours-container {
        display: flex;
        padding: 40px;
        gap: 30px;
        max-width: 1200px; /* Sets the maximum width of the main content area */
        margin: auto;
        align-items: flex-start;
    }

    .filter-panel {
        flex-shrink: 0;
        /* Prevents the filter panel from shrinking */
        width: 320px;
        /* Fixed width for the filter box */
        padding: 25px;
        border: 2px solid #ddd;
        border-radius: 10px;
        background-color: #fafafa;
        box-sizing: border-box;
    }

    .filter-panel h3 {
        margin-top: 0;
        color: #b62626;
    }

    .filter-group {
        margin-bottom: 20px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 10px;
    }

    .filter-group #searchFilter { /* Targeting the search input itself */
        padding: 8px 12px;
        font-size: 1rem;
        border-radius: 5px;
        border: 2px solid #b62626; /* Matches your select border color */
        background-color: #fff;
        color: #333; /* Color of the text typed inside the search box */
        width: 92%;
        /* Changed to 100% for responsiveness */
        max-width: 100%;
        /* Ensure it's responsive */
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .search-btn {
        background-color: #b62626;
        /* Matches your primary red color */
        color: #fff;
        padding: 10px 15px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-left: 10px;
        /* Space from the input field */
    }

    .search-btn:hover {
        background-color: #7c1919;
        /* Darker red on hover */
        transform: scale(1.02);
    }

    /* Responsive adjustments for the filter group with the button */
    @media (max-width: 768px) {
        .filter-group {
            flex-direction: column;
            /* Stack label, input, and button on small screens */
            align-items: flex-start;
            gap: 5px;
        }

        .filter-group .search-btn {
            margin-top: 10px;
            /* Space from input when stacked */
            margin-left: 0;
            /* Remove left margin when stacked */
            width: 100%;
            /* Full width button on small screens */
        }
    }

    .filter-group #searchFilter:focus {
        outline: none;
        border-color: #5d0c0c;
        box-shadow: 0 0 5px rgba(182, 38, 38, 0.5);
    }

    /* Specific styling for the search input's LABEL */
    label[for="searchFilter"] {
        color: #333;
        /* Changed to dark color for readability */
    }

    /* Responsive adjustments for the search filter */
    @media (max-width: 768px) {
        .filter-group {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        .filter-group #searchFilter {
            width: 100%;
        }
    }

    @media (max-width: 900px) {
        .tours-container {
            flex-direction: column;
            /* Stack filter and tour list on smaller screens */
            align-items: center;
        }
        .filter-panel {
            width: 100%;
            /* Make filter panel full width */
            margin-bottom: 30px;
        }
        .tour-card {
            flex-basis: calc(50% - 20px);
            /* For screens up to 900px, display 2 cards per row */
            max-width: 450px;
            /* Adjust max-width for single card in 2-column layout */
        }
    }

    @media (max-width: 600px) {
        .tour-card {
            flex-basis: 100%;
            /* For screens up to 600px, display 1 card per row */
            max-width: unset;
            /* Remove max-width when card should take full available width */
        }
    }

    .tour-card:hover {
        transform: translateY(-5px);
    }

    .tour-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .tour-card .info {
        padding: 15px;
    }

    .tour-card h4 {
        color: #b62626;
        margin: 0 0 10px;
    }

    .tour-card p {
        font-size: 0.9rem;
        color: #555;
    }

    .show-all-btn {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #b62626;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-align: center;
    }

    .show-all-btn:hover {
        background-color: #8e1d1d;
    }

    .filter-group label[for="searchFilter"] {
        color: white !important;
    }

    .filter-group select {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        box-sizing: border-box;
        border-radius: 6px;
        border: 1px solid #ccc;
        min-width: 100%;
    }

    .filter-group select,
    .filter-group input[type="checkbox"] {
        margin-right: 8px;
    }

    /* --- Modal Styles --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        max-width: 800px;
        width: 90%;
        max-height: 90vh; /* Limit height to viewport */
        overflow-y: auto;
        /* Enable scrolling for long content */
        position: relative;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-content {
        transform: translateY(0);
    }

    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 1.8rem;
        cursor: pointer;
        color: #888;
    }

    .modal-close-btn:hover {
        color: #333;
    }

    .modal-content h3 {
        color: #b62626;
        margin-top: 0;
        font-size: 1.8rem;
    }

    .modal-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .modal-package-list li {
        margin-bottom: 8px;
        line-height: 1.5;
        list-style: disc; /* Or your preferred list style */
        margin-left: 20px;
    }
    .modal-package-list strong {
        color: #b62626;
        /* Highlight package points */
    }

    /* Updated Gallery Styles */
    .modal-gallery {
        display: flex;
        /* Changed to flexbox */
        flex-direction: column;
        /* Stack items vertically */
        gap: 20px;
        /* Increased gap between items */
        margin-top: 20px;
    }
    
    /* Styles for the new gallery item structure */
    .modal-gallery-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        /* Increased padding */
        box-shadow: 0 1px 5px rgba(0,0,0,0.05);
    }
    .modal-gallery-item img {
        width: auto;
        /* Allow image to scale */
        max-width: 100%;
        /* Ensure image doesn't overflow container */
        height: auto;
        /* Allow image to scale */
        max-height: 300px;
        /* Set a max height for larger display */
        object-fit: contain;
        /* Ensure image is fully visible without cropping */
        border-radius: 5px;
        margin-bottom: 10px;
        /* Increased margin */
    }
    .modal-gallery-item .name {
        font-weight: bold;
        color: #333;
        font-size: 1.1em; /* Slightly larger font */
        margin-bottom: 5px;
    }
    .modal-gallery-item .description {
        font-size: 0.9em;
        /* Slightly larger font */
        color: #666;
    }

    /* --- Pagination Styles (Copied from tours.php and adjusted) --- */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
        padding: 10px;
        background-color: transparent;
        border-radius: 8px;
        box-shadow: none;
        /* Removed shadow for a cleaner look */
    }

    .pagination a {
        color: #333;
        /* Darker text color */
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
        border-radius: 5px;
        margin: 0 5px;
        font-weight: bold;
        border: 1px solid #ddd;
        /* Added a subtle border */
    }

    .pagination a.active {
        background-color: #b62626;
        color: white;
        border-color: #b62626; /* Match border color to background */
    }

    .pagination a:hover:not(.active) {
        background-color: #f0f0f0;
        /* Light grey hover background */
        color: #b62626;
        /* Red text on hover */
    }

    .pagination a.disabled {
        color: #ccc;
        pointer-events: none; /* Disable clicking */
        cursor: default;
        background-color: #f9f9f9;
        border-color: #eee;
    }

    .center-text {
        text-align: center;
        color:#b62626;
    }

    /* Hero Slider Styles */
.hero-slider-container {
    position: relative;
    max-width: 100%;
    overflow: hidden;
    margin-bottom: 40px; /* Space below the slider */
}

.hero-slide {
    display: none;
    height: 500px;
    /* Adjust height as needed */
    background-size: cover;
    background-position: center;
    position: relative;
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    animation: fadeEffect 1.5s; /* Fade in animation */
}

.hero-slide.active {
    display: block;
}

.hero-caption {
    position: absolute;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    width: 80%;
}

.hero-caption h2 {
    font-size: 3rem;
    margin-bottom: 10px;
}

.hero-caption p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: auto;
}

/* Navigation arrows */
.hero-prev, .hero-next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
    background-color: rgba(0,0,0,0.5);
}

.hero-next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.hero-prev:hover, .hero-next:hover {
    background-color: rgba(0,0,0,0.8);
}

/* Dots */
.hero-dots {
    text-align: center;
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

.dot {
    cursor: pointer;
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: rgba(255,255,255,0.5);
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
}

.active-dot, .dot:hover {
    background-color: #ffffff;
}

/* Animations */
@keyframes fadeEffect {
  from {opacity: 0.4}
  to {opacity: 1}
}

/* Mobile responsive styles */
@media (max-width: 768px) {
  .hero-slide {
    height: 300px;
  }
  .hero-caption h2 {
    font-size: 2rem;
  }
  .hero-caption p {
    font-size: 1rem;
  }
}

 .modal-gallery {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 20px;
    }
    .gallery-location-section {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.05);
    }
    .gallery-location-section h5 {
        margin-top: 0;
        font-size: 1.2em;
        color: #007bff;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 5px;
    }
    .gallery-images-container {
        display: flex;
        overflow-x: auto;
        gap: 10px;
        padding-top: 10px;
    }
    .gallery-images-container img {
        max-height: 200px;
        /* Adjust as needed */
        width: auto;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .gallery-images-container img:hover {
        transform: scale(1.05);
    }
</style>
</head>
<body>
<section class="popular-destination">
<h1 class="center-text"><strong>LAWATAN KHAS KORPORAT</strong></h1>
</section>

<div class="filter-group">
    <h3><label for="searchFilter">Cari Destinasi:</label></h3>
<input type="text" id="searchFilter" placeholder="Sila cari destinasi yang anda ingin lawati..." />
<button id="searchButton" class="search-btn">Cari</button> <div id="noResultsMessage" style="display: none; text-align: center; color: #333; margin-top: 20px; font-weight: bold;">
    Tiada destinasi ditemui untuk carian anda.
</div>
</div>

<div class="tours-container">
    <div class="filter-panel">
        <h3>Filter</h3>
        <div class="filter-group">
            <label for="destination">Destinasi</label>
            <select id="destination">
                <option value="">Semua Destinasi</option>
            </select>
        </div>

        <div class="filter-group">
            <h4>Topik</h4>
            <label><input type="checkbox" value="Culture"> Budaya & Warisan</label>
            <label><input type="checkbox" value="Nature"> Alam Semula Jadi & Pengembaraan</label>
            <label><input type="checkbox" value="Food"> Makanan & Minuman</label>
            <label><input type="checkbox" value="Island"> Pulau & Pantai</label>
        </div>

        <button class="show-all-btn" onclick="resetFilters()">Tunjuk Semua</button>
    </div>

    <div style="display: flex; flex-direction: column; flex-grow: 1;">
        <div class="tour-list" id="tourList">
            <div class="tour-card" data-id="newZealand" data-destination="New Zealand" data-topics="Island,Nature">
                <img src="images/NewZealand.jpg" alt="New Zealand"/>
                <div class="info">
                    <h4>Lawatan Kerja ke New Zealand</h4>
                    <p>Lawatan bersama Majlis Perbandaran Alor Gajah (MPAG)</p>
                </div>
            </div>
            <div class="tour-card" data-id="newYork" data-destination="New York" data-topics="Food,Culture">
                <img src="images/NewYork.jpeg" alt="New York"/>
                <div class="info">
                    <h4>Lawatan ke New York</h4>
                    <p>Lawatan bersama Perbadanan Ketua Negeri Melaka (CMI) dan Jabatan Kerja Raya Negeri Melaka (JKR)</p>
                </div>
            </div>
            <div class="tour-card" data-id="korea" data-destination="Korea" data-topics="Culture,Food">
                <img src="images/Korea1.jpg" alt="Korea"/>
                <div class="info">
                    <h4>Lawatan Korporat ke Korea</h4>
                    <p>Lawatan bersama Perbadanan Ketua Negeri Melaka (CMI).</p>
                </div>
            </div>
            <div class="tour-card" data-id="jakarta" data-destination="Jakarta" data-topics="Culture,Nature">
                <img src="images/Jakarta.jpg" alt="Jakarta"/>
                <div class="info">
                    <h4>Lawatan Bandar Jakarta</h4>
                    <p>Terokai budaya Jakarta yang bersemangat, mercu tanda, dan tarikan mesra halal.</p>
                </div>
            </div>
            <div class="tour-card" data-id="japan" data-destination="Japan" data-topics="Food,Culture">
                <img src="images/Japan.jpg" alt="Japan"/>
                <div class="info">
                    <h4>Jelajahi Jepun</h4>
                    <p>Lawatan bersama Perbadanan Ketua Negeri Melaka (CMI)</p>
                </div>
            </div>
            <div class="tour-card" data-id="barbados" data-destination="Barbados" data-topics="Culture,Nature">
                <img src="images/barbados.jpg" alt="Barbados"/>
                <div class="info">
                    <h4>Lawatan Korporat ke Barbados</h4>
                    <p>Lawatan bersama Unit Dewan dan MMKN Melaka</p>
                </div>
            </div>
            <div class="tour-card" data-id="shanghai" data-destination="Shanghai" data-topics="Culture,Nature">
                <img src="images/Shanghai.jpg" alt="Shanghai"/>
                <div class="info">
                    <h4>Lawatan Kerja Rasmi ke Shanghai Sempena Autoshow Shanghai 2025</h4>
                    <p>Lawatan bersama Perbadanan Melaka (MCORP)</p>
                </div>
            </div>
            <div class="tour-card" data-id="germany" data-destination="Germany" data-topics="Island,Nature">
                <img src="images/Germany.jpg" alt="Germany"/>
                <div class="info">
                    <h4>Lawatan Korporat ke Germany-Netherlands</h4>
                    <p>Lawatan bersama Melaka ICT Holdings, Perbadanan Muzium Melaka dan Putra Specialist Hospital</p>
                </div>
            </div>
            <div class="tour-card" data-id="sabah" data-destination="Sabah" data-topics="Nature,Culture">
                <img src="images/Sabah.jpg" alt="Sabah"/>
                <div class="info">
                    <h4>Terokai Sabah Yang Liar</h4>
                    <p>Jelajahi hutan hujan, gunung-ganang dan warisan budaya yang kaya di Sabah.</p>
                </div>
            </div>
            <div class="tour-card" data-id="sarawak" data-destination="Sarawak" data-topics="Nature,Culture">
                <img src="images/Sarawak.jpg" alt="Sarawak"/>
                <div class="info">
                    <h4>Penemuan Budaya Sarawak</h4>
                    <p>Temui budaya asli dan keajaiban semula jadi Sarawak.</p>
                </div>
            </div>
            <div class="tour-card" data-id="bintan" data-destination="Bintan" data-topics="Island,Nature">
                <img src="images/Bintan.jpg" alt="Bintan"/>
                <div class="info">
                    <h4>Lawatan Korporat ke Bintan</h4>
                    <p>Lawatan bersama Majlis Pengetua Sekolah Malaysia (Cawangan Melaka)</p>
                </div>
            </div>
            <div class="tour-card" data-id="thailand" data-destination="Thailand" data-topics="Food,Culture">
                <img src="images/Thailand.jpg" alt="Thailand"/>
                <div class="info">
                    <h4>Lawatan Penerokaan Thailand</h4>
                    <p>Nikmati pasar yang sibuk, percutian pulau
                        dan masakan mesra halal di Bangkok, Phuket, dan sekitarnya.</p>
                </div>
            </div>
            <div class="tour-card" data-id="turki" data-destination="Turki" data-topics="Culture,Food">
                <img src="images/Istanbul.jpg" alt="Turki"/>
                <div class="info">
                    <h4>Lawatan ke Istanbul, Turki</h4>
                    <p>Alami keindahan sejarah dan budaya Islam di Istanbul.</p>
                </div>
            </div>
            <div class="tour-card" data-id="umrah" data-destination="Umrah" data-topics="Culture">
                <img src="images/Umrah.jpg" alt="Umrah"/>
                <div class="info">
                    <h4>Perjalanan Umrah</h4>
                    <p>Pakej Umrah lengkap dengan bimbingan keagamaan.</p>
                </div>
            </div>
            <div class="tour-card" data-id="vietnam" data-destination="Vietnam" data-topics="Nature,Food,Culture">
                <img src="images/Vietnam.jpg" alt="Vietnam"/>
                <div class="info">
                    <h4>Perjalanan Budaya Vietnam</h4>
                    <p>Temui warisan kaya Vietnam, pemandangan indah dan pengalaman mesra halal
                        di seluruh Hanoi dan Ho Chi Minh City.</p>
                </div>
            </div>
        </div>
        <div class="pagination" id="pagination"></div>
    </div>
</div>

<div class="modal-overlay" id="tourDetailModal">
    <div class="modal-content">
        <button class="modal-close-btn">&times;</button>
        <img src="" alt="Imej Pelancongan" class="modal-image" id="modalTourImage">
        <h3 id="modalTourTitle"></h3>
        <p id="modalTourIntro"></p>
        
        <h4>Pakej yang Kami Sediakan:</h4>
        <ul id="modalPackageList" class="modal-package-list">
        </ul>

        <h4>Galeri:</h4>
        <div id="modalGallery" class="modal-gallery">
            </div>

        <div class="show-all-container" style="margin-top: 30px;">
            <a href="contact.php" class="show-all-btn" id="modalInquireBtn">Inquire About This Tour</a>
        </div>
    </div>
</div>

<script>
    const destinationFilter = document.getElementById('destination');
    const topicCheckboxes = document.querySelectorAll('.filter-group input[type="checkbox"]');
    const allTourCards = document.querySelectorAll('.tour-card');
    const paginationContainer = document.getElementById('pagination');
    // Modal Elements
    const tourDetailModal = document.getElementById('tourDetailModal');
    const modalCloseBtn = tourDetailModal.querySelector('.modal-close-btn');
    const modalTourImage = document.getElementById('modalTourImage');
    const modalTourTitle = document.getElementById('modalTourTitle');
    const modalTourIntro = document.getElementById('modalTourIntro');
    const modalPackageList = document.getElementById('modalPackageList');
    const modalGallery = document.getElementById('modalGallery');
    const modalInquireBtn = document.getElementById('modalInquireBtn');
    const searchFilter = document.getElementById('searchFilter');
    const searchButton = document.getElementById('searchButton');
    const noResultsMessage = document.getElementById('noResultsMessage');
    // Pagination variables
    const toursPerPage = 6;
    let currentPage = 1;
    let filteredTourCards = [];
    
    // 🌟 Define detailed tour data here 🌟
    // This can be fetched from a database in a more complex setup
    const tourData = {
        umrah: {
            title: "Perjalanan Umrah",
            intro: "Mulakan perjalanan rohani yang diberkati ke Tanah Suci dengan pakej Umrah komprehensif Qaid Travel yang direka untuk keselesaan dan ketenangan fikiran.",
            image: "images/Umrah.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di lokasi berdekatan Masjidil Haram (Makkah) dan Masjid Nabawi (Madinah)",
                "<strong>Lawatan penuh ke tempat bersejarah</strong> di Mekah seperti Jabal Nur, Jabal Thur, Arafah, Muzdalifah, Mina, Ja'ranah dan Hudaibiyah.",
                "<strong>Lawatan penuh ke tempat bersejarah</strong> di Madinah seperti Masjid Quba', Jabal Uhud, Masjid Qiblatain dan Ladang Kurma.",
                "<strong>Makanan</strong> yang sedap dan menyelerakan sepanjang perjalanan",
                "<strong>Pemandu pelancong berpengalaman</strong> yang akan menemani sepanjang perjalanan (Mutawwif & Mutawwifah)",
                "Kursus Umrah Intensif (sebelum keberangkatan)",
                "Bimbingan Ibadah sepanjang Umrah",
                "Troli bagasi, beg sandang, beg silang dan buku panduan Umrah"
            ],
            gallery: [
                {
                    name: "Masjid Quba",
                    images: [
                        { src: "images/umrah_gallery/masjidQuba.jpg", description: "Masjid pertama yang dibina oleh Nabi Muhammad (SAW)." }
                    ]
                },
                {
                    name: "Madinah",
                    images: [
                        { src: "images/umrah_gallery/madinah.png", description: "Kota yang diterangi dengan tapak suci kedua dalam Islam." }
                    ]
                },
                {
                    name: "Jabal Rahmah",
                    images: [
                        { src: "images/umrah_gallery/JabalRahmah.jpg", description: "Gunung Rahmat di Arafah dan tapak khutbah terakhir Nabi Muhammad." }
                    ]
                },
                {
                    name: "Masjid Nabawi",
                    images: [
                        { src: "images/umrah_gallery/masjidNabawi.jpg", description: "Masjid Nabi di Madinah serta mengandungi makam Nabi Muhammad." }
                    ]
                },
            ]
        },
        japan: {
            title: "Jelajahi Jepun: Lawatan Bunga Sakura dan Budaya",
            intro: "Selami gabungan mempesona budaya tradisional dan keajaiban moden Jepun dengan tumpuan khas pada pengalaman mesra Muslim.",
            image: "images/Japan.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel mesra Muslim terpilih",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Kyoto, Osaka dan Kobe.",
                "<strong>Makanan</strong> yang disahkan atau ramah Muslim",
                "<strong>Pemandu pelancong berpengalaman</strong> yang mesra Muslim",
                "Pengangkutan awam yang efisien (termasuk Shinkansen/Kereta api laju)"
            ],
            gallery: [
                {
                    name: "Kobe Harborland - Kobe",
                    images: [
                        { src: "images/japan_gallery/Kobe.png", description: "Kawasan pelabuhan moden dengan pemandangan malam yang menakjubkan, pusat beli-belah dan tempat santai tepi laut." }
                    ]
                },
                {
                    name: "Kuil Kinkaku-ji - Kyoto",
                    images: [
                        { src: "images/japan_gallery/KyotoTemple.jpg", description: "Pavilion Emas dan kuil Buddha Zen yang menakjubkan." }
                    ]
                },
                {
                    name: "Universal Studio Japan - Osaka",
                    images: [
                        { src: "images/japan_gallery/universal.jpg", description: "Taman tema popular dengan tarikan filem terkenal, pertunjukan langsung dan pengalaman hiburan untuk semua peringkat umur." }
                    ]
                },
                {
                    name: "Hutan Buluh Arashiyama - Kyoto",
                    images: [
                        { src: "images/japan_gallery/Arashiyama.jpg", description: "Hutan buluh yang tenang serta keajaiban alam." }
                    ]
                }
            ]
        },
        shanghai: {
            title: "Lawatan Korporat ke Shanghai: Autoshow 2025",
            intro: "Alami pameran automotif antarabangsa terbesar sambil meneroka inovasi dan teknologi terkini di Shanghai.",
            image: "images/Shanghai.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel bertaraf antarabangsa",
                "<strong>Akses ke Shanghai Autoshow 2025</strong> termasuk pameran teknologi dan forum industri",
                "<strong>Lawatan ke tempat menarik</strong> seperti The Bund, Oriental Pearl Tower dan kawasan membeli-belah Nanjing Road",
                "<strong>Makanan</strong>"
                ],
            gallery: [
                {
                    name: "Pulau Nami",
                    images: [
                        { src: "images/shanghai_gallery/NamiIsland.jpg", description: "Sebuah pulau berbentuk separuh bulan yang indah yang terkenal dengan keindahan semula jadi." }
                    ]
                },
                {
                    name: "Menara N Seoul",
                    images: [
                        { src: "images/shanghai_gallery/SeoulTower.jpg", description: "Mercu tanda ikonik yang menawarkan pemandangan panorama Seoul." }
                    ]
                },
                {
                    name: "Istana Gyeongbokgung",
                    images: [
                        { src: "images/shanghai_gallery/Gyeongbokgung.jpg", description: "Istana terbesar dari Lima Istana Besar yang dibina semasa Dinasti Joseon." }
                    ]
                },
                {
                    name: "Masakan Halal Korea",
                    images: [
                        { src: "images/shanghai_gallery/KoreanFood.jpg", description: "Menikmati hidangan halal yang lazat dan pelbagai di Korea." }
                    ]
                },
            ]
        },
        turki: {
            title: "Melancong ke Turki: Di Mana Timur Bertemu Barat",
            intro: "Terokai landskap megah dan keajaiban purba Turki, sebuah negara yang kaya dengan sejarah Islam dan keindahan yang memukau.",
            image: "images/Turki.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotel berkualiti",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Istanbul (Hagia Sophia, Masjid Biru, Istana Topkapi), Cappadocia (Belon Udara Panas pilihan), Pamukkale, Ephesus dan Bursa.",
                "<strong>Makanan</strong> tempatan yang otentik",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                {
                    name: "Cappadocia",
                    images: [
                        { src: "images/turki_gallery/Cappadocia.jpg", description: "Terkenal dengan formasi batuan 'cerobong pari-pari' yang unik dan menaiki belon udara panas." }
                    ]
                },
                {
                    name: "Hagia Sophia (Istanbul)",
                    images: [
                        { src: "images/turki_gallery/HagiaSophia.jpg", description: "Keajaiban seni bina yang hebat dan asal gereja." }
                    ]
                },
                {
                    name: "Masjid Biru (Istanbul)",
                    images: [
                        { src: "images/turki_gallery/BlueMosque.jpg", description: "Terkenal dengan jubin biru yang menakjubkan dan enam menara." }
                    ]
                },
                {
                    name: "Pamukkale",
                    images: [
                        { src: "images/turki_gallery/Pamukkale.jpg", description: "Teres air panas yang kaya dengan mineral putih." }
                    ]
                },
            ]
        },
        jakartaBandung: {
            title: "Lawatan Menarik ke Jakarta & Bandung",
            intro: "Alami keunikan gabungan kota metropolitan Jakarta dan suasana tenang Bandung yang penuh dengan sejarah, budaya tempatan dan tarikan mesra Muslim termasuk tempat membeli-belah dan keindahan alam semula jadi.",
            image: "images/Jakarta.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pilihan di Jakarta & Bandung",
                "<strong>Lawatan ke mercu tanda utama</strong> seperti Monumen Nasional (Monas), Masjid Istiqlal, Kota Tua Jakarta, Gedung Sate dan Kawah Putih",
                "<strong>Aktiviti membeli-belah</strong> di pusat fesyen seperti Pasar Baru, Cihampelas dan Factory Outlet Bandung",
                "<strong>Makanan</strong> tempatan dan halal disediakan",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                {
                    name: "Monas (Monumen Nasional)",
                    images: [
                        { src: "images/jakarta_gallery/Monas.jpg", description: "Simbol ikonik kemerdekaan Indonesia yang terletak di pusat Jakarta." }
                    ]
                },
                {
                    name: "Masjid Istiqlal",
                    images: [
                        { src: "images/jakarta_gallery/IstiqlalMosque.jpeg", description: "Masjid terbesar di Asia Tenggara yang menjadi kebanggaan umat Islam di Indonesia." }
                    ]
                },
                {
                    name: "Kawah Putih",
                    images: [
                        { src: "images/jakarta_gallery/KawahPutih.jpg", description: "Tasik kawah berwarna putih kehijauan yang menakjubkan di puncak gunung Bandung." }
                    ]
                },
                {
                    name: "Farmhouse Lembang",
                    images: [
                        { src: "images/jakarta_gallery/Farmhouse.jpg", description: "Tarikan keluarga dengan suasana desa Eropah serta haiwan jinak dan spot bergambar menarik." }
                    ]
                }
            ]
        },
        vietnam: {
            title: "Perjalanan Budaya & Pemandangan Vietnam",
            intro: "Temui sejarah yang kaya dengan budaya bersemangat dan keindahan alam semula jadi Vietnam yang memukau. Jadual perjalanan yang merangkumi hidangan dan pengalaman mesra Muslim.",
            image: "images/Vietnam.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotel selesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Hanoi (Kawasan Lama, Tasik Hoan Kiem), Teluk Halong (pelayaran) dan Ho Chi Minh City (Terowong Cu Chi, Pasar Ben Thanh).",
                "<strong>Makanan</strong> tempatan yang otentik",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                {
                    name: "Teluk Halong",
                    images: [
                        { src: "images/vietnam_gallery/HalongBay.jpg", description: "Tapak Warisan Dunia UNESCO yang terkenal dengan air zamrud dan pulau-pulau batu kapur yang menjulang tinggi." }
                    ]
                },
                {
                    name: "Kawasan Lama Hanoi",
                    images: [
                        { src: "images/vietnam_gallery/HanoiOldQuarter.jpg", description: "Jantung bersejarah Hanoi yang sibuk dengan pasar dan jalan-jalan purba." }
                    ]
                },
                {
                    name: "Pasar Ben Thanh (Ho Chi Minh)",
                    images: [
                        { src: "images/vietnam_gallery/BenThanhMarket.jpg", description: "Pasar yang meriah menawarkan barangan tempatan dan makanan jalanan." }
                    ]
                },
                {
                    name: "Terowong Cu Chi",
                    images: [
                        { src: "images/vietnam_gallery/CuChiTunnels.jpg", description: "Rangkaian bawah tanah yang rumit yang digunakan semasa Perang Vietnam." }
                    ]
                },
            ]
        },
        thailand: {
            title: "Lawatan Penerokaan Thailand: Kuil & Pulau Tropika",
            intro: "Terokai pelbagai keajaiban Thailand dari jalan-jalan Bangkok yang sibuk hingga keindahan tenang pulaunya.",
            image: "images/Thailand.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotel berkualiti",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Bangkok (Grand Palace, pasar terapung), Phuket (pantai, pulau) dan Chiang Mai (kuil, gajah).",
                "<strong>Makanan</strong> yang mudah didapati dan sedap",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                {
                    name: "Wat Arun (Bangkok)",
                    images: [
                        { src: "images/thailand_gallery/BangkokTemple.jpg", description: "Kuil Fajar dan kuil tepi sungai yang menakjubkan." }
                    ]
                },
                {
                    name: "Pantai Phuket",
                    images: [
                        { src: "images/thailand_gallery/PhuketBeach.jpeg", description: "Nikmati pantai yang indah dan perairan biru kehijauan." }
                    ]
                },
                {
                    name: "Pasar Terapung",
                    images: [
                        { src: "images/thailand_gallery/FloatMarket.jpg", description: "Alami perdagangan tradisional Thailand di atas air." }
                    ]
                },
                {
                    name: "Chiang Mai",
                    images: [
                        { src: "images/thailand_gallery/ChiangMai.jpg", description: "Terokai kuil-kuil purba dan tempat perlindungan gajah." }
                    ]
                },
            ]
        },
        england: {
            title: "Lawatan Warisan London & UK",
            intro: "Temui mercu tanda ikonik dan sejarah kaya London dan sekitarnya. Menawarkan perjalanan budaya dengan pilihan untuk hidangan yang bersesuaian.",
            image: "images/London.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pusat bandar",
                "<strong>Lawatan penuh ke tempat menarik</strong> di London (Big Ben, Tower Bridge, Muzium British, Istana Buckingham) dan pilihan ke bandar lain seperti Manchester atau Edinburgh.",
                "Pilihan <strong>restoran</strong> yang pelbagai",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan awam (kereta api, bas) dan pengangkutan persendirian untuk lawatan tertentu"
            ],
            gallery: [
                {
                    name: "Big Ben",
                    images: [
                        { src: "images/london_gallery/BigBen.jpg", description: "Menara jam ikonik di sebelah Bangunan Parlimen." }
                    ]
                },
                {
                    name: "Tower Bridge",
                    images: [
                        { src: "images/london_gallery/TowerBridge.jpg", description: "Jambatan mercu tanda terkenal di atas Sungai Thames." }
                    ]
                },
                {
                    name: "Istana Buckingham",
                    images: [
                        { src: "images/london_gallery/BuckinghamPalace.jpg", description: "Kediaman rasmi Raja United Kingdom." }
                    ]
                },
                {
                    name: "London Eye",
                    images: [
                        { src: "images/london_gallery/LondonEye.jpg", description: "Roda Ferris gergasi di South Bank Sungai Thames." }
                    ]
                },
            ]
        },
        batam: {
            title: "Percutian Pulau Batam",
            intro: "Temui pulau Batam yang meriah dan terkenal dengan pantai-pantai indah, membeli-belah bebas cukai dan hiburan.",
            image: "images/Batam.jpeg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di resort atau hotel pilihan",
                "<strong>Lawatan bandar</strong> termasuk Nagoya Hill dan Enggal Batam",
                "<strong>Makanan</strong> tempatan yang lazat",
                "Pengangkutan disediakan"
            ],
            gallery: [
                {
                    name: "Pantai dan Pesisir Nongsa",
                    images: [
                        { src: "images/batam_gallery/BatamBeach.jpg", description: "Bersantai di pantai berpasir Batam." }
                    ]
                },
                {
                    name: "Pusat Beli-belah Nagoya Hill",
                    images: [
                        { src: "images/batam_gallery/NagoyaHillShoppingMall.jpg", description: "Nikmati membeli-belah bebas cukai dan hiburan." }
                    ]
                },
                {
                    name: "Jambatan Barelang",
                    images: [
                        { src: "images/batam_gallery/barelang.jpg", description: "Ikon terkenal di Batam yang menghubungkan beberapa pulau utama dan menawarkan pemandangan indah terutama saat matahari terbenam." }
                    ]
                }
            ]
        },
        bintan: {
            title: "Percutian Tanjung Pinang & Bintan",
            intro: "Alami keindahan tenang pantai-pantai bersih Bintan dan daya tarikan bersejarah Tanjung Pinang, Indonesia.",
            image: "images/bintan1.jpg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di resort disediakan",
                "<strong>Lawatan tempat bersejarah</strong> seperti candi 1000 patung",
                "<strong>Makanan</strong> yang lazat dan pelbagai",
                "Pengangkutan disediakan"
            ],
            gallery: [
                {
                    name: "Pantai Bintan",
                    images: [
                        { src: "images/tanjungPinang_gallery/BintanBeach.jpg", description: "Pantai berpasir putih dan air jernih." }
                    ]
                },
                {
                    name: "Candi 1000 Patung",
                    images: [
                        { src: "images/tanjungPinang_gallery/1000statues.jpeg", description: "Kuil unik yang mengandungi beribu-ribu patung yang melambangkan kebudayaan." }
                    ]
                },
                {
                    name: "Pasar Tanjung Pinang",
                    images: [
                        { src: "images/tanjungPinang_gallery/tanjungPinangMarket.jpg", description: "Terokai suasana pasar tempatan dan beli-belah." }
                    ]
                },
                {
                    name: "Pulau Penyengat",
                    images: [
                        { src: "images/tanjungPinang_gallery/penyengatIsland.jpg", description: "Pulau bersejarah dengan masjid dan makam diraja." }
                    ]
                }
            ]
        },
        sarawak: {
            title: "Penemuan Budaya Sarawak",
            intro: "Temui budaya asli dan keajaiban semula jadi Sarawak.",
            image: "images/Sarawak.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel selesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Kampung Budaya Sarawak, Taman Negara Bako, dan Muzium Kucing",
                "<strong>Makanan</strong> tradisional Sarawak",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian"
            ],
            gallery: [
                {
                    name: "Kampung Budaya Sarawak",
                    images: [
                        { src: "images/sarawak_gallery/SarawakCulturalVillage.jpg", description: "Muzium hidup yang mempamerkan pelbagai budaya etnik Sarawak." }
                    ]
                },
                {
                    name: "Taman Negara Bako",
                    images: [
                        { src: "images/sarawak_gallery/BakoNationalPark.jpeg", description: "Taman negara tertua di Sarawak, terkenal dengan pelbagai hidupan liar." }
                    ]
                },
                {
                    name: "Sungai Sarawak",
                    images: [
                        { src: "images/sarawak_gallery/SarawakRiver.jpg", description: "Perjalanan bot menyusuri sungai Sarawak, melihat buaya." }
                    ]
                },
            ]
        },
        sabah: {
            title: "Terokai Sabah Yang Liar",
            intro: "Jelajahi hutan hujan, gunung-ganang dan warisan budaya yang kaya di Sabah.",
            image: "images/Sabah.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel selesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Taman Negara Kinabalu, Pulau Sapi, dan Pasar Malam Kota Kinabalu",
                "<strong>Makanan</strong> tempatan Sabah",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian"
            ],
            gallery: [
                {
                    name: "Taman Negara Kinabalu",
                    images: [
                        { src: "images/sabah_gallery/MountKinabalu.jpg", description: "Tapak Warisan Dunia UNESCO dengan Gunung Kinabalu sebagai tarikan utama." }
                    ]
                },
                {
                    name: "Pulau Sapi",
                    images: [
                        { src: "images/sabah_gallery/SapiIsland.jpg", description: "Pulau yang terkenal dengan aktiviti snorkeling, menyelam, dan pantai berpasir putih." }
                    ]
                },
                {
                    name: "Pasar Malam Kota Kinabalu",
                    images: [
                        { src: "images/sabah_gallery/KKNightMarket.jpg", description: "Pasar yang meriah, menawarkan makanan laut segar dan hidangan tempatan." }
                    ]
                },
            ]
        },
       korea: {
            intro: "Alami gabungan unik sejarah, budaya dan inovasi moden di Korea Selatan. Lawatan ini menawarkan pakej yang komprehensif untuk menerokai bandar-bandar yang dinamik dan landskap yang tenang, sambil menikmati pengalaman mesra halal.",
            image: "images/Korea1.jpg",
            packages: [
                "<strong>Pengangkutan</strong> pergi balik dari Malaysia",
                "<strong>Penginapan</strong> di hotel pilihan",
                "<strong>Lawatan ke tempat-tempat menarik</strong> seperti Gyeongbokgung Palace, Namsan Seoul Tower dan Myeongdong",
                "<strong>Makanan</strong> tempatan dan halal",
                "Pemandu pelancong berpengalaman"
            ],
            gallery: [
                {
                    name: "Istana Gyeongbokgung",
                    images: [
                        { src: "images/koreaC_gallery/istana1.jpg", description: "" },
                        { src: "images/koreaC_gallery/istana.jpg", description: "" },
                        { src: "images/koreaC_gallery/istana2.jpg", description: "" },
                        { src: "images/koreaC_gallery/istana3.jpg", description: "" }
                    ]
                },
                {
                    name: "Pulau Nami",
                    images: [
                        { src: "images/koreaC_gallery/nami.jpg", description: "" }
                    ]
                },
                {
                    name: "Menara Namsan",
                    images: [
                        { src: "images/koreaC_gallery/namsan.jpg", description: "" }
                    ]
                }
            ]
        },

       newZealand: {
            title: "Lawatan Kerja ke New Zealand",
            intro: "Alami landskap New Zealand yang menakjubkan dan kenali budaya uniknya. Pakej lawatan kerja korporat ini dirancang untuk inspirasi dan pembangunan pasukan.",
            image: "images/NewZealand.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pilihan",
                "<strong>Lawatan kerja</strong> ke pelbagai agensi dan syarikat",
                "<strong>Aktiviti membina pasukan</strong> dan sesi motivasi",
                "Pengangkutan persendirian",
                "<strong>Makanan</strong> tempatan dan halal"
            ],
            gallery: [
                {
                    name: "Sky Tower",
                    location_description: "Menara ikonik di Auckland, menawarkan pemandangan panorama bandar",
                    images: [
                        { src: "images/newzealandC_gallery/sky.jpg", description: "" },
                        { src: "images/newzealandC_gallery/sky1.jpg", description: "" },
                        { src: "images/newzealandC_gallery/sky2.jpg", description: "" },
                        { src: "images/newzealandC_gallery/sky3.jpg", description: "" }
                    ]
                },
                {
                    name: "Hobbiton Village",
                    images: [
                        { src: "images/newzealandC_gallery/hob.jpg", description: "Ibu negara New Zealand dengan pemandangan pelabuhan yang indah dan persekitaran yang berbukit." },
                        { src: "images/newzealandC_gallery/hob1.jpg", description: "Pemandangan bandar Wellington dari atas." },
                        { src: "images/newzealandC_gallery/hob2.jpg", description: "Pemandangan bandar Wellington dari atas." },
                        { src: "images/newzealandC_gallery/hob3.jpg", description: "Pemandangan bandar Wellington dari atas." }
                    ]
                },
                {
                    name: "Auckland Harbour",
                    images: [
                        { src: "images/newzealandC_gallery/harb1.jpg", description: "Fjord yang menakjubkan di Taman Negara Fiordland, terkenal dengan air terjun dan pemandangan semula jadi." },
                        { src: "images/newzealandC_gallery/harb2.jpg", description: "Fjord yang menakjubkan di Taman Negara Fiordland, terkenal dengan air terjun dan pemandangan semula jadi." },
                        { src: "images/newzealandC_gallery/harb3.jpg", description: "Fjord yang menakjubkan di Taman Negara Fiordland, terkenal dengan air terjun dan pemandangan semula jadi." },
                        { src: "images/newzealandC_gallery/harb4.jpg", description: "Fjord yang menakjubkan di Taman Negara Fiordland, terkenal dengan air terjun dan pemandangan semula jadi." }
                    ]
                },
                {
                    name: "Zealong Tea Plantation",
                    images: [
                        { src: "images/newzealandC_gallery/zea.jpg", description: "Pemandangan bandar Wellington dari atas." },
                        { src: "images/newzealandC_gallery/zea1.jpg", description: "Pemandangan bandar Wellington dari atas." },
                        { src: "images/newzealandC_gallery/zea2.jpg", description: "Pemandangan bandar Wellington dari atas." },
                        { src: "images/newzealandC_gallery/zea3.jpg", description: "Pemandangan bandar Wellington dari atas." }
                    ]
                },
            ]
        },

        newYork: {
            title: "Lawatan ke New York",
            intro: "Terokai bandar yang tidak pernah tidur, dari mercu tanda ikonik hingga kebudayaan yang pelbagai.",
            image: "images/NewYork.jpeg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel bertaraf antarabangsa",
                "<strong>Lawatan ke tempat menarik</strong> seperti Times Square, Patung Liberty, dan Central Park",
                "<strong>Makanan</strong> yang mudah didapati",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                {
                    name: "Times Square",
                    images: [
                        { src: "images/newYork_gallery/timesSquare.jpg", description: "Persimpangan utama di Manhattan yang terkenal dengan papan iklan digital gergasi." }
                    ]
                },
            ]
        },
        barbados: {
            title: "Lawatan Korporat ke Barbados",
            intro: "Alami percutian yang mewah di pulau Caribbean, dikelilingi oleh pantai berpasir putih dan air laut yang jernih.",
            image: "images/barbados.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di resort 5 bintang",
                "<strong>Lawatan ke tempat menarik</strong> seperti pantai, gua dan tempat bersejarah",
                "<strong>Makanan</strong> yang mudah didapati",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                {
                    name: "Barbados",
                    images: [
                        { src: "images/barbados_gallery/barbados1.jpg", description: "Pemandangan pantai yang indah." }
                    ]
                },
            ]
        },
        germanyNetherlands: {
            title: "Lawatan Korporat ke Germany-Netherlands",
            intro: "Terokai budaya, sejarah dan seni bina yang kaya di Jerman dan Belanda. Lawatan kerja yang merangkumi pameran teknologi dan forum industri.",
            image: "images/Germany.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel bertaraf antarabangsa",
                "<strong>Lawatan ke pameran teknologi</strong> dan forum industri",
                "<strong>Lawatan ke tempat menarik</strong> di bandar utama seperti Berlin dan Amsterdam",
                "<strong>Makanan</strong> yang mudah didapati",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                {
                    name: "Pemandangan Germany-Netherlands",
                    images: [
                        { src: "images/germany_gallery/germany1.jpg", description: "Pemandangan indah di Jerman dan Belanda." }
                    ]
                },
            ]
        },
    };
    
    // Function to render the tour cards
    function renderTourCards() {
        const tourList = document.getElementById('tourList');
        tourList.innerHTML = '';
        
        const startIndex = (currentPage - 1) * toursPerPage;
        const endIndex = startIndex + toursPerPage;
        const toursToDisplay = filteredTourCards.slice(startIndex, endIndex);

        if (toursToDisplay.length === 0) {
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }

        toursToDisplay.forEach(tour => {
            tourList.appendChild(tour);
        });

        renderPagination();
    }
    
    // Function to render the pagination links
    function renderPagination() {
        paginationContainer.innerHTML = '';
        const totalPages = Math.ceil(filteredTourCards.length / toursPerPage);
    
        if (totalPages > 1) {
            // Previous button
            const prevLink = document.createElement('a');
            prevLink.href = "#";
            prevLink.innerHTML = "&laquo; Prev";
            prevLink.onclick = (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderTourCards();
                }
            };
            if (currentPage === 1) {
                prevLink.classList.add('disabled');
            }
            paginationContainer.appendChild(prevLink);
    
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement('a');
                pageLink.href = "#";
                pageLink.innerHTML = i;
                pageLink.onclick = (e) => {
                    e.preventDefault();
                    currentPage = i;
                    renderTourCards();
                };
                if (i === currentPage) {
                    pageLink.classList.add('active');
                }
                paginationContainer.appendChild(pageLink);
            }
    
            // Next button
            const nextLink = document.createElement('a');
            nextLink.href = "#";
            nextLink.innerHTML = "Next &raquo;";
            nextLink.onclick = (e) => {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTourCards();
                }
            };
            if (currentPage === totalPages) {
                nextLink.classList.add('disabled');
            }
            paginationContainer.appendChild(nextLink);
        }
    }
    
    // Initial call to render tours and pagination
    function initializeTours() {
        filteredTourCards = Array.from(allTourCards);
        renderTourCards();
    }
    
    // Call the initialize function on page load
    window.onload = initializeTours;
    
    // Filter logic
    function filterTours() {
        const selectedDestination = destinationFilter.value;
        const selectedTopics = Array.from(topicCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        const searchQuery = searchFilter.value.toLowerCase().trim();
        
        filteredTourCards = Array.from(allTourCards).filter(card => {
            const cardDestination = card.getAttribute('data-destination');
            const cardTopics = card.getAttribute('data-topics').split(',');
            const cardTitle = card.querySelector('h4').textContent.toLowerCase();
            const cardDescription = card.querySelector('p').textContent.toLowerCase();
            
            const matchesDestination = selectedDestination === '' || cardDestination === selectedDestination;
            const matchesTopics = selectedTopics.length === 0 || selectedTopics.some(topic => cardTopics.includes(topic));
            const matchesSearch = searchQuery === '' || cardTitle.includes(searchQuery) || cardDescription.includes(searchQuery);
            
            return matchesDestination && matchesTopics && matchesSearch;
        });

        currentPage = 1;
        renderTourCards();
    }

    // Reset filters and show all tours
    function resetFilters() {
        destinationFilter.value = "";
        topicCheckboxes.forEach(cb => cb.checked = false);
        searchFilter.value = "";
        initializeTours();
    }

    // Populate the destination filter dropdown
    function populateDestinationFilter() {
        const destinations = new Set();
        allTourCards.forEach(card => {
            destinations.add(card.getAttribute('data-destination'));
        });
        
        destinations.forEach(dest => {
            const option = document.createElement('option');
            option.value = dest;
            option.textContent = dest;
            destinationFilter.appendChild(option);
        });
    }

    // Event Listeners for filtering
    destinationFilter.addEventListener('change', filterTours);
    topicCheckboxes.forEach(cb => cb.addEventListener('change', filterTours));
    searchButton.addEventListener('click', filterTours);
    searchFilter.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            filterTours();
        }
    });

    populateDestinationFilter();

    // MODAL functionality
    const showModal = (tourId) => {
        const tour = tourData[tourId];
        if (tour) {
            modalTourImage.src = tour.image;
            modalTourTitle.textContent = tour.title;
            modalTourIntro.textContent = tour.intro;

            // Packages
            modalPackageList.innerHTML = "";
            tour.packages.forEach(pkg => {
                const li = document.createElement('li');
                li.innerHTML = pkg;
                modalPackageList.appendChild(li);
            });

            // Gallery
            modalGallery.innerHTML = "";
            tour.gallery.forEach(location => {
                const section = document.createElement('div');
                section.classList.add('gallery-location-section');
                
                const h5 = document.createElement('h5');
                h5.textContent = location.name;
                section.appendChild(h5);
                
                const imagesContainer = document.createElement('div');
                imagesContainer.classList.add('gallery-images-container');
                
                location.images.forEach(img => {
                    const imgElement = document.createElement('img');
                    imgElement.src = img.src;
                    imgElement.alt = img.description;
                    imagesContainer.appendChild(imgElement);
                });
                
                section.appendChild(imagesContainer);
                modalGallery.appendChild(section);
            });

            // Set inquire button link
            modalInquireBtn.href = `contact.php?tour=${tourId}`;

            tourDetailModal.classList.add('active');
        }
    };

    allTourCards.forEach(card => {
        card.addEventListener('click', (e) => {
            const tourId = card.getAttribute('data-id');
            showModal(tourId);
        });
    });

    modalCloseBtn.addEventListener('click', () => {
        tourDetailModal.classList.remove('active');
    });

    tourDetailModal.addEventListener('click', (e) => {
        if (e.target === tourDetailModal) {
            tourDetailModal.classList.remove('active');
        }
    });
</script>
</body>
</html>