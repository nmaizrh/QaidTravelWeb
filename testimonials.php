<?php
// Start a session to store temporary feedback.
session_start();

// Sample Testimonials Data
// In a real application, this data would likely come from a database.
$testimonials = [
    [
        'name' => 'Ahmad bin Abdullah',
        'quote' => 'Perjalanan Umrah bersama Qaid Travel adalah pengalaman yang sangat bermakna dan lancar. Segala urusan diuruskan dengan sempurna, dari penginapan hingga bimbingan ibadah. Sangat disyorkan!',
        'date' => '15 Januari 2024',
        'rating' => 5 // Out of 5
    ],
    [
        'name' => 'Siti Nurhaliza',
        'quote' => 'Lawatan ke Jepun dengan Qaid Travel sungguh menakjubkan! Pilihan makanan halal yang banyak dan pemandu pelancong yang berpengetahuan menjadikan perjalanan ini sangat menyeronokkan dan mudah untuk kami sekeluarga.',
        'date' => '28 Disember 2023',
        'rating' => 5
    ],
    [
        'name' => 'Encik Tan',
        'quote' => 'Saya sangat kagum dengan pakej Korporat ke Melaka. Pengurusan acara yang profesional, kemudahan yang mewah, dan lawatan yang teratur. Pasti akan menggunakan perkhidmatan Qaid Travel lagi untuk acara syarikat kami.',
        'date' => '10 Mac 2024',
        'rating' => 5
    ],
    [
        'name' => 'Puan Lim',
        'quote' => 'Percutian ke Langkawi anjuran Qaid Travel memang syurga! Pantai yang indah, aktiviti yang menyeronokkan, dan penginapan yang selesa. Anak-anak saya sangat gembira.',
        'date' => '5 Februari 2024',
        'rating' => 4
    ],
    [
        'name' => 'Dr. Amir Hamzah',
        'quote' => 'Sebagai seorang yang mementingkan aspek mesra Muslim, Qaid Travel memenuhi semua jangkaan saya. Dari solat hingga makanan, semuanya diuruskan dengan teliti. Terima kasih!',
        'date' => '20 November 2023',
        'rating' => 5
    ],
    [
        'name' => 'Cik Sofia',
        'quote' => 'Lawatan ke Korea semasa musim luruh sangat cantik. Pemandangan yang menakjubkan dan pengalaman budaya yang mendalam. Walaupun ada sedikit kelewatan, pasukan Qaid Travel menguruskannya dengan baik.',
        'date' => '12 Oktober 2023',
        'rating' => 4
    ]
];

// PHP code to handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate user input
    $name = htmlspecialchars($_POST['name'] ?? '');
    $quote = htmlspecialchars($_POST['quote'] ?? '');
    $rating = intval($_POST['rating'] ?? 0);

    // Basic validation
    if (!empty($name) && !empty($quote) && $rating > 0 && $rating <= 5) {
        $newTestimonial = [
            'name' => $name,
            'quote' => $quote,
            'date' => date('d M Y'), // Set current date
            'rating' => $rating
        ];

        // Store the new testimonial in a session array
        // In a real application, you would insert this into a database.
        $_SESSION['user_testimonials'][] = $newTestimonial;

        // Redirect to the same page to prevent form resubmission
        header('Location: testimonials.php');
        exit;
    }
}

// Merge new user-submitted testimonials with the existing ones
if (isset($_SESSION['user_testimonials'])) {
    // Add new testimonials to the beginning of the array for a "latest first" effect
    $testimonials = array_merge($_SESSION['user_testimonials'], $testimonials);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni - Qaid Travel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Specific styles for the Testimonials page */
        .testimonials-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            justify-content: center;
        }

        .testimonial-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 25px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .testimonial-card .quote {
            font-style: italic;
            color: #555;
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 1.05rem;
        }

        .testimonial-card .author {
            font-weight: bold;
            color: #b62626; /* Matches your brand color */
            margin-top: auto; /* Pushes author to the bottom */
            font-size: 1.1rem;
        }

        .testimonial-card .date {
            font-size: 0.85rem;
            color: #888;
            margin-top: 5px;
        }

        .testimonial-card .rating {
            margin-top: 10px;
            color: #FFD700; /* Gold color for stars */
            font-size: 1.2rem;
        }

        /* Styles for the feedback form */
        .feedback-form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .feedback-form-container h3 {
            text-align: center;
            color: #b62626;
            margin-bottom: 25px;
        }

        .feedback-form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #b62626;
        }

        .feedback-form-container input[type="text"],
        .feedback-form-container textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .feedback-form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .rating-input {
            margin-bottom: 20px;
        }
        
        .rating-input input {
            display: none;
        }

        .rating-input label {
            font-size: 1.5rem;
            color: #ddd;
            cursor: pointer;
            margin-right: 5px;
            transition: color 0.2s ease;
        }
        
        .rating-input input:checked ~ label,
        .rating-input input:hover ~ label,
        .rating-input label:hover,
        .rating-input label:hover ~ label {
            color: #FFD700;
        }

        .rating-input label:hover ~ label {
            color: #ddd;
        }
        
        .feedback-form-container button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #b62626;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .feedback-form-container button:hover {
            background-color: #7c1919;
        }
        
        /* New styling for the section title */
        .testimonials-container-title {
            text-align: center;
            color: #b62626;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .testimonials-container {
                grid-template-columns: 1fr;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>

<main>
    <section>
        <h2 class="section-title">Testimoni Pelanggan Kami</h2>
        <p style="text-align: center; max-width: 800px; margin: 0 auto 30px; color: #333;">
            Dengar apa kata pelanggan kami tentang pengalaman perjalanan mereka bersama Qaid Travel.
        </p>

        <div class="feedback-form-container">
            <h3>Tinggalkan Ulasan Anda</h3>
            <form action="testimonials.php" method="post">
                <label for="name">Nama Penuh:</label>
                <input type="text" id="name" name="name" required>

                <label for="quote">Ulasan Anda:</label>
                <textarea id="quote" name="quote" required></textarea>

                <div class="rating-input">
                    <p style="margin-bottom: 10px; color: #b62626; font-weight: bold;">Penilaian Anda:</p>
                    <input type="radio" id="star5" name="rating" value="5" required><label for="star5" title="5 stars">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">&#9733;</label>
                </div>

                <button type="submit">Hantar Ulasan</button>
            </form>
        </div>

        <h3 class="testimonials-container-title">Ulasan dari Pelanggan Qaid Travel</h3>
        
        <div class="testimonials-container">
            <?php if (empty($testimonials)): ?>
                <p style="text-align: center; width: 100%; color: #555;">Tiada testimoni tersedia buat masa ini.</p>
            <?php else: ?>
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-card">
                        <p class="quote">"<?php echo htmlspecialchars($testimonial['quote']); ?>"</p>
                        <div class="author-info">
                            <p class="author">- <?php echo htmlspecialchars($testimonial['name']); ?></p>
                            <?php if (isset($testimonial['date'])): ?>
                                <p class="date"><?php echo htmlspecialchars($testimonial['date']); ?></p>
                            <?php endif; ?>
                            <?php if (isset($testimonial['rating'])): ?>
                                <div class="rating">
                                    <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                        &#9733;<?php endfor; ?>
                                    <?php for ($i = $testimonial['rating']; $i < 5; $i++): ?>
                                        &#9734;<?php endfor; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>
</body>
</html>