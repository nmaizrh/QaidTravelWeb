<?php

// Include the database connection file.
// Make sure db_connect.php is in the same directory as contact.php.
include 'connect.php';

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get form data
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message_content = htmlspecialchars($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($message_content)) {
        $message = '<p style="color: red;">Sila isikan semua ruangan yang diperlukan.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p style="color: red;">Sila masukkan alamat emel yang sah.</p>';
    } elseif (!preg_match('/^[0-9]{7,15}$/', $phone)) {
        $message = '<p style="color: red;">Sila masukkan nombor telefon yang sah (7-15 digit sahaja, tanpa ruang atau simbol).</p>';
    } else {
        // The $conn object from db_connect.php is available here.
        // It's good practice to ensure the connection is still valid, though db_connect.php uses die() on failure.
        if ($conn->connect_error) {
            $message = '<p style="color: red;">Gagal menyambung ke pangkalan data. Sila cuba lagi nanti. (' . $conn->connect_error . ')</p>';
        } else {
            // Prepare an SQL statement to insert data into the 'client' table.
            // Ensure these column names ('name', 'email', 'phone', 'subject', 'message')
            // exactly match the ones you defined in your 'client' table in phpMyAdmin.
            $stmt = $conn->prepare("INSERT INTO client (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");

            if ($stmt === false) {
                $message = '<p style="color: red;">Gagal menyediakan kenyataan: ' . $conn->error . '</p>';
            } else {
                // Bind parameters to the prepared statement.
                // 'sssss' indicates five string parameters.
                $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message_content);

                // Execute the statement
                if ($stmt->execute()) {
                    $message = '<p style="color: green;">Terima kasih atas pertanyaan anda, ' . $name . '! Mesej anda telah dihantar dengan jayanya.</p>';
                    // Clear form fields after successful submission to make the form ready for a new entry.
                    $_POST = array();
                } else {
                    $message = '<p style="color: red;">Ralat menyimpan mesej anda: ' . $stmt->error . '</p>';
                }

                // Close the statement
                $stmt->close();
            }
            // The database connection ($conn) will automatically close when the script finishes.
            // If you had more database operations later in the same script, you wouldn't close it here.
            // $conn->close(); // Uncomment if you want to explicitly close it now.
        }
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
        /* CSS styles for the contact form and info */
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
        .contact-form input[type="tel"],
        .contact-form textarea {
            width: calc(100% - 20px); /* Adjust for padding */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .contact-form textarea {
            resize: vertical; /* Allow vertical resizing */
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
    <?php include "header.php"; // Includes the navigation header ?>

    <main>
        <section>
            <h2 class="section-title">Hubungi Kami</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 30px;">
                <strong>Terdapat soalan, perlukan bantuan atau bersedia untuk menempah pengembaraan seterusnya?</strong> Isikan borang di bawah dan kami akan menghubungi anda dengan segera.
            </p>

            <div class="contact-form">
                <?php echo $message; // Display success or error messages here ?>
                <form action="contact.php" method="POST">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required value="<?php echo $_POST['name'] ?? ''; ?>">

                    <label for="email">Emel:</label>
                    <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">

                    <label for="phone">Nombor Telefon:</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{7,15}" title="Nombor telefon mestilah mengandungi hanya 7 hingga 15 digit." required value="<?php echo $_POST['phone'] ?? ''; ?>">

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
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15949.771120037343!2d102.26189530462943!3d2.262529241940984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3165b430c6c21323%3A0x6e3d2b2700e3e601!2sAyer%20Keroh%2C%20Melaka%2C%20Malaysia!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
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
    <?php include "footer.php"; // Includes the footer ?>
</body>
</html>