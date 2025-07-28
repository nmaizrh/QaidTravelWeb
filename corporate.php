<?php
// PHP logic for handling corporate tours

// In a real application, you would fetch corporate tours from a database
// or a specific data source. For demonstration, we'll use a simple array.

// This array mimics your tour structure but specifically for corporate/VIP tours.
// You would populate this with actual corporate tour data.
$corporateTours = [
    [
        'id' => 'corp1',
        'image' => 'images/corporate_melaka.jpg', // Placeholder image
        'title' => 'Lawatan Korporat Melaka Bersejarah',
        'description' => 'Pakej eksklusif untuk delegasi korporat ke tapak warisan Melaka dengan kemudahan premium.',
        'destination' => 'Melaka',
        'topic' => ['Budaya & Warisan'],
        'details' => [
            'overview' => 'Lawatan khas yang direka untuk kumpulan korporat yang ingin menikmati sejarah dan budaya Melaka dalam suasana yang selesa dan eksklusif. Termasuk penginapan 5 bintang, makan malam gala, dan akses VVIP.',
            'packages' => [
                'Pakej Platinum: 3 Hari 2 Malam',
                'Pakej Emas: 2 Hari 1 Malam',
            ],
            'gallery' => [
                ['img' => 'images/corp_melaka_gala.jpg', 'name' => 'Makan Malam Gala', 'description' => 'Majlis makan malam eksklusif di lokasi bersejarah.'],
                ['img' => 'images/corp_melaka_meeting.jpg', 'name' => 'Kemudahan Mesyuarat', 'description' => 'Bilik mesyuarat dilengkapi sepenuhnya untuk keperluan korporat.'],
            ]
        ]
    ],
    [
        'id' => 'corp2',
        'image' => 'images/corporate_langkawi.jpg', // Placeholder image
        'title' => 'Retret Korporat Langkawi & Pembinaan Pasukan',
        'description' => 'Retret mewah dengan aktiviti pembinaan pasukan di pulau Langkawi yang indah, sesuai untuk eksekutif.',
        'destination' => 'Langkawi',
        'topic' => ['Alam Semula Jadi & Pengembaraan'],
        'details' => [
            'overview' => 'Program retret korporat yang komprehensif di Langkawi, menggabungkan rehat, keseronokan, dan aktiviti pembinaan pasukan yang berkesan. Termasuk penginapan di resort terkemuka dan aktiviti sukan air peribadi.',
            'packages' => [
                'Pakej Eksekutif: 4 Hari 3 Malam',
                'Pakej Premium: 3 Hari 2 Malam',
            ],
            'gallery' => [
                ['img' => 'images/corp_langkawi_yacht.jpg', 'name' => 'Pelayaran Yacht Peribadi', 'description' => 'Pengalaman pelayaran mewah sekitar pulau.'],
                ['img' => 'images/corp_langkawi_team.jpg', 'name' => 'Aktiviti Pembinaan Pasukan', 'description' => 'Sesi pembinaan pasukan di tepi pantai.'],
            ]
        ]
    ],
    [
        'id' => 'corp3',
        'image' => 'images/corporate_kualalumpur.jpg', // Placeholder image
        'title' => 'Lawatan Eksekutif Kuala Lumpur',
        'description' => 'Lawatan khas ke mercu tanda utama Kuala Lumpur dengan pengangkutan dan perkhidmatan VVIP.',
        'destination' => 'Kuala Lumpur',
        'topic' => ['Bandar & Gaya Hidup'],
        'details' => [
            'overview' => 'Terokai Kuala Lumpur dengan cara yang paling eksklusif. Lawatan ini menawarkan akses pantas ke tarikan utama, pengalaman membeli-belah peribadi, dan makan malam di restoran bertaraf Michelin.',
            'packages' => [
                'Pakej Bandar Elit: 2 Hari 1 Malam',
                'Pakej Premium KL: 1 Hari Penuh',
            ],
            'gallery' => [
                ['img' => 'images/corp_kl_skyline.jpg', 'name' => 'Pemandangan Bandar', 'description' => 'Pemandangan eksklusif dari bangunan tertinggi.'],
                ['img' => 'images/corp_kl_dining.jpg', 'name' => 'Santapan Mewah', 'description' => 'Pengalaman makan di restoran terbaik.'],
            ]
        ]
    ],
];


// Filter logic (similar to tours.php, but applied to corporateTours)
$filteredTours = $corporateTours; // Start with all corporate tours
$destinationFilter = $_GET['destination'] ?? '';
$topicFilters = $_GET['topic'] ?? [];
$searchQuery = $_GET['search'] ?? '';

// Apply destination filter
if (!empty($destinationFilter)) {
    $filteredTours = array_filter($filteredTours, function($tour) use ($destinationFilter) {
        return $tour['destination'] === $destinationFilter;
    });
}

// Apply topic filters
if (!empty($topicFilters)) {
    $filteredTours = array_filter($filteredTours, function($tour) use ($topicFilters) {
        foreach ($topicFilters as $topic) {
            if (in_array($topic, $tour['topic'])) {
                return true;
            }
        }
        return false;
    });
}

