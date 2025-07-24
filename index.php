<?php include 'header.php'; ?>

<section class="hero-slider">
  <div class="slide active">
    <img src="images/Korea.jpg" alt="Korea">
    <div class="overlay">
      <h3>Explore Korea</h3>
      <p>📍National Museum Of Korea, Seoul</p>
    </div>
  </div>
  <div class="slide">
    <img src="images/Japan.jpg" alt="Japan">
    <div class="overlay">
      <h3>Discover Japan</h3>
      <p>📍Arashiyama, Kyoto</p>
    </div>
  </div>
  <div class="slide">
    <img src="images/Umrah.jpg" alt="Umrah">
    <div class="overlay">
      <h3>Umrah Journey</h3>
      <p>📍Station of Ibrahim, Mecca</p>
    </div>
  </div>
  <div class="slide">
    <img src="images/Turki.jpg" alt="Turki">
    <div class="overlay">
      <h3>Travel to Turkiye</h3>
      <p>📍Hagia Sophia Grand Mosque, Istanbul</p>
    </div>
  </div>

  <button class="slider-btn prev">&#10094;</button>
  <button class="slider-btn next">&#10095;</button>
</section>

<section class="intro">
  <h2>Welcome to Qaid Travel</h2>
  <p>Since 2019, we’ve been your trusted Muslim-friendly travel partner. Let us make your travel dreams come true — from Umrah to global adventures.</p>
</section>

<section class="popular-destination">
  <h2 class="section-title">POPULAR DESTINATION</h2>
</section>

<section class="highlights">
  <div class="card" data-id="umrah"> <img src="images/Umrah.jpg" alt="Umrah Package">
    <h3>Umrah Packages</h3>
    <p>Affordable and complete Umrah solutions with guidance</p>
  </div>
  <div class="card" data-id="korea"> <img src="images/Korea.jpg" alt="Korea Trip">
    <h3>Korea Tour</h3>
    <p>Group tours and packages to Korea for students & corporates</p>
  </div>
  <div class="card" data-id="japan"> <img src="images/Japan.jpg" alt="Japan Tour">
    <h3>Japan Tour</h3>
    <p>Customized travel experience with halal options</p>
  </div>

  <div class="show-all-container">
  <a href="tours.php" class="show-all-btn">Show All Tours</a>
</div>
</section>

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

<?php include 'footer.php'; ?>

<script>
  const heroSlides = document.querySelectorAll('.hero-slider .slide');
  const prevBtn = document.querySelector('.slider-btn.prev');
  const nextBtn = document.querySelector('.slider-btn.next');
  let heroIndex = 0;

  function showHeroSlide(index) {
    heroSlides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
    });
  }

  function nextSlide() {
    heroIndex = (heroIndex + 1) % heroSlides.length;
    showHeroSlide(heroIndex);
  }

  function prevSlide() {
    heroIndex = (heroIndex - 1 + heroSlides.length) % heroSlides.length;
    showHeroSlide(heroIndex);
  }

  nextBtn.addEventListener('click', nextSlide);
  prevBtn.addEventListener('click', prevSlide);

  setInterval(nextSlide, 4000);
</script>

