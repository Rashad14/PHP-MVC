<?php

require_once __DIR__ . '/../application/controllers/TextController.php';

$controller = new TextController();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleFormSubmission();
}

// Display the form and texts
include __DIR__ . '/../application/views/form.php';

// Retrieve all texts
$texts = $controller->displayAllTexts();