// Apply search query filter
if (!empty($searchQuery)) {
    $searchQuery = strtolower($searchQuery);
    $filteredTours = array_filter($filteredTours, function($tour) use ($searchQuery) {
        return str_contains(strtolower($tour['title']), $searchQuery) ||
               str_contains(strtolower($tour['description']), $searchQuery);
    });
}

// Pagination logic
$itemsPerPage = 6; // Number of corporate tours per page
$totalItems = count($filteredTours);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages > 0 ? $totalPages : 1)); // Ensure current page is within bounds

$startIndex = ($currentPage - 1) * $itemsPerPage;
$currentItems = array_slice($filteredTours, $startIndex, $itemsPerPage);

// Unique destinations and topics for filters (from ALL corporate tours)
$allDestinations = array_unique(array_column($corporateTours, 'destination'));
$allTopics = [];
foreach ($corporateTours as $tour) {
    $allTopics = array_merge($allTopics, $tour['topic']);
}
$allTopics = array_unique($allTopics);
sort($allDestinations);
sort($allTopics);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korporat - Qaid Travel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS styles here (copy from tours.php's style block, adjust as needed) */
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .tour-list {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: flex-start;
            flex-grow: 1;
        }

        .tour-card {
            flex-basis: calc(33.333% - 20px);
            flex-grow: 0;
            flex-shrink: 0;
            max-width: 350px;
            background-color: #fff;
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
            max-width: 1200px;
            margin: auto;
            align-items: flex-start;
            background-color: #b62626; /* Changed background for 'Korporat' page */
            border-radius: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .filter-panel {
            flex-shrink: 0;
            width: 320px;
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
            color: #b62626; /* Label color for filters */
        }

        .filter-group select,
        .filter-group input[type="text"] { /* Added input[type="text"] for search filter */
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            box-sizing: border-box;
            border-radius: 6px;
            border: 1px solid #ccc;
            min-width: 100%;
            margin-bottom: 10px; /* Spacing for search input */
        }

        .filter-group input[type="checkbox"] {
            margin-right: 8px;
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

        /* Search input specific styles */
        .filter-group #searchFilter {
            padding: 8px 12px;
            font-size: 1rem;
            border-radius: 5px;
            border: 2px solid #b62626;
            background-color: #fff;
            color: #333;
            width: calc(100% - 100px); /* Adjust width to make space for button */
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-block; /* For side-by-side with button */
            vertical-align: middle;
        }

        .search-btn {
            background-color: #b62626;
            color: #fff;
            padding: 8px 12px; /* Adjusted padding */
            font-size: 0.9rem; /* Adjusted font size */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-left: 5px; /* Smaller margin */
            display: inline-block; /* For side-by-side with input */
            vertical-align: middle;
        }

        .search-btn:hover {
            background-color: #7c1919;
            transform: scale(1.02);
        }

        /* No results message */
        #noResultsMessage {
            display: none; /* Controlled by JS */
            text-align: center;
            color: #ffffff; /* White text for no results message */
            margin-top: 20px;
            font-weight: bold;
            flex-basis: 100%; /* Make it take full width in flex container */
            padding: 20px;
            background-color: rgba(0,0,0,0.2); /* Slightly transparent background */
            border-radius: 8px;
        }

        /* Tour card specifics */
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

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            padding: 10px;
            background-color: transparent; /* Changed background for pagination */
            border-radius: 8px;
            box-shadow: none; /* No shadow for pagination */
        }

        .pagination a {
            color: #ffffff; /* White text for pagination links */
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            border-radius: 5px;
            margin: 0 5px;
            font-weight: bold;
        }

        .pagination a.active {
            background-color: #b62626;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        /* Modal styles (copy and paste from tours.php if it's external) */
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
            max-height: 90vh;
            overflow-y: auto;
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
            list-style: disc;
            margin-left: 20px;
        }
        .modal-package-list strong {
            color: #b62626;
        }

        .modal-gallery {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }
        .modal-gallery-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
        }
        .modal-gallery-item img {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .modal-gallery-item .name {
            font-weight: bold;
            color: #333;
            font-size: 1.1em;
            margin-bottom: 5px;
        }
        .modal-gallery-item .description {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>

<main>
    <div class="tours-container">
        <div class="filter-panel">
            <h3>Tapis</h3>
            <form id="filterForm" action="korporat.php" method="GET">
                <div class="filter-group">
                    <label for="destination">Destinasi:</label>
                    <select id="destination" name="destination" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Destinasi</option>
                        <?php foreach ($allDestinations as $dest): ?>
                            <option value="<?php echo htmlspecialchars($dest); ?>"
                                <?php echo ($destinationFilter === $dest) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($dest); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Topik:</label>
                    <?php
                    $topicsMap = [
                        'Budaya & Warisan' => 'Budaya & Warisan',
                        'Alam Semula Jadi & Pengembaraan' => 'Alam Semulajadi & Kembara',
                        'Makanan & Minuman' => 'Makanan & Minuman',
                        'Pulau & Pantai' => 'Pulau & Pantai',
                        'Bandar & Gaya Hidup' => 'Bandar & Gaya Hidup' // Added for corporate tours
                    ];
                    foreach ($allTopics as $topic): ?>
                        <div>
                            <input type="checkbox" id="topic_<?php echo str_replace(' ', '_', $topic); ?>"
                                   name="topic[]" value="<?php echo htmlspecialchars($topic); ?>"
                                <?php echo in_array($topic, $topicFilters) ? 'checked' : ''; ?>
                                   onchange="document.getElementById('filterForm').submit()">
                            <label for="topic_<?php echo str_replace(' ', '_', $topic); ?>"><?php echo htmlspecialchars($topicsMap[$topic] ?? $topic); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="filter-group">
                    <label for="searchFilter">Cari Destinasi:</label>
                    <input type="text" id="searchFilter" name="search" placeholder="Cari lawatan..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit" class="search-btn">Cari</button>
                </div>

                <button type="button" class="show-all-btn" onclick="window.location.href='korporat.php'">Tunjuk Semua</button>
            </form>
        </div>

        <div class="tour-list">
            <?php if (empty($currentItems)): ?>
                <div id="noResultsMessage">
                    Tiada destinasi ditemui untuk carian anda.
                </div>
            <?php else: ?>
                <?php foreach ($currentItems as $tour): ?>
                    <div class="tour-card" data-tour-id="<?php echo htmlspecialchars($tour['id']); ?>">
                        <img src="<?php echo htmlspecialchars($tour['image']); ?>" alt="<?php echo htmlspecialchars($tour['title']); ?>">
                        <div class="info">
                            <h4><?php echo htmlspecialchars($tour['title']); ?></h4>
                            <p><?php echo htmlspecialchars($tour['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?php echo $currentPage - 1; ?>&destination=<?php echo htmlspecialchars($destinationFilter); ?>&<?php echo http_build_query(['topic' => $topicFilters]); ?>&search=<?php echo htmlspecialchars($searchQuery); ?>">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&destination=<?php echo htmlspecialchars($destinationFilter); ?>&<?php echo http_build_query(['topic' => $topicFilters]); ?>&search=<?php echo htmlspecialchars($searchQuery); ?>"
                   class="<?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?php echo $currentPage + 1; ?>&destination=<?php echo htmlspecialchars($destinationFilter); ?>&<?php echo http_build_query(['topic' => $topicFilters]); ?>&search=<?php echo htmlspecialchars($searchQuery); ?>">&raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div id="tourModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close-btn">&times;</button>
            <img src="" alt="" class="modal-image">
            <h3 class="modal-title"></h3>
            <p class="modal-overview"></p>
            <h4>Pakej Tersedia:</h4>
            <ul class="modal-package-list"></ul>
            <div class="modal-gallery"></div>
        </div>
    </div>

</main>

<script>
    // JavaScript for Modal (copy from tours.php if it's external)
    document.addEventListener('DOMContentLoaded', function() {
        const tourCards = document.querySelectorAll('.tour-card');
        const modalOverlay = document.getElementById('tourModal');
        const closeModalBtn = document.querySelector('.modal-close-btn');
        const modalImage = document.querySelector('.modal-image');
        const modalTitle = document.querySelector('.modal-title');
        const modalOverview = document.querySelector('.modal-overview');
        const modalPackageList = document.querySelector('.modal-package-list');
        const modalGallery = document.querySelector('.modal-gallery');

        const corporateToursData = <?php echo json_encode($corporateTours); ?>;

        tourCards.forEach(card => {
            card.addEventListener('click', function() {
                const tourId = this.dataset.tourId;
                const tour = corporateToursData.find(t => t.id === tourId);

                if (tour) {
                    modalImage.src = tour.image;
                    modalImage.alt = tour.title;
                    modalTitle.textContent = tour.title;
                    modalOverview.textContent = tour.details.overview;

                    // Clear previous packages
                    modalPackageList.innerHTML = '';
                    tour.details.packages.forEach(pkg => {
                        const li = document.createElement('li');
                        li.innerHTML = `<strong>${pkg}</strong>`;
                        modalPackageList.appendChild(li);
                    });

                    // Clear previous gallery items
                    modalGallery.innerHTML = '';
                    if (tour.details.gallery && tour.details.gallery.length > 0) {
                        tour.details.gallery.forEach(item => {
                            const galleryItemDiv = document.createElement('div');
                            galleryItemDiv.classList.add('modal-gallery-item');

                            const img = document.createElement('img');
                            img.src = item.img;
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
                    }

                    modalOverlay.classList.add('active');
                }
            });
        });

        closeModalBtn.addEventListener('click', function() {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        // Handle no results message visibility
        const noResultsMessage = document.getElementById('noResultsMessage');
        if (corporateToursData.length === 0) { // Check the full data array, not just currentItems for initial load
             // No, this should check if filteredTours is empty, not corporateToursData
             // Let's refine this to check $currentItems directly as it reflects the paginated and filtered result
        }
        // Corrected logic for showing no results message
        if (<?php echo json_encode(empty($currentItems)); ?>) {
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }
    });
</script>

<?php include "footer.php"; ?>
</body>
</html>