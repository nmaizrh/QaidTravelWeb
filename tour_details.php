<?php
// In a real application, you would fetch tour data from a database
// based on an ID passed in the URL (e.g., tour_details.php?id=1).
// For this example, we'll use placeholder data.

$tour = [
    'id' => 1,
    'name' => 'Discover Japan: Cherry Blossom & Culture Tour',
    'location' => 'Tokyo, Kyoto, Osaka',
    'duration' => '7 Days / 6 Nights',
    'price' => 'RM 5,500',
    'image' => 'japan-cherry-blossom.jpg', // Make sure this image exists or link a placeholder
    'description' => 'Embark on an unforgettable journey through Japan during the magical cherry blossom season. Explore ancient temples, bustling cities, and serene landscapes, all while enjoying Muslim-friendly amenities and Halal dining options.',
    'itinerary' => [
        'Day 1' => 'Arrival in Tokyo, transfer to hotel. Free & easy.',
        'Day 2' => 'Tokyo City Tour: Imperial Palace, Senso-ji Temple, Shibuya Crossing. Halal dinner.',
        'Day 3' => 'Bullet train to Kyoto. Explore Arashiyama Bamboo Grove, Kinkaku-ji (Golden Pavilion).',
        'Day 4' => 'Kyoto Cultural Immersion: Fushimi Inari Shrine, Gion district. Traditional tea ceremony.',
        'Day 5' => 'Day trip to Nara: Todai-ji Temple, Nara Park (deer).',
        'Day 6' => 'Travel to Osaka. Visit Osaka Castle, Dotonbori. Farewell Halal dinner.',
        'Day 7' => 'Departure from Osaka.'
    ],
    'inclusions' => [
        'Round-trip flight tickets (economy class)',
        '6 nights accommodation in 4-star Muslim-friendly hotels',
        'Daily Halal breakfast, 5 Halal lunches, 5 Halal dinners',
        'Airport transfers and inter-city transportation',
        'Experienced English-speaking Muslim tour guide',
        'All entrance fees as per itinerary',
        'Travel insurance'
    ],
    'exclusions' => [
        'Visa fees (if applicable)',
        'Personal expenses',
        'Tips for guide and driver'
    ],
    'notes' => 'This tour is designed with specific considerations for Muslim travelers, including prayer times and Halal food provisions. Itinerary is subject to change based on local conditions.'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tour['name']; ?> - Qaid Travel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <img src="your-logo.png" alt="Qaid Travel Logo">
        <h1>Qaid Travel</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="tours.php">Tours</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="testimonials.php">Testimonials</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="tour-detail">
            <h2 class="section-title"><?php echo $tour['name']; ?></h2>
            <div class="tour-image">
                <img src="images/<?php echo $tour['image']; ?>" alt="<?php echo $tour['name']; ?>">
            </div>

            <div class="tour-info">
                <p><strong>Location:</strong> <?php echo $tour['location']; ?></p>
                <p><strong>Duration:</strong> <?php echo $tour['duration']; ?></p>
                <p><strong>Price from:</strong> <?php echo $tour['price']; ?></p>
            </div>

            <section>
                <h3>Tour Overview</h3>
                <p><?php echo $tour['description']; ?></p>
            </section>

            <section>
                <h3>Detailed Itinerary</h3>
                <ul>
                    <?php foreach ($tour['itinerary'] as $day => $description): ?>
                        <li><strong><?php echo $day; ?>:</strong> <?php echo $description; ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section>
                <h3>What's Included</h3>
                <ul>
                    <?php foreach ($tour['inclusions'] as $item): ?>
                        <li><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section>
                <h3>What's Not Included</h3>
                <ul>
                    <?php foreach ($tour['exclusions'] as $item): ?>
                        <li><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section>
                <h3>Important Notes</h3>
                <p><?php echo $tour['notes']; ?></p>
            </section>

            <div class="show-all-container">
                <a href="contact.php?tour=<?php echo urlencode($tour['name']); ?>" class="show-all-btn">Inquire About This Tour</a>
            </div>

        </section>
    </main>

    <footer class="site-footer">
        <div class="social-icons">
            <a href="https://facebook.com/qaidtravel" target="_blank"><img src="facebook.png" alt="Facebook"></a>
            <a href="https://instagram.com/qaidtravel" target="_blank"><img src="instagram.png" alt="Instagram"></a>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Qaid Travel. All rights reserved.</p>
    </footer>

</body>
</html>