<script>
    // Modal Elements (ensure IDs are unique or scope correctly if this script is on a different page than tours.php)
    const tourDetailModal = document.getElementById('tourDetailModal');
    const modalCloseBtn = tourDetailModal.querySelector('.modal-close-btn');
    const modalTourImage = document.getElementById('modalTourImage');
    const modalTourTitle = document.getElementById('modalTourTitle');
    const modalTourIntro = document.getElementById('modalTourIntro');
    const modalPackageList = document.getElementById('modalPackageList');
    const modalGallery = document.getElementById('modalGallery');
    const modalInquireBtn = document.getElementById('modalInquireBtn');

    // Select the cards in the 'highlights' section
    const serviceCards = document.querySelectorAll('.highlights .card');

    // Define detailed tour data here (copied from tours.php)
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
                "<strong>Makanan halal</strong> yang sedap dan menyelerakan sepanjang perjalanan",
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
                "<strong>Makanan halal</strong> yang disahkan atau ramah Muslim",
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
                "<strong>Makanan halal</strong> yang lazat dan pelbagai",
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
                "<strong>Makanan halal</strong> tempatan yang otentik",
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
                "<strong>Penginapan</strong> di hotel-hotel terpilih",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Monumen Nasional (Monas), Masjid Istiqlal, Kota Tua Jakarta, dan pusat membeli-belah terkemuka.",
                "<strong>Makanan halal</strong> tempatan yang pelbagai",
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
        united_arab_emirates: {
            title: "Dubai Luxury & Adventure Tour",
            intro: "Indulge in the extravagance and unique experiences of Dubai and the United Arab Emirates, from stunning skyscrapers to thrilling desert safaris.",
            image: "images/Dubai.jpg",
            packages: [
                "<strong>Tiket penerbangan pergi balik</strong>",
                "<strong>Penginapan</strong> di hotel mewah",
                "<strong>Lawatan penuh ke tempat menarik</strong> seperti Burj Khalifa, The Dubai Mall, Palm Jumeirah, dan Desert Safari",
                "<strong>Makanan halal</strong> yang lazat di restoran terpilih",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan mewah"
            ],
            gallery: [
                { src: "images/dubai_gallery/BurjKhalifa.jpg", name: "Burj Khalifa", description: "The world's tallest building, offering breathtaking views." },
                { src: "images/dubai_gallery/DesertSafari.jpg", name: "Desert Safari", description: "Thrilling dune bashing and desert activities." },
                { src: "images/dubai_gallery/DubaiMarina.jpg", name: "Dubai Marina", description: "A stunning artificial canal city with skyscrapers and promenades." },
                { src: "images/dubai_gallery/DubaiMall.jpg", name: "The Dubai Mall", description: "One of the world's largest shopping malls." },
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
                "<strong>Makanan halal</strong> tempatan yang otentik",
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
                "<strong>Penginapan</strong> di hotel-hotelselesa",
                "<strong>Lawatan penuh ke tempat menarik</strong> di Bangkok (Grand Palace, floating markets), Phuket (beaches, islands), Chiang Mai (temples, elephants).",
                "<strong>Makanan halal</strong> yang mudah didapati dan sedap",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan domestik (penerbangan domestik/bas)"
            ],
            gallery: [
                { src: "images/thailand_gallery/BangkokTemple.jpg", name: "Wat Arun (Bangkok)", description: "The Temple of Dawn, a stunning riverside temple." },
                { src: "images/thailand_gallery/PhuketBeach.jpeg", name: "Phuket Beach", description: "Enjoy the beautiful beaches and turquoise waters." },
                { src: "images/thailand_gallery/FloatingMarket.jpg", name: "Floating Market", description: "Experience traditional Thai commerce on water." },
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
                "Pilihan <strong>restoran halal</strong> yang pelbagai",
                "<strong>Pemandu pelancong berpengalaman</strong>",
                "Pengangkutan awam (kereta api, bas) dan pengangkutan persendirian untuk lawatan tertentu"
            ],
            gallery: [
                { src: "images/london_gallery/BigBen.jpg", name: "Big Ben", description: "The iconic clock tower next to the Houses of Parliament." },
                { src: "images/london_gallery/TowerBridge.jpg", name: "Tower Bridge", description: "A famous landmark bridge over the River Thames." },
                { src: "images/london_gallery/BuckinghamPalace.jpg", name: "Buckingham Palace", description: "The official residence of the Monarch of the United Kingdom." },
                { src: "images/london_gallery/LondonEye.jpg", name: "London Eye", description: "A giant Ferris wheel on the South Bank of the River Thames." },
            ]
        }
    };


    // --- Modal Logic for Service Cards ---
    serviceCards.forEach(card => {
        card.style.cursor = 'pointer'; // Make cards clickable by changing cursor
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

<style>
/* --- Modal Styles (copied from tours.php) --- */
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

/* Add or adjust styles for the .card itself to make it visually clickable */
.highlights .card {
    cursor: pointer; /* Change cursor to pointer to indicate clickability */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover effects */
}

.highlights .card:hover {
    transform: translateY(-5px); /* Lift card on hover */
    box-shadow: 0 4px 15px rgba(0,0,0,0.15); /* Stronger shadow on hover */
}
</style>