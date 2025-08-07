<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Qaid Travel Sdn Bhd</title>
    <!-- Your existing stylesheet -->
    <link rel="stylesheet" href="style.css" />
    <style>
        /* New styling for the header to use the image as a background */
        header {
            /* Menggunakan imej yang betul sebagai latar belakang */
            background-image: url('images/QaidHeader.png');
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
    </style>
</head>
<body>
    <header>
        <div class="logo-box">
            <img src="images/QaidTravel2.png" alt="Qaid Travel Logo" width="250" height="100" />
        </div>
        <div class="welcome-box">
            <h1>Selamat Datang ke Qaid Travel</h1>
            <p>Ingat Melancong, Ingat Qaid Travel. "Keperluan Anda Kami Sempurnakan."</p>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="tours.php">Lawatan</a></li>
                <li><a href="corporate.php">Korporat</a></li>
                <li><a href="about.php">Mengenai Kami</a></li>
                <li><a href="contact.php">Hubungi Kami</a></li>
                <li><a href="testimonials.php">Testimoni</a></li>
            </ul>
        </nav>
    </header>
    <main>
