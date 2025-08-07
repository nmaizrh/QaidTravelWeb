<?php include 'header.php'; ?>

<section class="hero-slider">
  <div class="slide active">
    <img src="images/Korea.jpg" alt="Korea">
    <div class="overlay">
      <h3>Jelajahi Korea</h3>
      <p>📍Muzium Nasional Korea, Seoul</p>
    </div>
  </div>
  <div class="slide">
    <img src="images/Japan.jpg" alt="Japan">
    <div class="overlay">
      <h3>Temui Jepun</h3>
      <p>📍Arashiyama, Kyoto</p>
    </div>
  </div>
  <div class="slide">
    <img src="images/Umrah.jpg" alt="Umrah">
    <div class="overlay">
      <h3>Perjalanan Umrah</h3>
      <p>📍Maqam Ibrahim, Mekah</p>
    </div>
  </div>
  <div class="slide">
    <img src="images/Turki.jpg" alt="Turki">
    <div class="overlay">
      <h3>Melancong ke Turki</h3>
      <p>📍Masjid Besar Hagia Sophia, Istanbul</p>
    </div>
  </div>

  <button class="slider-btn prev">&#10094;</button>
  <button class="slider-btn next">&#10095;</button>
</section>

<section class="intro">
  <p>Sejak 2019 kami telah menjadi rakan kongsi pelancongan mesra Muslim anda yang dipercayai. Kami komited dalam membantu anda merealisasikan impian
    dalam menjelajah destinasi dunia dengan penuh keyakinan dan keselesaan.</p>
</section>

<section class="popular-destination">
  <h2 class="section-title">DESTINASI POPULAR</h2>
</section>

<section class="highlights">
  <div class="card" data-id="umrah"> <img src="images/Umrah.jpg" alt="Umrah Package">
    <h3>Pakej Umrah</h3>
    <p>Penyelesaian Umrah yang berpatutan dan lengkap dengan bimbingan</p>
  </div>
  <div class="card" data-id="korea"> <img src="images/Korea.jpg" alt="Korea Trip">
    <h3>Lawatan Korea</h3>
    <p>Lawatan berkumpulan dan pakej ke Korea untuk pelajar & korporat</p>
  </div>
  <div class="card" data-id="japan"> <img src="images/Japan.jpg" alt="Japan Tour">
    <h3>Lawatan Jepun</h3>
    <p>Pengalaman perjalanan yang disesuaikan dengan pilihan halal</p>
  </div>

  <div class="show-all-container">
  <a href="tours.php" class="show-all-btn">Tunjukkan Semua Lawatan</a>
</div>
</section>

