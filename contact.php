<?php
// In a real application, you would handle form submission here
// e.g., send an email, save to database.

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Basic form validation and processing
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message_content = htmlspecialchars($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message_content)) {
        $message = '<p style="color: red;">Please fill in all required fields.</p>';
    } else {
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
    <title>Contact Us - Qaid Travel</title>
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
            <h2 class="section-title">Contact Us</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
                <strong>Have a question, need assistance or ready to book your next adventure?</strong> Fill out the form below and we'll get back to you promptly.
            </p>

            <div class="contact-form">
                <?php echo $message; // Display messages here ?>
                <form action="contact.php" method="POST">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required value="<?php echo $_POST['name'] ?? ''; ?>">

                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">
                    
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" value="<?php echo $_GET['tour'] ?? ($_POST['subject'] ?? ''); ?>">

                    <label for="message_content">Message:</label>
                    <textarea id="message_content" name="message" required><?php echo $_POST['message'] ?? ''; ?></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </section>

        <section>
            <h2 class="section-title">Our Contact Details</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
                You can also reach us directly via phone, email, or visit our office during business hours.
            </p>
            <div class="contact-info">
                <p><strong>Address:</strong></p>
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
                <p><strong>Phone:</strong> +06-2312300</p>
                <p><strong>Email:</strong> qaidtravelsb@gmail.com</p>
                <p><strong>Operating Hours:</strong> Monday - Friday, 9:00 AM - 5:30 PM</p>
            </div>
        </section>
    </main>
</body>
<?php include "footer.php" ?>
</html>