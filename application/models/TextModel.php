<?php

class TextModel
{
    private $db;

    public function __construct()
    {
        $this->db = require_once __DIR__ . '/../../config/database.php';
    }

    public function saveText($text)
    {
        // Generate a unique identifier
        $identifier = uniqid();

        // Prepare and execute the SQL statement to insert the data
        $statement = $this->db->prepare("INSERT INTO texts (identifier, text) VALUES (:identifier, :text)");
        $statement->bindParam(':identifier', $identifier);
        $statement->bindParam(':text', $text);
        $statement->execute();

        // Return the generated identifier
        return $identifier;
    }

    public function getAllTexts()
    {
        // Prepare and execute the SQL statement to select all texts
        $statement = $this->db->query("SELECT text FROM texts ORDER BY id DESC");
        $texts = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Return the array of texts
        return $texts;
    }
}