<div class="modal-overlay" id="tourDetailModal">
    <div class="modal-content">
        <button class="modal-close-btn">&times;</button>
        <img src="" alt="Imej Lawatan" class="modal-image" id="modalTourImage">
        <h3 id="modalTourTitle"></h3>
        <p id="modalTourIntro"></p>
        
        <h4>Pakej Yang Kami Sediakan:</h4>
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
        title: "Perjalanan Umrah: Ziarah Rohani & Bimbingan",
        intro: "Mulakan perjalanan rohani yang diberkati ke Tanah Suci dengan pakej Umrah komprehensif Qaid Travel, direka untuk keselesaan dan ketenangan fikiran.",
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
            { src: "images/umrah_gallery/masjidQuba.jpg", name: "Masjid Quba", description: "Masjid pertama yang dibina oleh Nabi Muhammad (SAW)." },
            { src: "images/umrah_gallery/madinah.png", name: "Madinah", description: "Kota yang bercahaya, tapak kedua tersuci dalam Islam." },
            { src: "images/umrah_gallery/JabalRahmah.jpg", name: "Jabal Rahmah", description: "Gunung Rahmat di Arafah, tapak khutbah terakhir Nabi Muhammad." },
            { src: "images/umrah_gallery/masjidNabawi.jpg", name: "Masjid Nabawi", description: "Masjid Nabi di Madinah, mengandungi makam Nabi Muhammad." },
        ]
        },
        japan: {
        title: "Temui Jepun: Lawatan Bunga Sakura & Budaya",
        intro: "Benamkan diri anda dalam gabungan budaya tradisional dan keajaiban moden Jepun yang menawan, dengan tumpuan khusus kepada pengalaman mesra Muslim.",
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
            { src: "images/japan_gallery/Fuji.jpg", name: "Gunung Fuji", description: "Gunung suci ikonik Jepun." },
            { src: "images/japan_gallery/KyotoTemple.jpg", name: "Kuil Kinkaku-ji (Kyoto)", description: "Pavilion Emas, sebuah kuil Buddha Zen yang menakjubkan." },
            { src: "images/japan_gallery/Shibuya.jpg", name: "Persimpangan Shibuya (Tokyo)", description: "Salah satu persimpangan paling sibuk di dunia." },
            { src: "images/japan_gallery/Arashiyama.jpg", name: "Hutan Buluh Arashiyama (Kyoto)", description: "Hutan buluh yang tenang, keajaiban alam." },
        ]
        },
        korea: {
        title: "Lawatan Musim Luruh Korea: Pengalaman Pemandangan Indah",
        intro: "Alami warna-warni musim luruh yang ceria dan warisan budaya Korea Selatan yang kaya, dengan jadual perjalanan yang direka khas untuk pelancong Muslim.",
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
            { src: "images/korea_gallery/NamiIsland.jpg", name: "Pulau Nami", description: "Sebuah pulau indah berbentuk separuh bulan yang terkenal dengan keindahan semula jadi." },
            { src: "images/korea_gallery/SeoulTower.jpg", name: "Menara N Seoul", description: "Mercu tanda ikonik yang menawarkan pemandangan panorama Seoul." },
            { src: "images/korea_gallery/Gyeongbokgung.jpg", name: "Istana Gyeongbokgung", description: "Istana terbesar dari Lima Istana Agung yang dibina semasa Dinasti Joseon." },
            { src: "images/korea_gallery/KoreanFood.jpg", name: "Masakan Halal Korea", description: "Menikmati hidangan halal yang lazat dan pelbagai di Korea." },
        ]
        },
        turki: {
        title: "Melancong ke Turki: Di Mana Timur Bertemu Barat",
        intro: "Terokai landskap megah dan keajaiban purba Turki, sebuah negara yang kaya dengan sejarah Islam dan keindahan yang menakjubkan.",
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
            { src: "images/turki_gallery/Cappadocia.jpg", name: "Cappadocia", description: "Terkenal dengan formasi batuan 'cerobong pari-pari' yang unik dan menaiki belon udara panas." },
            { src: "images/turki_gallery/HagiaSophia.jpg", name: "Hagia Sophia (Istanbul)", description: "Keajaiban seni bina yang agung, asalnya gereja, kemudian masjid, kini masjid semula." },
            { src: "images/turki_gallery/BlueMosque.jpg", name: "Masjid Biru (Istanbul)", description: "Terkenal dengan jubin biru yang menakjubkan dan enam menara." },
            { src: "images/turki_gallery/Pamukkale.jpg", name: "Pamukkale", description: "Teres air terma kaya mineral putih." },
        ]
        },
        jakarta: {
        title: "Lawatan Bandar & Pengalaman Budaya Jakarta",
        intro: "Temui ibu kota dinamik Indonesia, Jakarta, sebuah bandar yang kaya dengan sejarah, seni bina moden, dan kehidupan tempatan yang bersemangat, dengan tumpuan pada tempat-tempat mesra Muslim.",
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
            { src: "images/jakarta_gallery/Monas.jpg", name: "Monas (Monumen Nasional)", description: "Simbol ikonik kemerdekaan Indonesia." },
            { src: "images/jakarta_gallery/IstiqlalMosque.jpeg", name: "Masjid Istiqlal", description: "Masjid terbesar di Asia Tenggara." },
            { src: "images/jakarta_gallery/KotaTua.jpg", name: "Kota Tua", description: "Daerah kolonial bersejarah dengan muzium dan kafe." },
            { src: "images/jakarta_gallery/JakartaFood.jpg", name: "Makanan Halal Indonesia", description: "Menikmati hidangan tradisional halal Indonesia." },
        ]
        },
        vietnam: {
        title: "Perjalanan Budaya & Pemandangan Vietnam",
        intro: "Temui sejarah yang kaya, budaya yang rancak, dan keindahan alam semula jadi Vietnam yang menakjubkan, dengan jadual perjalanan yang merangkumi pilihan makanan dan pengalaman mesra Muslim.",
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
            { src: "images/vietnam_gallery/HalongBay.jpg", name: "Teluk Halong", description: "Tapak Warisan Dunia UNESCO yang terkenal dengan air zamrud dan pulau batu kapur menjulang tinggi." },
            { src: "images/vietnam_gallery/HanoiOldQuarter.jpg", name: "Kota Lama Hanoi", description: "Jantung bersejarah Hanoi, sibuk dengan pasar dan jalan-jalan purba." },
            { src: "images/vietnam_gallery/BenThanhMarket.jpg", name: "Pasar Ben Thanh (Ho Chi Minh)", description: "Sebuah pasar yang meriah menawarkan barangan tempatan dan makanan jalanan." },
            { src: "images/vietnam_gallery/CuChiTunnels.jpg", name: "Terowong Cu Chi", description: "Rangkaian bawah tanah yang rumit digunakan semasa Perang Vietnam." },
        ]
        },
        thailand: {
        title: "Lawatan Penerokaan Thailand: Kuil & Pulau Tropika",
        intro: "Terokai keajaiban Thailand yang pelbagai, dari jalan-jalan sibuk Bangkok hingga keindahan pulau-pulau yang tenang, semuanya dengan pertimbangan mesra Muslim.",
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
            { src: "images/thailand_gallery/BangkokTemple.jpg", name: "Wat Arun (Bangkok)", description: "Kuil Fajar, sebuah kuil tepi sungai yang menakjubkan." },
            { src: "images/thailand_gallery/PhuketBeach.jpeg", name: "Pantai Phuket", description: "Nikmati pantai-pantai indah dan air biru kehijauan." },
            { src: "images/thailand_gallery/FloatingMarket.jpg", name: "Pasar Terapung", description: "Alami perdagangan tradisional Thai di atas air." },
            { src: "images/thailand_gallery/ChiangMai.jpg", name: "Chiang Mai", description: "Terokai kuil-kuil purba dan tempat perlindungan gajah." },
        ]
        },
        england: {
        title: "Lawatan Warisan London & UK",
        intro: "Temui mercu tanda ikonik dan sejarah kaya London dan kawasan sekitarnya, menawarkan perjalanan budaya dengan pilihan makanan dan kemudahan mesra Muslim.",
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
            { src: "images/london_gallery/BigBen.jpg", name: "Big Ben", description: "Menara jam ikonik di sebelah Bangunan Parlimen." },
            { src: "images/london_gallery/TowerBridge.jpg", name: "Tower Bridge", description: "Jambatan mercu tanda terkenal di atas Sungai Thames." },
            { src: "images/london_gallery/BuckinghamPalace.jpg", name: "Istana Buckingham", description: "Kediaman rasmi Raja United Kingdom." },
            { src: "images/london_gallery/LondonEye.jpg", name: "London Eye", description: "Roda Ferris gergasi di Tebing Selatan Sungai Thames." },
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