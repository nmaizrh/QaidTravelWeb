<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tours | Qaid Travel</title>
    <link rel="stylesheet" href="style.css" />
<style>
    /* Existing CSS from your file */
    body {
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0; /* Keeping the light grey background from previous step */
    }

    .tour-list {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: flex-start; /* Ensures cards are aligned to the left */
        flex-grow: 1;
    }

    .tour-card {
        flex-basis: calc(33.333% - 20px); /* Preferred width for 3 cards per row */
        flex-grow: 0;   /* Changed from 1 to 0: Prevents cards from growing and filling extra space */
        flex-shrink: 0; /* Prevents cards from shrinking */
        max-width: 350px; /* Caps the maximum width of a single card, adjust as needed */
        background-color: #fff; /* Keeping cards white as they are content containers */
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
        flex-shrink: 0; /* Prevents the filter panel from shrinking */
        width: 320px; /* Fixed width for the filter box */
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

    .filter-group label[for="searchFilter"] {
        color: black !important;
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
        width: 92%; /* Changed to 100% for responsiveness */
        max-width: 100%; /* Ensure it's responsive */
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .search-btn {
        background-color: #b62626; /* Matches your primary red color */
        color: #fff;
        padding: 10px 15px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-left: 10px; /* Space from the input field */
    }

    .search-btn:hover {
        background-color: #7c1919; /* Darker red on hover */
        transform: scale(1.02);
    }

    /* Responsive adjustments for the filter group with the button */
    @media (max-width: 768px) {
        .filter-group {
            flex-direction: column; /* Stack label, input, and button on small screens */
            align-items: flex-start;
            gap: 5px;
        }

        .filter-group .search-btn {
            margin-top: 10px; /* Space from input when stacked */
            margin-left: 0; /* Remove left margin when stacked */
            width: 100%; /* Full width button on small screens */
        }
    }

    .filter-group #searchFilter:focus {
        outline: none;
        border-color: #5d0c0c;
        box-shadow: 0 0 5px rgba(182, 38, 38, 0.5);
    }

    /* Specific styling for the search input's LABEL */
    label[for="searchFilter"] {
        color: #333; /* Changed to dark color for readability */
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
            flex-direction: column; /* Stack filter and tour list on smaller screens */
            align-items: center;
        }
        .filter-panel {
            width: 100%; /* Make filter panel full width */
            margin-bottom: 30px;
        }
        .tour-card {
            flex-basis: calc(50% - 20px); /* For screens up to 900px, display 2 cards per row */
            max-width: 450px; /* Adjust max-width for single card in 2-column layout */
        }
    }

    @media (max-width: 600px) {
        .tour-card {
            flex-basis: 100%; /* For screens up to 600px, display 1 card per row */
            max-width: unset; /* Remove max-width when card should take full available width */
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
        overflow-y: auto; /* Enable scrolling for long content */
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
        color: #b62626; /* Highlight package points */
    }

    /* Updated Gallery Styles */
    .modal-gallery {
        display: flex; /* Changed to flexbox */
        flex-direction: column; /* Stack items vertically */
        gap: 20px; /* Increased gap between items */
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
        padding: 15px; /* Increased padding */
        box-shadow: 0 1px 5px rgba(0,0,0,0.05);
    }
    .modal-gallery-item img {
        width: auto; /* Allow image to scale */
        max-width: 100%; /* Ensure image doesn't overflow container */
        height: auto; /* Allow image to scale */
        max-height: 300px; /* Set a max height for larger display */
        object-fit: contain; /* Ensure image is fully visible without cropping */
        border-radius: 5px;
        margin-bottom: 10px; /* Increased margin */
    }
    .modal-gallery-item .name {
        font-weight: bold;
        color: #333;
        font-size: 1.1em; /* Slightly larger font */
        margin-bottom: 5px;
    }
    .modal-gallery-item .description {
        font-size: 0.9em; /* Slightly larger font */
        color: #666;
    }

    /* --- Pagination Styles (Updated to match corporate.php) --- */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
        padding: 10px;
        background-color: transparent;
        box-shadow: none; /* Removed shadow for a cleaner look */
        border-radius: 8px;
    }

    .pagination a {
        color: #333; /* Darker text color */
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
        border-radius: 5px;
        margin: 0 5px;
        font-weight: bold;
        border: 1px solid #ddd; /* Added a subtle border */
    }

    .pagination a.active {
        background-color: #b62626;
        color: white;
        border-color: #b62626; /* Match border color to background */
    }

    .pagination a:hover:not(.active) {
        background-color: #f0f0f0; /* Light grey hover background */
        color: #b62626; /* Red text on hover */
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
</style>
</head>
<body>
<?php include 'header.php'; ?>
<section class="popular-destination">
<h1 class="center-text"><strong>LAWATAN KAMI SEDIAKAN</strong></h1>
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
            <div class="tour-card" data-id="batam" data-destination="Batam" data-topics="Island,Nature">
                <img src="images/Batam.jpeg" alt="Batam"/>
                <div class="info">
                    <h4>Percutian Pulau Batam</h4>
                    <p>Temui pantai Batam, membeli-belah, dan kehidupan malam yang meriah.</p>
                </div>
            </div>
            <div class="tour-card" data-id="bangkok" data-destination="Bangkok" data-topics="Culture,Shopping,City">
                <img src="images/Bangkok.jpg" alt="Bangkok"/>
                <div class="info">
                    <h4>Percutian Menarik ke Bangkok</h4>
                    <p>Alami keunikan budaya Thai, syurga membeli-belah dan destinasi pelancongan popular di Bangkok.</p>
                </div>
            </div>
            <div class="tour-card" data-id="danang" data-destination="Danang" data-topics="Culture,City">
                <img src="images/danang.jpg" alt="Danang"/>
                <div class="info">
                    <h4>Lawatan Budaya & Alam ke Da Nang</h4>
                    <p>Terokai keindahan bandar pesisir Vietnam ini yang terkenal dengan pantai cantik, jambatan ikonik dan warisan budaya yang memukau.</p>
                </div>
            </div>
            <div class="tour-card" data-id="england" data-destination="England" data-topics="Food,Culture">
                <img src="images/London.jpg" alt="England"/>
                <div class="info">
                    <h4>Lawatan Warisan London</h4>
                    <p>Terokai Big Ben, Tower Bridge, dan sejarah British yang kaya dengan
                        pilihan mesra halal di sekitar bandar.</p>
                </div>
            </div>
            <div class="tour-card" data-id="hat_yai" data-destination="Hat Yai" data-topics="Culture,Food">
                <img src="images/Hatyai.png" alt="Hat Yai"/>
                <div class="info">
                    <h4>Keindahan Bandar Hat Yai</h4>
                    <p>Terokai pasar Hat Yai yang sibuk, kuil, dan makanan jalanan yang lazat.</p>
                </div>
            </div>
            <div class="tour-card" data-id="jakartaBandung" data-destination="Jakarta & Bandung" data-topics="Culture,Nature,Shopping">
                <img src="images/Jakarta.jpg" alt="Jakarta & Bandung"/>
                <div class="info">
                    <h4>Lawatan Menarik ke Jakarta & Bandung</h4>
                    <p>Alami gabungan budaya kota moden Jakarta dan keindahan semula jadi serta syurga membeli-belah di Bandung.</p>
                </div>
            </div>
            <div class="tour-card" data-id="japan" data-destination="Japan" data-topics="Food,Culture">
                <img src="images/Japan.jpg" alt="Japan"/>
                <div class="info">
                    <h4>Jelajahi Jepun</h4>
                    <p>Lawati Kyoto dengan hidangan halal dan keindahan budaya.</p>
                </div>
            </div>
            <div class="tour-card" data-id="karimun_island" data-destination="Karimun Island" data-topics="Island,Nature">
                <img src="images/KarimunIsland.jpg" alt="Karimun Island"/>
                <div class="info">
                    <h4>Pengembaraan Pulau Karimun</h4>
                    <p>Alami keindahan semula jadi yang belum terusik dan suasana tenang Pulau Karimun.</p>
                </div>
            </div>
            <div class="tour-card" data-id="korea" data-destination="Korea" data-topics="Culture,Nature">
                <img src="images/Korea.jpg" alt="Korea"/>
                <div class="info">
                    <h4>Lawatan Musim Luruh Korea</h4>
                    <p>Nikmati musim Korea dengan perjalanan kumpulan terpilih.</p>
                </div>
            </div>
            <div class="tour-card" data-id="kotakinabaluKundasang" data-destination="Kota Kinabalu & Kundasang" data-topics="Nature,Culture,Highlands">
                <img src="images/Kinabalu.jpg" alt="Kota Kinabalu & Kundasang"/>
                <div class="info">
                    <h4>Lawatan Kota Kinabalu & Kundasang</h4>
                    <p>Rasai keindahan alam semula jadi serta suasana tanah tinggi yang nyaman dan warisan budaya di Sabah.</p>
                </div>
            </div>
            <div class="tour-card" data-id="langkawi" data-destination="Langkawi" data-topics="Island,Nature">
                <img src="images/Langkawi.jpg" alt="Langkawi"/>
                <div class="info">
                    <h4>Syurga Pulau Langkawi</h4>
                    <p>Nikmati pantai Langkawi yang menakjubkan, keajaiban geologi dan membeli-belah bebas cukai.</p>
                </div>
            </div>
            <div class="tour-card" data-id="semporna" data-destination="Semporna" data-topics="Island,Marine,Nature">
                <img src="images/semporna.jpg" alt="Semporna"/>
                <div class="info">
                    <h4>Terokai Keindahan Semporna</h4>
                    <p>Alami keajaiban pulau tropika, aktiviti snorkeling dan panorama laut yang memukau di Semporna.</p>
                </div>
            </div>
            <div class="tour-card" data-id="sarawak" data-destination="Sarawak" data-topics="Nature,Culture">
                <img src="images/Sarawak.jpg" alt="Sarawak"/>
                <div class="info">
                    <h4>Penemuan Budaya Sarawak</h4>
                    <p>Temui budaya asli dan keajaiban semula jadi Sarawak.</p>
                </div>
            </div>
            <div class="tour-card" data-id="tanjung_pinang_bintan" data-destination="Tanjung Pinang Bintan" data-topics="Island,Nature">
                <img src="images/TanjungPinang.jpg" alt="Tanjung Pinang Bintan"/>
                <div class="info">
                    <h4>Percutian Tanjung Pinang & Bintan</h4>
                    <p>Bersantai di pantai-pantai bersih Bintan dan terokai daya tarikan Tanjung Pinang.</p>
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
                <img src="images/Turki.jpg" alt="Turki"/>
                <div class="info">
                    <h4>Melancong ke Turki</h4>
                    <p>Terokai Istanbul, Cappadocia, dan tapak bersejarah.</p>
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
                { src: "images/umrah_gallery/masjidQuba.jpg", name: "Masjid Quba", description: "Masjid pertama yang dibina oleh Nabi Muhammad (SAW)." },
                { src: "images/umrah_gallery/madinah.png", name: "Madinah", description: "Kota yang diterangi dengan tapak suci kedua dalam Islam." },
                { src: "images/umrah_gallery/JabalRahmah.jpg", name: "Jabal Rahmah", description: "Gunung Rahmat di Arafah dan tapak khutbah terakhir Nabi Muhammad." },
                { src: "images/umrah_gallery/masjidNabawi.jpg", name: "Masjid Nabawi", description: "Masjid Nabi di Madinah serta mengandungi makam Nabi Muhammad." },
            ]
        },
        japan: {
            title: "Jelajahi Jepun: Lawatan Bunga Sakura dan Budaya",
            intro: "Selami gabungan mempesona budaya tradisional dan keajaiban moden Jepun dengan tumpuan khas pada pengalaman mesra Muslim.",
            image: "images/Japan.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel mesra Muslim terpilih",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Tokyo, Kyoto, Osaka dan Nara.",
                "<strong>Makanan</strong> yang disahkan atau ramah Muslim",
                "<strong>Pemandu pelancong berpengalaman</strong> yang mesra Muslim",
                "Pengangkutan awam yang efisien (termasuk Shinkansen/Kereta api laju)"
            ],
            gallery: [
                { src: "images/japan_gallery/Kobe.png", name: "Kobe Harborland - Kobe", description: "Kawasan pelabuhan moden dengan pemandangan malam yang menakjubkan, pusat beli-belah dan tempat santai tepi laut." },
                { src: "images/japan_gallery/KyotoTemple.jpg", name: "Kuil Kinkaku-ji - Kyoto", description: "Pavilion Emas dan kuil Buddha Zen yang menakjubkan." },
                { src: "images/japan_gallery/universal.jpg", name: "Universal Studio Japan - Osaka", description: "Taman tema popular dengan tarikan filem terkenal, pertunjukan langsung dan pengalaman hiburan untuk semua peringkat umur." },
                { src: "images/japan_gallery/Arashiyama.jpg", name: "Hutan Buluh Arashiyama - Kyoto", description: "Hutan buluh yang tenang serta keajaiban alam." },
            ]
        },
        korea: {
            title: "Lawatan Musim Luruh Korea: Pengalaman Halal yang Indah",
            intro: "Alami warna musim luruh yang meriah dan warisan budaya yang kaya di Korea Selatan dengan jadual perjalanan yang direka khas untuk pelancong Muslim.",
            image: "images/Korea.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel selesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Pulau Nami, Istana Gyeongbokgung, Menara Seoul dan banyak lagi",
                "<strong>Makanan</strong> yang lazat dan pelbagai",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/korea_gallery/NamiIsland.jpg", name: "Pulau Nami", description: "Sebuah pulau berbentuk separuh bulan yang indah yang terkenal dengan keindahan semula jadi." },
                { src: "images/korea_gallery/SeoulTower.jpg", name: "Menara N Seoul", description: "Mercu tanda ikonik yang menawarkan pemandangan panorama Seoul." },
                { src: "images/korea_gallery/Gyeongbokgung.jpg", name: "Istana Gyeongbokgung", description: "Istana terbesar dari Lima Istana Besar yang dibina semasa Dinasti Joseon." },
                { src: "images/korea_gallery/KoreanFood.jpg", name: "Masakan Halal Korea", description: "Menikmati hidangan halal yang lazat dan pelbagai di Korea." },
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
                { src: "images/turki_gallery/Cappadocia.jpg", name: "Cappadocia", description: "Terkenal dengan formasi batuan 'cerobong pari-pari' yang unik dan menaiki belon udara panas." },
                { src: "images/turki_gallery/HagiaSophia.jpg", name: "Hagia Sophia (Istanbul)", description: "Keajaiban seni bina yang hebat dan asal gereja." },
                { src: "images/turki_gallery/BlueMosque.jpg", name: "Masjid Biru (Istanbul)", description: "Terkenal dengan jubin biru yang menakjubkan dan enam menara." },
                { src: "images/turki_gallery/Pamukkale.jpg", name: "Pamukkale", description: "Teres air panas yang kaya dengan mineral putih." },
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
                "<strong>Aktiviti membeli-belah</strong> di pusat fesyen seperti Pasar Baru, Cihampelas  dan Factory Outlet Bandung",
                "<strong>Makanan</strong> tempatan dan halal disediakan",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                { src: "images/jakarta_gallery/Monas.jpg", name: "Monas (Monumen Nasional)", description: "Simbol ikonik kemerdekaan Indonesia yang terletak di pusat Jakarta." },
                { src: "images/jakarta_gallery/IstiqlalMosque.jpeg", name: "Masjid Istiqlal", description: "Masjid terbesar di Asia Tenggara yang menjadi kebanggaan umat Islam di Indonesia." },
            
                // Bandung Places
                { src: "images/jakarta_gallery/KawahPutih.jpg", name: "Kawah Putih", description: "Tasik kawah berwarna putih kehijauan yang menakjubkan di puncak gunung Bandung." },
                { src: "images/jakarta_gallery/Farmhouse.jpg", name: "Farmhouse Lembang", description: "Tarikan keluarga dengan suasana desa Eropah serta haiwan jinak dan spot bergambar menarik." }
            ]
        },
        bangkok: {
            title: "Percutian Menarik ke Bangkok",
            intro: "Alami keunikan budaya Thai, pasar malam yang meriah, makanan halal yang lazat serta destinasi pelancongan popular di Bangkok.",
            image: "images/Bangkok.jpg", 
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pilihan di Bangkok",
                "<strong>Lawatan ke mercu tanda utama</strong> seperti Wat Phra Chetuphon (Wat Pho), Grand Palace, dan Asiatique The Riverfront",
                "<strong>Aktiviti membeli-belah</strong> di Chatuchak Weekend Market dan MBK Center",
                "<strong>Makanan</strong> halal dan tempatan disediakan",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                { src: "images/bangkok_gallery/BeeFarm.jpg", name: "Bee Farm", description: "Pelajari proses penghasilan madu dan produk berasaskan lebah." },
                { src: "images/bangkok_gallery/ICONSIAM.jpg", name: "ICONSIAM", description: "Pusat beli-belah mewah di tepi sungai dengan pelbagai jenama antarabangsa." },
                { src: "images/bangkok_gallery/WatArun.jpg", name: "Wat Arun", description: "Kuil terkenal dengan seni bina indah di tebing Sungai Chao Phraya." },
                { src: "images/bangkok_gallery/ErawadeeHerb.jpeg", name: "Erawadee Herb Shop", description: "Kedai ubatan tradisional Thailand yang popular dalam kalangan pelancong." }
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
                { src: "images/vietnam_gallery/HalongBay.jpg", name: "Teluk Halong", description: "Tapak Warisan Dunia UNESCO yang terkenal dengan air zamrud dan pulau-pulau batu kapur yang menjulang tinggi." },
                { src: "images/vietnam_gallery/HanoiOldQuarter.jpg", name: "Kawasan Lama Hanoi", description: "Jantung bersejarah Hanoi yang sibuk dengan pasar dan jalan-jalan purba." },
                { src: "images/vietnam_gallery/BenThanhMarket.jpg", name: "Pasar Ben Thanh (Ho Chi Minh)", description: "Pasar yang meriah menawarkan barangan tempatan dan makanan jalanan." },
                { src: "images/vietnam_gallery/CuChiTunnels.jpg", name: "Terowong Cu Chi", description: "Rangkaian bawah tanah yang rumit yang digunakan semasa Perang Vietnam." },
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
                { src: "images/thailand_gallery/BangkokTemple.jpg", name: "Wat Arun (Bangkok)", description: "Kuil Fajar dan kuil tepi sungai yang menakjubkan." },
                { src: "images/thailand_gallery/PhuketBeach.jpeg", name: "Pantai Phuket", description: "Nikmati pantai yang indah dan perairan biru kehijauan." },
                { src: "images/thailand_gallery/FloatMarket.jpg", name: "Pasar Terapung", description: "Alami perdagangan tradisional Thailand di atas air." },
                { src: "images/thailand_gallery/ChiangMai.jpg", name: "Chiang Mai", description: "Terokai kuil-kuil purba dan tempat perlindungan gajah." },
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
                { src: "images/london_gallery/BigBen.jpg", name: "Big Ben", description: "Menara jam ikonik di sebelah Bangunan Parlimen." },
                { src: "images/london_gallery/TowerBridge.jpg", name: "Tower Bridge", description: "Jambatan mercu tanda terkenal di atas Sungai Thames." },
                { src: "images/london_gallery/BuckinghamPalace.jpg", name: "Istana Buckingham", description: "Kediaman rasmi Raja United Kingdom." },
                { src: "images/london_gallery/LondonEye.jpg", name: "London Eye", description: "Roda Ferris gergasi di South Bank Sungai Thames." },
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
                { src: "images/batam_gallery/BatamBeach.jpg", name: "Pantai dan Pesisir Nongsa", description: "Bersantai di pantai berpasir Batam." },
                { src: "images/batam_gallery/NagoyaHillShoppingMall.jpg", name: "Pusat Beli-belah Nagoya Hill", description: "Nikmati membeli-belah bebas cukai dan hiburan." },
                { src: "images/batam_gallery/barelang.jpg", name: "Jambatan Barelang", description: "Ikon terkenal di Batam yang menghubungkan beberapa pulau utama dan menawarkan pemandangan indah terutama saat matahari terbenam." }
            ]
        },
        tanjung_pinang_bintan: {
            title: "Percutian Tanjung Pinang & Bintan",
            intro: "Alami keindahan tenang pantai-pantai bersih Bintan dan daya tarikan bersejarah Tanjung Pinang, Indonesia.",
            image: "images/TanjungPinang.jpg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di resort disediakan",
                "<strong>Lawatan tempat bersejarah</strong> seperti candi 1000 patung",
                "<strong>Makanan</strong> yang lazat dan pelbagai",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/tanjungPinang_gallery/BintanBeach.jpg", name: "Pantai Bintan", description: "Pantai berpasir putih dan air jernih." },
                { src: "images/tanjungPinang_gallery/PinangCity.jpg", name: "Bandar Tanjung Pinang", description: "Terokai tapak bersejarah ibu kota." },
                { src: "images/tanjungPinang_gallery/SultanMasjid.png", name: "Masjid Raya Sultan Riau", description: "Masjid bersejarah dengan seni bina Melayu yang indah di Pulau Penyengat." }
            ]
        },
        karimun_island: {
            title: "Pengembaraan Pulau Karimun",
            intro: "Temui keindahan alam semula jadi dan suasana tenang Pulau Karimun serta permata tersembunyi di Indonesia.",
            image: "images/KarimunIsland.jpg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel yang selesa",
                "<strong>Aktiviti pantai</strong> seperti snorkeling dan menyelam",
                "<strong>Makanan</strong> laut segar",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/karimun_gallery/TanjungGelam.jpg", name: "Pantai Tanjung Gelam", description: "Bersantai di pantai terpencil." },
                { src: "images/karimun_gallery/karimunSnorkelling.jpg", name: "Snorkeling", description: "Temui kehidupan marin yang meriah." },
                { src: "images/karimun_gallery/masjidkarimun.jpg", name: "Masjid Baiturrahman", description: "Masjid utama di Pulau Karimun, Kepulauan Riau. Terkenal dengan reka bentuk moden dan menjadi pusat ibadah serta tumpuan umat Islam tempatan dan pelancong." }
            ]
        },
        kotakinabaluKundasang: {
            title: "Lawatan Indah ke Kota Kinabalu & Kundasang",
            intro: "Alami keindahan semula jadi Sabah dari pantai yang memukau di Kota Kinabalu ke udara sejuk tanah tinggi Kundasang yang menenangkan.",
            image: "images/Kinabalu.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel atau resort di Kota Kinabalu dan Kundasang",
                "<strong>Lawatan ke tempat ikonik</strong> seperti Masjid Bandaraya, Desa Dairy Farm dan Kundasang War Memorial",
                "<strong>Aktiviti alam semula jadi</strong> seperti melawat Taman Negara Kinabalu dan pekan Nabalu",
                "<strong>Makanan</strong> tempatan dan halal disediakan",
                "Pengangkutan persendirian disediakan sepanjang lawatan"
            ],
            gallery: [
                { src: "images/kotaKundasang_gallery/masjidBandaraya.jpg", name: "Masjid Bandaraya Kota Kinabalu", description: "Masjid terapung yang menjadi simbol ikonik di Kota Kinabalu dengan latar laut yang menakjubkan." },
                { src: "images/kotaKundasang_gallery/desaDairy.jpg", name: "Desa Dairy Farm", description: "Ladang tenusu di Kundasang dengan pemandangan seperti New Zealand dan peluang bergambar menarik." },
                { src: "images/kotaKundasang_gallery/kundasangWarMemorial.jpg", name: "Kundasang War Memorial", description: "Tapak bersejarah untuk memperingati wira perang dan pemandangan taman yang tenang." },
                { src: "images/kotaKundasang_gallery/pekanNabalu.jpg", name: "Pekan Nabalu", description: "Perhentian terkenal di Kundasang dengan pemandangan Gunung Kinabalu serta gerai kraftangan dan makanan tempatan." }
            ]
        },
        semporna: {
            title: "Terokai Keindahan Semporna",
            intro: "Alami keindahan laut biru kristal, pulau-pulau tropika dan kehidupan laut yang menakjubkan di Semporna, Sabah.",
            image: "images/Semporna.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di resort atau chalet tepi laut",
                "<strong>Aktiviti lawatan pulau</strong> ke Timba-Timba, Egang-Egang dan pulau sekitarnya",
                "<strong>Snorkelling & aktiviti laut</strong> di lokasi terumbu karang terbaik",
                "<strong>Makanan</strong> halal tempatan disediakan",
                "Pemandu pelancong berpengalaman",
                "Pengangkutan darat dan bot disediakan"
            ],
            gallery: [
                { src: "images/sabah_gallery/timbatimba.jpg", name: "Pulau Timba-Timba", description: "Pulau tropika yang terkenal dengan pasir putih lembut dan perairan jernih serta sesuai untuk bergambar dan snorkeling." },
                { src: "images/sabah_gallery/egang.jpg", name: "Pulau Egang Egang", description: "Pulau yang damai dengan pemandangan laut yang indah, lokasi santai dan bergambar menarik di atas jeti panjang."},
                { src: "images/sabah_gallery/snorkelling.jpg", name: "Snorkelling di Semporna", description: "Aktiviti utama di Semporna dengan pemandangan terumbu karang yang mempesona dan hidupan laut yang pelbagai."}
            ]
        },
        sarawak: {
            title: "Penemuan Budaya Sarawak",
            intro: "Temui budaya asli dan keajaiban semula jadi Sarawak.",
            image: "images/Sarawak.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel dan resort",
                "<strong>Lawatan ke Tebingan Kuching</strong>, Kampung Budaya Sarawak dan Taman Negara Bako",
                "<strong>Makanan</strong> tempatan",
                "Pemandu pelancong berpengalaman",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/sarawak_gallery/culturalvillage.jpg", name: "Kampung Budaya Sarawak", description: "Muzium hidup yang mempamerkan pelbagai kumpulan etnik Sarawak." },
                { src: "images/sarawak_gallery/muluCaves.jpeg", name: "Gua Mulu", description: "Gua batu kapur yang terkenal dengan formasi menakjubkan dan diiktiraf sebagai Tapak Warisan Dunia UNESCO." },
                { src: "images/sarawak_gallery/semenggoh.jpg", name: "Pusat Hidupan Liar Semenggoh", description: "Pusat rehabilitasi untuk orangutan separa liar." }
            ]
        },
        langkawi: {
            title: "Syurga Pulau Langkawi",
            intro: "Nikmati pantai Langkawi yang menakjubkan, keajaiban geologi dan membeli-belah bebas cukai.",
            image: "images/Langkawi.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di resort pilihan",
                "<strong>Lawatan ke Jambatan Gantung Langkawi</strong>, Underwater World Langkawi dan Dataran Helang",
                "<strong>Pelbagai makanan</strong> yang lazat",
                "Pemandu pelancong berpengalaman",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/langkawi_gallery/skybridge.jpg", name: "Jambatan Gantung Langkawi", description: "Jambatan pejalan kaki 660 meter di atas paras laut." },
                { src: "images/langkawi_gallery/eaglesquare.jpg", name: "Dataran Helang", description: "Dataran helang yang menjadi simbol ikonik Langkawi dan menjadi lokasi wajib bergambar."},
                { src: "images/langkawi_gallery/telaga.jpg", name: "Air Terjun Telaga Tujuh", description: "Air terjun tujuh peringkat yang mempesona dan dikelilingi oleh alam semula jadi yang menghijau."}
            ]
        },
        hat_yai: {
            title: "Keindahan Bandar Hat Yai",
            intro: "Terokai pasar Hat Yai yang sibuk, kuil dan makanan jalanan yang lazat.",
            image: "images/Hatyai.png",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pusat bandar",
                "<strong>Lawatan ke Wat Hat Yai Nai</strong> (Buddha Berbaring), Pasar Kim Yong dan Pasar Terapung (hujung minggu)",
                "<strong>Makanan</strong> halal Thailand.",
                "Pemandu pelancong berpengalaman",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/hatyai_gallery/kimyong.jpg", name: "Pasar Kim Yong", description: "Pasar yang sibuk untuk barangan dan makanan ringan tempatan." },
                { src: "images/hatyai_gallery/WatHatYaiNai.jpg", name: "Wat Hat Yai Nai", description: "Mempunyai tempat patung Buddha terbaring yang besar." },
                { src: "images/hatyai_gallery/central.jpg", name: "Central HatYai", description: "Pusat beli-belah moden yang terkenal di Hatyai yang menempatkan pelbagai jenama antarabangsa, restoran dan hiburan keluarga." }
            ]
        },
        danang: {
            title: "Lawatan Budaya & Alam Semula Jadi ke Da Nang",
            intro: "Terokai Da Nang, bandar pesisir Vietnam yang menakjubkan dengan keindahan alam, budaya unik, dan tarikan ikonik seperti Golden Bridge dan Marble Mountains.",
            image: "images/danang.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel selesa di pusat bandar atau berhampiran pantai",
                "<strong>Lawatan ke tarikan utama</strong> seperti Golden Bridge, Marble Mountains dan Dragon Bridge",
                "<strong>Aktiviti santai</strong> di pantai My Khe dan perkampungan budaya",
                "<strong>Makanan</strong> tempatan dan halal disediakan",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                { src: "images/danang_gallery/MyKheBeach.jpg", name: "Pantai My Khe", description: "Pantai yang terkenal dengan pasir putih halus dan ombak yang sesuai untuk aktiviti berenang dan sukan air." },
                { src: "images/danang_gallery/CamThanh.jpg", name: "Kampung Kelapa Cam Thanh", description: "Kampung tradisional dengan pengalaman menaiki sampan buluh melalui hutan bakau kelapa air." },
                { src: "images/danang_gallery/HoiAn.jpg", name: "Bandar Lama Hoi An", description: "Tapak Warisan Dunia UNESCO yang menampilkan seni bina kolonial, kedai-kedai kraf dan suasana bersejarah." },
                { src: "images/danang_gallery/MinhMang.jpg", name: "Makam Minh Mang", description: "Kompleks makam bersejarah dengan seni bina klasik dan landskap yang tenang di Hue berhampiran Da Nang." }
            ]
        }
    };

    // Function to populate and sort the destination dropdown
    function populateDestinationFilter() {
        const destinations = new Set();
        allTourCards.forEach(card => {
            // Ensure data-destination is consistently capitalized for sorting
            const destination = card.dataset.destination;
            if (destination) {
                destinations.add(destination);
            }
        });

        // Convert the Set to an Array and sort it alphabetically
        const sortedDestinations = Array.from(destinations).sort((a, b) => a.localeCompare(b, 'ms')); // 'ms' for Malay locale

        // Clear existing options, but keep the default one if it exists, or add it.
        // Ensure the default "Semua Destinasi" is always first.
        destinationFilter.innerHTML = '<option value="">Semua Destinasi</option>';

        // Add the sorted, unique destinations to the dropdown
        sortedDestinations.forEach(destination => {
            const option = document.createElement('option');
            option.value = destination;
            option.textContent = destination;
            destinationFilter.appendChild(option);
        });
    }

    // Function to display tours based on current filters, search, and pagination
    function displayTours() {
        const selectedDestination = destinationFilter.value;
        const selectedTopics = Array.from(topicCheckboxes)
                                                .filter(checkbox => checkbox.checked)
                                                .map(checkbox => checkbox.value);
        const searchTerm = searchFilter.value.toLowerCase().trim();

        filteredTourCards = Array.from(allTourCards).filter(card => {
            const cardDestination = card.dataset.destination;
            const cardTopics = card.dataset.topics ? card.dataset.topics.split(',') : [];
            
            // Ensure tourData[card.dataset.id] exists before accessing its properties
            const tourDetail = tourData[card.dataset.id];
            if (!tourDetail) {
                console.warn(`Tour data not found for ID: ${card.dataset.id}`);
                return false; // Exclude card if its data is missing
            }
            const cardTitle = tourDetail.title.toLowerCase();
            const cardIntro = tourDetail.intro.toLowerCase();

            const matchesDestination = selectedDestination === '' || cardDestination === selectedDestination;
            const matchesTopics = selectedTopics.length === 0 || selectedTopics.every(topic => cardTopics.includes(topic));
            const matchesSearch = searchTerm === '' || cardTitle.includes(searchTerm) || cardIntro.includes(searchTerm);

            return matchesDestination && matchesTopics && matchesSearch;
        });

        // Hide all cards first
        allTourCards.forEach(card => {
            card.style.display = 'none';
        });

        // Handle "No results found" message
        if (filteredTourCards.length === 0 && searchTerm !== '') {
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }

        // Calculate start and end index for current page
        const startIndex = (currentPage - 1) * toursPerPage;
        const endIndex = startIndex + toursPerPage;

        // Display only the cards for the current page
        for (let i = startIndex; i < endIndex && i < filteredTourCards.length; i++) {
            filteredTourCards[i].style.display = 'block';
        }

        setupPagination(); // Update pagination links after filtering and displaying tours
    }

    // Function to set up pagination links (updated to match corporate.php)
    function setupPagination() {
        paginationContainer.innerHTML = ''; // Clear previous pagination links
        const totalPages = Math.ceil(filteredTourCards.length / toursPerPage);
        const maxPageLinks = 5; // The maximum number of page links to show at once

        if (totalPages > 1) {
            // Create 'Previous' link
            const prevLink = document.createElement('a');
            prevLink.href = '#';
            prevLink.textContent = '<';
            if (currentPage === 1) {
                prevLink.classList.add('disabled');
            } else {
                prevLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage--;
                    displayTours();
                });
            }
            paginationContainer.appendChild(prevLink);

            // Logic to show a limited number of page links
            let startPage = Math.max(1, currentPage - Math.floor(maxPageLinks / 2));
            let endPage = Math.min(totalPages, startPage + maxPageLinks - 1);

            if (endPage - startPage + 1 < maxPageLinks) {
                startPage = Math.max(1, endPage - maxPageLinks + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.textContent = i;
                if (i === currentPage) {
                    pageLink.classList.add('active');
                }
                pageLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    displayTours();
                });
                paginationContainer.appendChild(pageLink);
            }

            // Create 'Next' link
            const nextLink = document.createElement('a');
            nextLink.href = '#';
            nextLink.textContent = '>';
            if (currentPage === totalPages) {
                nextLink.classList.add('disabled');
            } else {
                nextLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage++;
                    displayTours();
                });
            }
            paginationContainer.appendChild(nextLink);
        }
    }

    // Event Listeners for filters
    destinationFilter.addEventListener('change', () => {
        currentPage = 1; // Reset to first page on filter change
        displayTours();
    });

    topicCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            currentPage = 1; // Reset to first page on filter change
            displayTours();
        });
    });

    // Event Listener for the search button click
    searchButton.addEventListener('click', () => {
        currentPage = 1; // Reset to first page on search
        displayTours();
    });

    // Event Listener for real-time search as user types (optional, remove if only button search is desired)
    searchFilter.addEventListener('input', () => {
        currentPage = 1;
        displayTours();
    });


    function resetFilters() {
        destinationFilter.value = '';
        topicCheckboxes.forEach(checkbox => checkbox.checked = false);
        searchFilter.value = ''; // Clear search input on reset
        currentPage = 1; // Reset to first page
        noResultsMessage.style.display = 'none'; // Hide no results message on reset
        displayTours(); // Re-display all tours
    }

    // Modal functionality
    allTourCards.forEach(card => {
        card.addEventListener('click', () => {
            const tourId = card.dataset.id;
            const tour = tourData[tourId];

            if (tour) {
                modalTourImage.src = tour.image;
                modalTourTitle.textContent = tour.title;
                modalTourIntro.textContent = tour.intro;

                // Clear previous packages
                modalPackageList.innerHTML = '';
                tour.packages.forEach(pkg => {
                    const li = document.createElement('li');
                    li.innerHTML = pkg;
                    modalPackageList.appendChild(li);
                });

                // Clear previous gallery items
                modalGallery.innerHTML = '';
                tour.gallery.forEach(item => {
                    const galleryItemDiv = document.createElement('div');
                    galleryItemDiv.classList.add('modal-gallery-item');

                    const img = document.createElement('img');
                    img.src = item.src;
                    img.alt = item.name;
                    galleryItemDiv.appendChild(img);

                    const name = document.createElement('div');
                    name.classList.add('name');
                    name.textContent = item.name;
                    galleryItemDiv.appendChild(name);

                    const description = document.createElement('div');
                    description.classList.add('description');
                    description.textContent = item.description;
                    galleryItemDiv.appendChild(description);

                    modalGallery.appendChild(galleryItemDiv);
                });

                // Set inquire button link
                modalInquireBtn.href = `contact.php?tour=${encodeURIComponent(tour.title)}`;

                tourDetailModal.classList.add('active');
            }
        });
    });

    modalCloseBtn.addEventListener('click', () => {
        tourDetailModal.classList.remove('active');
    });

    // Close modal if clicking outside content
    tourDetailModal.addEventListener('click', (e) => {
        if (e.target === tourDetailModal) {
            tourDetailModal.classList.remove('active');
        }
    });

    // Initial load
    document.addEventListener('DOMContentLoaded', () => {
        populateDestinationFilter();
        displayTours(); // Initial display and pagination setup
    });

</script>
</body>
<?php include "footer.php" ?>
</html>
