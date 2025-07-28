<?php
// In a real application, you would handle form submission here
// e.g., send an email, save to database.

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Basic form validation and processing
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? ''); // Added phone number
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message_content = htmlspecialchars($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($message_content)) {
        $message = '<p style="color: red;">Please fill in all required fields.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p style="color: red;">Please enter a valid email address.</p>';
    } elseif (!preg_match('/^[0-9]{7,15}$/', $phone)) { // Updated: Only allows digits
        $message = '<p style="color: red;">Please enter a valid phone number (7-15 digits only, no spaces or symbols).</p>';
    }
    else {
        // Here you would add code to send an email or save to a database
        // For demonstration, we'll just show a success message
        $message = '<p style="color: green;">Thank you for your inquiry, ' . $name . '! We will get back to you soon.</p>';
        // Clear form fields after successful submission
        $_POST = array(); 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Qaid Travel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .contact-form {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
        }
        .contact-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #b62626;
        }
        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form input[type="tel"], /* Retained input[type="tel"] */
        .contact-form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .contact-form textarea {
            resize: vertical;
            min-height: 120px;
        }
        .contact-form button {
            background-color: #b62626;
            color: #fff;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-form button:hover {
            background-color: #7c1919;
        }
        .contact-info {
            text-align: center;
            margin-top: 40px;
        }
        .contact-info p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php include "header.php" ?>

    <main>
        <section>
            <h2 class="section-title">Hubungi Kami</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
                <strong>Terdapat soalan, perlukan bantuan atau bersedia untuk menempah pengembaraan seterusnya?</strong> Isikan borang di bawah dan kami akan menghubungi anda dengan segera.
            </p>

            <div class="contact-form">
                <?php echo $message; // Display messages here ?>
                <form action="contact.php" method="POST">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required value="<?php echo $_POST['name'] ?? ''; ?>">

                    <label for="email">Emel:</label>
                    <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">
                    
                    <label for="phone">Nombor Telefon:</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{7,15}" title="Phone number must contain only 7 to 15 digits." required value="<?php echo $_POST['phone'] ?? ''; ?>">
                    
                    <label for="subject">Subjek:</label>
                    <input type="text" id="subject" name="subject" value="<?php echo $_GET['tour'] ?? ($_POST['subject'] ?? ''); ?>">

                    <label for="message_content">Mesej:</label>
                    <textarea id="message_content" name="message" required><?php echo $_POST['message'] ?? ''; ?></textarea>

                    <button type="submit">Hantar Mesej</button>
                </form>
            </div>
        </section>

        <section>
            <h2 class="section-title">Butiran untuk Hubungan Kami</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
                Anda juga boleh menghubungi kami secara terus melalui telefon, emel atau melawat pejabat kami semasa waktu perniagaan.
            </p>
            <div class="contact-info">
                <p><strong>Alamat Qaid Travel:</strong></p>
                <div style="flex: 1; min-width: 300px;">
                    <iframe 
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.685283828871!2d102.27992237348866!3d2.270765157927067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e50d415e3df7%3A0x4c2dc8bdcf420076!2sQAID%20TRAVEL%20SDN%20BHD!5e0!3m2!1sen!2smy!4v1753171441663!5m2!1sen!2smy" 
                      width="100%" 
                      height="250" 
                      style="border:0; border-radius: 8px; margin-bottom: 15px;" 
                      allowfullscreen="" 
                      loading="lazy" 
                      referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p><strong>Telefon:</strong> +06-2312300</p>
                <p><strong>Emel:</strong> qaidtravelsb@gmail.com</p>
                <p><strong>Waktu Operasi:</strong> Isnin - Jumaat, 9:00 AM - 5:30 PM</p>
            </div>
        </section>
    </main>
</body>
<?php include "footer.php" ?>
</html>