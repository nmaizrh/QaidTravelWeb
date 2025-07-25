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
        background-color: #fff;
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

    .filter-group {
        margin-bottom: 20px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 10px;
    }

    .tour-list {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: flex-start; /* Aligns cards to the left within the tour-list */
        flex-grow: 1; /* Allows tour-list to take up all available space next to the filter panel */
    }

    .tour-card {
        flex-basis: calc(33.333% - 20px); /* Preferred width for 3 cards per row */
        flex-grow: 1; /* Allows the card to grow and fill available space if fewer items */
        max-width: 350px; /* Caps the maximum width of a single card, adjust as needed */
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
        cursor: pointer; /* Indicate it's clickable */
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

</style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="tours-container">
    <div class="filter-panel">
        <h3>Filter</h3>

        <div class="filter-group">
            <label for="destination">Destination</label>
            <select id="destination">
                <option value="">All Destinations</option>
            </select>
        </div>

        <div class="filter-group">
            <h4>Topics</h4>
            <label><input type="checkbox" value="Culture"> Culture & Heritage</label>
            <label><input type="checkbox" value="Nature"> Nature & Adventure</label>
            <label><input type="checkbox" value="Food"> Food & Drinks</label>
            <label><input type="checkbox" value="Island"> Island & Beaches</label>
        </div>

        <button class="show-all-btn" onclick="resetFilters()">Show All</button>
    </div>

    <div class="tour-list" id="tourList">
        <div class="tour-card" data-id="umrah" data-destination="Umrah" data-topics="Culture">
            <img src="images/Umrah.jpg" alt="Umrah"/>
            <div class="info">
                <h4>Umrah Journey</h4>
                <p>Complete Umrah package with religious guidance.</p>
            </div>
        </div>
        <div class="tour-card" data-id="japan" data-destination="Japan" data-topics="Food,Culture">
            <img src="images/Japan.jpg" alt="Japan"/>
            <div class="info">
                <h4>Discover Japan</h4>
                <p>Visit Kyoto with halal dining and cultural beauty.</p>
            </div>
        </div>
        <div class="tour-card" data-id="korea" data-destination="Korea" data-topics="Culture,Nature">
            <img src="images/Korea.jpg" alt="Korea"/>
            <div class="info">
                <h4>Korea Autumn Tour</h4>
                <p>Enjoy Korea's seasons with curated group trips.</p>
            </div>
        </div>
        <div class="tour-card" data-id="turki" data-destination="Turki" data-topics="Culture,Food">
            <img src="images/Turki.jpg" alt="Turki"/>
            <div class="info">
                <h4>Travel to Turkiye</h4>
                <p>Explore Istanbul, Cappadocia, and historical sites.</p>
            </div>
        </div>
        <div class="tour-card" data-id="jakarta" data-destination="Jakarta" data-topics="Culture,Nature">
            <img src="images/Jakarta.jpg" alt="Jakarta"/>
            <div class="info">
                <h4>Jakarta City Tour</h4>
                <p>Explore Jakarta’s vibrant culture, landmarks, and halal-friendly attractions.</p>
            </div>
        </div>
        <div class="tour-card" data-id="vietnam" data-destination="Vietnam" data-topics="Nature,Food,Culture">
            <img src="images/Vietnam.jpg" alt="Vietnam"/>
            <div class="info">
                <h4>Vietnam Cultural Journey</h4>
                <p>Discover Vietnam’s rich heritage, scenic landscapes and halal-friendly 
                    experiences across Hanoi and Ho Chi Minh City.</p>
            </div>
        </div>
        <div class="tour-card" data-id="thailand" data-destination="Thailand" data-topics="Food,Culture">
            <img src="images/Thailand.jpg" alt="Thailand"/>
            <div class="info">
                <h4>Thailand Explorer Tour</h4>
                <p>Enjoy bustling markets, island getaways
                    and halal-friendly cuisine across Bangkok, Phuket, and beyond.</p>
            </div>
        </div>
        <div class="tour-card" data-id="england" data-destination="England" data-topics="Food,Culture">
            <img src="images/London.jpg" alt="England"/>
            <div class="info">
                <h4>London Heritage Tour</h4>
                <p>Explore Big Ben, Tower Bridge, and rich British history with
                    halal-friendly options around the city.</p>
            </div>
        </div>
        <div class="tour-card" data-id="batam" data-destination="Batam" data-topics="Island,Nature">
            <img src="images/Batam.jpeg" alt="Batam"/>
            <div class="info">
                <h4>Batam Island Escape</h4>
                <p>Discover Batam's beaches, shopping, and vibrant nightlife.</p>
            </div>
        </div>
        <div class="tour-card" data-id="tanjung_pinang_bintan" data-destination="Tanjung Pinang Bintan" data-topics="Island,Nature">
            <img src="images/TanjungPinang.jpg" alt="Tanjung Pinang Bintan"/>
            <div class="info">
                <h4>Tanjung Pinang & Bintan Retreat</h4>
                <p>Relax on Bintan's pristine beaches and explore Tanjung Pinang's charm.</p>
            </div>
        </div>
        <div class="tour-card" data-id="karimun_island" data-destination="Karimun Island" data-topics="Island,Nature">
            <img src="images/KarimunIsland.jpg" alt="Karimun Island"/>
            <div class="info">
                <h4>Karimun Island Adventure</h4>
                <p>Experience the untouched beauty and serene atmosphere of Karimun Island.</p>
            </div>
        </div>
        <div class="tour-card" data-id="sabah" data-destination="Sabah" data-topics="Nature,Culture">
            <img src="images/Sabah.jpg" alt="Sabah"/>
            <div class="info">
                <h4>Explore Wild Sabah</h4>
                <p>Journey through Sabah's rainforests, mountains, and cultural heritage.</p>
            </div>
        </div>
        <div class="tour-card" data-id="sarawak" data-destination="Sarawak" data-topics="Nature,Culture">
            <img src="images/Sarawak.jpg" alt="Sarawak"/>
            <div class="info">
                <h4>Sarawak Cultural Discovery</h4>
                <p>Uncover Sarawak's indigenous cultures and natural wonders.</p>
            </div>
        </div>
        <div class="tour-card" data-id="langkawi" data-destination="Langkawi" data-topics="Island,Nature">
            <img src="images/Langkawi.jpg" alt="Langkawi"/>
            <div class="info">
                <h4>Langkawi Island Paradise</h4>
                <p>Enjoy Langkawi's stunning beaches, geological wonders, and duty-free shopping.</p>
            </div>
        </div>
        <div class="tour-card" data-id="hat_yai" data-destination="Hat Yai" data-topics="Culture,Food">
            <img src="images/Hatyai.png" alt="Hat Yai"/>
            <div class="info">
                <h4>Hat Yai City Delights</h4>
                <p>Explore Hat Yai's bustling markets, temples, and delicious street food.</p>
            </div>
        </div>
        </div>
</div>

<div class="modal-overlay" id="tourDetailModal">
    <div class="modal-content">
        <button class="modal-close-btn">&times;</button>
        <img src="" alt="Tour Image" class="modal-image" id="modalTourImage">
        <h3 id="modalTourTitle"></h3>
        <p id="modalTourIntro"></p>
        
        <h4>Packages We Provide:</h4>
        <ul id="modalPackageList" class="modal-package-list">
            </ul>

        <h4>Gallery:</h4>
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
    const tourCards = document.querySelectorAll('.tour-card');
    
    // Modal Elements
    const tourDetailModal = document.getElementById('tourDetailModal');
    const modalCloseBtn = tourDetailModal.querySelector('.modal-close-btn');
    const modalTourImage = document.getElementById('modalTourImage');
    const modalTourTitle = document.getElementById('modalTourTitle');
    const modalTourIntro = document.getElementById('modalTourIntro');
    const modalPackageList = document.getElementById('modalPackageList');
    const modalGallery = document.getElementById('modalGallery');
    const modalInquireBtn = document.getElementById('modalInquireBtn');


    // 🌟 Define detailed tour data here 🌟
    // This can be fetched from a database in a more complex setup
    const tourData = {
        umrah: {
            title: "Umrah Journey",
            intro: "Embark on a blessed spiritual journey to the Holy Land with Qaid Travel's comprehensive Umrah packages, designed for comfort and peace of mind.",
            image: "images/Umrah.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di lokasi berdekatan Masjidil Haram (Makkah) dan Masjid Nabawi (Madinah)",
                "<strong>Lawatan penuh ke tempat bersejarah</strong> di Mekah seperti Jabal Nur, Jabal Thur, Arafah, Muzdalifah, Mina, Ja'ranah, dan Hudaibiyah.",
                "<strong>Lawatan penuh ke tempat bersejarah</strong> di Madinah seperti Masjid Quba', Jabal Uhud, Masjid Qiblatain, dan Ladang Kurma.",
                "<strong>Makanan</strong> yang sedap dan menyelerakan sepanjang perjalanan",
                "<strong>Pemandu pelancong berpengalaman</strong> yang akan menemani sepanjang perjalanan (Mutawwif & Mutawwifah)",
                "Kursus Umrah Intensif (sebelum keberangkatan)",
                "Bimbingan Ibadah sepanjang Umrah",
                "Troli bagasi, beg sandang, beg silang & buku panduan Umrah"
            ],
            gallery: [
                { src: "images/umrah_gallery/masjidQuba.jpg", name: "Masjid Quba", description: "The first mosque built by Prophet Muhammad (PBUH)." },
                { src: "images/umrah_gallery/madinah.png", name: "Madinah", description: "The illuminated city, second holiest site in Islam." },
                { src: "images/umrah_gallery/JabalRahmah.jpg", name: "Jabal Rahmah", description: "The Mount of Mercy in Arafat, site of Prophet Muhammad's last sermon." },
                { src: "images/umrah_gallery/masjidNabawi.jpg", name: "Masjid Nabawi", description: "The Prophet's Mosque in Madinah, containing Prophet Muhammad's tomb." },
            ]
        },
        japan: {
            title: "Discover Japan: Cherry Blossom & Culture Tour",
            intro: "Immerse yourself in the captivating blend of traditional culture and modern marvels of Japan, with a special focus on Muslim-friendly experiences.",
            image: "images/Japan.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel Muslim-friendly terpilih",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Tokyo, Kyoto, Osaka, dan Nara.",
                "<strong>Makanan</strong> yang disahkan atau ramah Muslim",
                "<strong>Pemandu pelancong berpengalaman</strong> yang mesra Muslim",
                "Pengangkutan awam yang efisien (termasuk Shinkansen/Bullet train)"
            ],
            gallery: [
                { src: "images/japan_gallery/Fuji.jpg", name: "Mount Fuji", description: "Japan's iconic sacred mountain." },
                { src: "images/japan_gallery/KyotoTemple.jpg", name: "Kinkaku-ji Temple (Kyoto)", description: "The Golden Pavilion, a stunning Zen Buddhist temple." },
                { src: "images/japan_gallery/Shibuya.jpg", name: "Shibuya Crossing (Tokyo)", description: "One of the world's busiest intersections." },
                { src: "images/japan_gallery/Arashiyama.jpg", name: "Arashiyama Bamboo Grove (Kyoto)", description: "Serene bamboo forest, a natural wonder." },
            ]
        },
        korea: {
            title: "Korea Autumn Tour: A Scenic Halal Experience",
            intro: "Experience the vibrant autumn colors and rich cultural heritage of South Korea, with specially curated itineraries that cater to Muslim travelers.",
            image: "images/Korea.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel selesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Nami Island, Gyeongbokgung Palace, Seoul Tower, dan banyak lagi",
                "<strong>Makanan</strong> yang lazat dan pelbagai",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/korea_gallery/NamiIsland.jpg", name: "Nami Island", description: "A beautiful, half-moon shaped island known for its natural beauty." },
                { src: "images/korea_gallery/SeoulTower.jpg", name: "N Seoul Tower", description: "An iconic landmark offering panoramic views of Seoul." },
                { src: "images/korea_gallery/Gyeongbokgung.jpg", name: "Gyeongbokgung Palace", description: "The largest of the Five Grand Palaces built during the Joseon Dynasty." },
                { src: "images/korea_gallery/KoreanFood.jpg", name: "Halal Korean Cuisine", description: "Savoring delicious and diverse halal dishes in Korea." },
            ]
        },
        turki: {
            title: "Travel to Turkiye: Where East Meets West",
            intro: "Explore the majestic landscapes and ancient wonders of Turkiye, a country rich in Islamic history and breathtaking beauty.",
            image: "images/Turki.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotel berkualiti",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Istanbul (Hagia Sophia, Blue Mosque, Topkapi Palace), Cappadocia (Hot Air Balloon optional), Pamukkale, Ephesus, dan Bursa.",
                "<strong>Makanan</strong> tempatan yang otentik",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                { src: "images/turki_gallery/Cappadocia.jpg", name: "Cappadocia", description: "Famous for its unique 'fairy chimney' rock formations and hot air balloon rides." },
                { src: "images/turki_gallery/HagiaSophia.jpg", name: "Hagia Sophia (Istanbul)", description: "A grand architectural marvel, originally a church, then a mosque, now a mosque again." },
                { src: "images/turki_gallery/BlueMosque.jpg", name: "Blue Mosque (Istanbul)", description: "Known for its stunning blue tiles and six minarets." },
                { src: "images/turki_gallery/Pamukkale.jpg", name: "Pamukkale", description: "Terraces of white mineral-rich thermal waters." },
            ]
        },
        jakarta: {
            title: "Jakarta City Tour & Cultural Experience",
            intro: "Discover the dynamic capital of Indonesia, Jakarta, a city brimming with history, modern architecture, and vibrant local life, with a focus on Muslim-friendly spots.",
            image: "images/Jakarta.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotels terpilih",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Monumen Nasional (Monas), Masjid Istiqlal, Kota Tua Jakarta, dan pusat membeli-belah terkemuka.",
                "<strong>Makanan</strong> tempatan yang pelbagai",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan persendirian sepanjang lawatan"
            ],
            gallery: [
                { src: "images/jakarta_gallery/Monas.jpg", name: "Monas (National Monument)", description: "The iconic symbol of Indonesia's independence." },
                { src: "images/jakarta_gallery/IstiqlalMosque.jpeg", name: "Istiqlal Mosque", description: "The largest mosque in Southeast Asia." },
                { src: "images/jakarta_gallery/KotaTua.jpg", name: "Kota Tua (Old Town)", description: "Historic colonial district with museums and cafes." },
                { src: "images/jakarta_gallery/JakartaFood.jpg", name: "Halal Indonesian Food", description: "Savoring traditional halal Indonesian dishes." },
            ]
        },
        vietnam: {
            title: "Vietnam Cultural & Scenic Journey",
            intro: "Uncover the rich history, vibrant culture, and breathtaking natural beauty of Vietnam, with an itinerary that includes Muslim-friendly dining and experiences.",
            image: "images/Vietnam.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotelselesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Hanoi (Old Quarter, Hoan Kiem Lake), Halong Bay (cruise), dan Ho Chi Minh City (Cu Chi Tunnels, Ben Thanh Market).",
                "<strong>Makanan</strong> tempatan yang otentik",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                { src: "images/vietnam_gallery/HalongBay.jpg", name: "Halong Bay", description: "A UNESCO World Heritage site known for its emerald waters and towering limestone islands." },
                { src: "images/vietnam_gallery/HanoiOldQuarter.jpg", name: "Hanoi Old Quarter", description: "The historic heart of Hanoi, bustling with markets and ancient streets." },
                { src: "images/vietnam_gallery/BenThanhMarket.jpg", name: "Ben Thanh Market (Ho Chi Minh)", description: "A vibrant market offering local goods and street food." },
                { src: "images/vietnam_gallery/CuChiTunnels.jpg", name: "Cu Chi Tunnels", description: "An intricate underground network used during the Vietnam War." },
            ]
        },
        thailand: {
            title: "Thailand Explorer Tour: Temples & Tropical Islands",
            intro: "Explore the diverse wonders of Thailand, from the bustling streets of Bangkok to the serene beauty of its islands, all with Muslim-friendly considerations.",
            image: "images/Thailand.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel-hotel berkualiti",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Bangkok (Grand Palace, floating markets), Phuket (beaches, islands), Chiang Mai (temples, elephants).",
                "<strong>Makanan</strong> yang mudah didapati dan sedap",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                { src: "images/thailand_gallery/BangkokTemple.jpg", name: "Wat Arun (Bangkok)", description: "The Temple of Dawn, a stunning riverside temple." },
                { src: "images/thailand_gallery/PhuketBeach.jpeg", name: "Phuket Beach", description: "Enjoy the beautiful beaches and turquoise waters." },
                { src: "images/thailand_gallery/FloatMarket.jpg", name: "Floating Market", description: "Experience traditional Thai commerce on water." },
                { src: "images/thailand_gallery/ChiangMai.jpg", name: "Chiang Mai", description: "Explore ancient temples and elephant sanctuaries." },
            ]
        },
        england: {
            title: "London & UK Heritage Tour",
            intro: "Discover the iconic landmarks and rich history of London and beyond, offering a cultural journey with options for Muslim-friendly dining and facilities.",
            image: "images/London.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pusat bandar",
                "<strong>Lawatan penuh ke tempat menarik</strong> di London (Big Ben, Tower Bridge, British Museum, Buckingham Palace), dan pilihan ke bandar lain seperti Manchester atau Edinburgh.",
                "Pilihan <strong>restoran</strong> yang pelbagai",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan awam (kereta api, bas) dan pengangkutan persendirian untuk lawatan tertentu"
            ],
            gallery: [
                { src: "images/london_gallery/BigBen.jpg", name: "Big Ben", description: "The iconic clock tower next to the Houses of Parliament." },
                { src: "images/london_gallery/TowerBridge.jpg", name: "Tower Bridge", description: "A famous landmark bridge over the River Thames." },
                { src: "images/london_gallery/BuckinghamPalace.jpg", name: "Buckingham Palace", description: "The official residence of the Monarch of the United Kingdom." },
                { src: "images/london_gallery/LondonEye.jpg", name: "London Eye", description: "A giant Ferris wheel on the South Bank of the River Thames." },
            ]
        },
        // New tour data added below
        batam: {
            title: "Batam Island Escape",
            intro: "Discover the vibrant island of Batam, known for its beautiful beaches, duty-free shopping, and lively entertainment.",
            image: "images/Batam.jpeg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di resort atau hotel pilihan",
                "<strong>Lawatan bandar</strong> termasuk nagoya hill, enggal batam",
                "<strong>Makanan</strong> tempatan yang lazat",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/batam_gallery/BatamBeach.jpg", name: "Nongsa Beach and Coast", description: "Relax on the sandy beaches of Batam." },
                { src: "images/batam_gallery/NagoyaHillShoppingMall.jpg", name: "Nagoya Hill Shopping Mall", description: "Enjoy duty-free shopping and entertainment." }
            ]
        },
        tanjung_pinang_bintan: {
            title: "Tanjung Pinang & Bintan Retreat",
            intro: "Experience the serene beauty of Bintan's pristine beaches and the historical charm of Tanjung Pinang, Indonesia.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di resort mewah",
                "<strong>Lawatan tempat bersejarah</strong> seperti candi 1000 patung",
                "<strong>Makanan</strong> yang lazat dan pelbagai",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/tanjungPinang_gallery/BintanBeach.jpg", name: "Bintan Beach", description: "White sand beaches and clear waters." },
                { src: "images/tanjungPinang_gallery/PinangCity.jpg", name: "Tanjung Pinang City", description: "Explore the capital city's historical sites." }
            ]
        },
        karimun_island: {
            title: "Karimun Island Adventure",
            intro: "Uncover the untouched natural beauty and serene atmosphere of Karimun Island, a hidden gem in Indonesia.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Tiket feri pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel yang selesa",
                "<strong>Aktiviti pantai</strong> seperti snorkeling dan menyelam",
                "<strong>Makanan</strong> laut segar",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/karimun_gallery/TanjungGelam.jpg", name: "Tanjung Gelam Beach", description: "Relax on secluded beaches." },
                { src: "images/karimun_gallery/karimunSnorkelling.jpg", name: "Snorkeling", description: "Discover the vibrant marine life." }
            ]
        },
        sabah: {
            title: "Explore Wild Sabah",
            intro: "Journey through the lush rainforests, majestic mountains, and rich cultural heritage of Sabah, Malaysian Borneo.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel dan resort",
                "<strong>Lawatan ke Taman Negara Kinabalu</strong>, Lok Kawi Wildlife Park",
                "<strong>Makanan</strong> tempatan",
                "Pemandu pelancong berpengalaman",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/sabah_gallery/Kinabalu.jpg", name: "Mount Kinabalu", description: "Malaysia's highest peak." },
                { src: "images/sabah_gallery/orangUtan.jpg", name: "Orangutan Sanctuary", description: "Meet the iconic orangutans." }
            ]
        },
        sarawak: {
            title: "Sarawak Cultural Discovery",
            intro: "Uncover the diverse indigenous cultures and breathtaking natural wonders of Sarawak, the largest state in Malaysia.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel dan homestay",
                "<strong>Lawatan ke Kampung Budaya Sarawak</strong>, Gua Mulu (optional)",
                "<strong>Makanan</strong> tradisi Sarawak",
                "Pemandu pelancong berpengalaman",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/placeholder.jpg", name: "Sarawak Cultural Village", description: "Experience Sarawak's diverse ethnic groups." },
                { src: "images/placeholder.jpg", name: "Mulu Caves", description: "Explore magnificent cave systems." }
            ]
        },
        kuching: {
            title: "Kuching City Charm",
            intro: "Discover the historical sites, vibrant markets, and delicious local cuisine of Kuching, the capital city of Sarawak.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel pusat bandar",
                "<strong>Lawatan ke Waterfront Kuching</strong>, Astana, Muzium Sarawak",
                "<strong>Makanan</strong> tempatan yang terkenal",
                "Pemandu pelancong tempatan",
                "Pengangkutan dalam bandar"
            ],
            gallery: [
                { src: "images/placeholder.jpg", name: "Kuching Waterfront", description: "Stroll along the picturesque Sarawak River." },
                { src: "images/placeholder.jpg", name: "Sarawak Museum", description: "Discover the rich history and culture of Sarawak." }
            ]
        },
        langkawi: {
            title: "Langkawi Island Paradise",
            intro: "Indulge in the stunning beaches, geological wonders, and duty-free shopping of Langkawi, Malaysia's jewel of Kedah.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Tiket penerbangan/feri pergi balik</strong>",
                "<strong>Penginapan</strong> di resort atau hotel pilihan",
                "<strong>Lawatan ke Langkawi Sky Bridge</strong>, Underwater World Langkawi",
                "<strong>Makanan</strong> laut segar",
                "Pengangkutan disediakan"
            ],
            gallery: [
                { src: "images/placeholder.jpg", name: "Langkawi Sky Bridge", description: "Walk on a suspended bridge with panoramic views." },
                { src: "images/placeholder.jpg", name: "Eagle Square", description: "Iconic landmark of Langkawi." }
            ]
        },
        hat_yai: {
            title: "Hat Yai City Delights",
            intro: "Explore the bustling markets, ornate temples, and delicious street food that make Hat Yai a vibrant city in Southern Thailand.",
            image: "images/placeholder.jpg",
            packages: [
                "<strong>Pengangkutan</strong> (bas/kereta api)",
                "<strong>Penginapan</strong> di hotel pusat bandar",
                "<strong>Lawatan ke Pasaran Terapung Khlong Hae</strong>, Wat Hat Yai Nai (sleeping Buddha)",
                "<strong>Makanan</strong> jalanan Thai yang autentik",
                "Pemandu pelancong tempatan"
            ],
            gallery: [
                { src: "images/placeholder.jpg", name: "Khlong Hae Floating Market", description: "Experience unique market shopping on water." },
                { src: "images/placeholder.jpg", name: "Wat Hat Yai Nai", description: "Visit the temple with a giant reclining Buddha." }
            ]
        }
    };

      function filterTours() {
        const selectedDestination = destinationFilter.value;
        const selectedTopics = Array.from(topicCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        tourCards.forEach(card => {
            const matchesDestination = !selectedDestination || card.dataset.destination === selectedDestination;
            const cardTopics = card.dataset.topics.split(',');
            const matchesTopics = selectedTopics.length === 0 || selectedTopics.some(topic => cardTopics.includes(topic));
            
            // Corrected line: Setting display to empty string lets CSS rules apply
            card.style.display = matchesDestination && matchesTopics ? '' : 'none'; 
        });
    }

    destinationFilter.addEventListener('change', filterTours);
    topicCheckboxes.forEach(cb => cb.addEventListener('change', filterTours));

    function resetFilters() {
        destinationFilter.value = '';
        topicCheckboxes.forEach(cb => cb.checked = false);
        filterTours();
    }

    function generateDestinationOptions() {
        const destinationsSet = new Set();
        tourCards.forEach(card => {
            const destination = card.dataset.destination;
            if (destination) destinationsSet.add(destination);
        });

        const sortedDestinations = Array.from(destinationsSet).sort();

        sortedDestinations.forEach(dest => {
            const option = document.createElement('option');
            option.value = dest;
            option.textContent = dest;
            destinationFilter.appendChild(option);
        });
    }

    generateDestinationOptions(); // Call on load

    // --- Modal Logic ---
    tourCards.forEach(card => {
        card.addEventListener('click', () => {
            const tourId = card.dataset.id;
            const tour = tourData[tourId];

            if (tour) {
                modalTourImage.src = tour.image;
                modalTourImage.alt = tour.title;
                modalTourTitle.textContent = tour.title;
                modalTourIntro.textContent = tour.intro;

                // Clear previous packages and add new ones
                modalPackageList.innerHTML = '';
                tour.packages.forEach(pkg => {
                    const li = document.createElement('li');
                    li.innerHTML = pkg; // Use innerHTML to allow bold tags
                    modalPackageList.appendChild(li);
                });

                // Clear previous gallery images and add new ones
                modalGallery.innerHTML = '';
                tour.gallery.forEach(imgData => {
                    const galleryItemDiv = document.createElement('div');
                    galleryItemDiv.classList.add('modal-gallery-item');

                    const img = document.createElement('img');
                    img.src = imgData.src;
                    img.alt = imgData.name;
                    galleryItemDiv.appendChild(img);

                    const namePara = document.createElement('p');
                    namePara.classList.add('name');
                    namePara.textContent = imgData.name;
                    galleryItemDiv.appendChild(namePara);

                    const descPara = document.createElement('p');
                    descPara.classList.add('description');
                    descPara.textContent = imgData.description;
                    galleryItemDiv.appendChild(descPara);

                    modalGallery.appendChild(galleryItemDiv);
                });

                // Update "Inquire About This Tour" button link
                modalInquireBtn.href = `contact.php?tour=${encodeURIComponent(tour.title)}`;

                tourDetailModal.classList.add('active'); // Show the modal
            }
        });
    });

    modalCloseBtn.addEventListener('click', () => {
        tourDetailModal.classList.remove('active'); // Hide the modal
    });

    // Close modal if clicked outside content
    tourDetailModal.addEventListener('click', (e) => {
        if (e.target === tourDetailModal) {
            tourDetailModal.classList.remove('active');
        }
    });

</script>

</body>
<?php include 'footer.php'; ?>
</html>