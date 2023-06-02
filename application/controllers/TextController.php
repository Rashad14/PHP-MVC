<?php

require_once __DIR__ . '/../models/TextModel.php';
require_once __DIR__ . '/../models/EmailSender.php';
require_once __DIR__ . '/../models/SMSSender.php';

class TextController
{
    private $textModel;

    public function __construct()
    {
        $this->textModel = new TextModel();
    }

    public function handleFormSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the text input is empty
            if (empty($_POST['text'])) {
                // Redirect back to the form page with an error message
                header('Location: ' . __DIR__ . '/../views/form.php?error=empty');
                exit();
            }
            // Apply appropriate security measures
            $text = $this->sanitizeText($_POST['text']);

            // Save the text to the database and get the identifier
            $identifier = $this->textModel->saveText($text);

            // Send email and SMS (implementation not provided, only class structure)
            $emailSender = new EmailSender();
            $smsSender = new SMSSender();

            // Sanitize text before sending
            $sanitizedText = $this->sanitizeTextForSending($text);

            // Send email
            $emailSender->sendEmail('receiver@example.com', 'New Text', $sanitizedText);

            // Send SMS
            $smsSender->sendSMS('1234567890', $sanitizedText);

            // Set success message
            $_SESSION['success_message'] = 'Text submitted successfully!';

            // Redirect back to the form page
            header('Location: ' . __DIR__ . '/../../public/index.php');
            exit();
        }
    }

    public function displayAllTexts()
    {
        // Retrieve all the texts from the database
        $texts = $this->textModel->getAllTexts();

        // Include the display.php file and pass the texts as a variable
        require_once __DIR__ . '/../views/display.php';
    }

    private function sanitizeText($text)
    {
        // Apply appropriate sanitization techniques to prevent SQL injection and XSS attacks
        $sanitizedText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        // ... Additional sanitization steps if required

        return $sanitizedText;
    }

    private function sanitizeTextForSending($text)
    {
        // Apply appropriate sanitization techniques to prevent issues in email and SMS
        $sanitizedText = strip_tags($text);
        // ... Additional sanitization steps if required

        return $sanitizedText;
    }
}
