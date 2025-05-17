<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->setupSMTP();
    }

    private function setupSMTP()
    {
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com"; // Change to your SMTP server
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "trymywebsites@gmail.com"; // Your email
        $this->mail->Password = "nmhw uxqv vvpl fbvp"; // Your email password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
        $this->mail->isHTML(true);
    }

    public function sendQuoteEmail($toEmail, $toName, $phoneNumber, $cart, $orderID)
    {
        try {
            $this->mail->setFrom('trymywebsites@gmail.com', 'Sree Varsha Engineering Works');
            $this->mail->addAddress("saranmass685@gmail.com"); // Send to user email
            $this->mail->Subject = "Products Quote Request";

            // Email body with user phone number
            $emailContent = "<h2>Quote Request from $toName</h2>";
            $emailContent .= "<p><strong>Order ID:</strong> $orderID</p>";
            $emailContent .= "<p><strong>Email Address:</strong> $toEmail</p>";
            $emailContent .= "<p><strong>Phone Number:</strong> $phoneNumber</p>";
            $emailContent .= "<table border='1' cellpadding='10' cellspacing='0' width='100%'>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>";

            foreach ($cart as $item) {
                $imageUrl = "https://demo1.trymywebsites.com/dashboard/uploads/products/" . basename($item['image']);
                $price = $item['price'] > 0 ? "₹{$item['price']}" : "Price on request";

                $emailContent .= "<tr>
                    <td>{$item['name']}</td>
                    <td><img src='{$imageUrl}' alt='{$item['name']}' width='80' height='80' style='border-radius: 8px;'></td>
                    <td>$price</td>
                    <td>{$item['quantity']}</td>
                </tr>";
            }
            $emailContent .= "</table>";

            $this->mail->Body = $emailContent;

            if ($this->mail->send()) {
                return ["success" => true];
            } else {
                return ["success" => false, "message" => "Mail sending failed"];
            }
        } catch (Exception $e) {
            return ["success" => false, "message" => "Mailer Error: " . $this->mail->ErrorInfo];
        }
    }
}

?>