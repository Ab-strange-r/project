<?php
// This script should return a JSON array of notes and their PDF URLs
// For simplicity, we'll use a hardcoded array, but this could be fetched from a database

$notes = [
    ["category" => "नेपाल राष्ट्रिय बैंक, नेपाल बैंक लिमिटेड etc notes", "pdfUrl" => "pdfs/note1.pdf"],
    ["category" => "Nepal Bank limited Notes by prabin sir", "pdfUrl" => "pdfs/note2.pdf"],
    ["category" => "ना.सु,खरिदार, सुब्बा etc notes", "pdfUrl" => "pdfs/note3.pdf"]
];

header('Content-Type: application/json');
echo json_encode($notes);
?>
