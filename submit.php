<?php
// Path to the CSV file
$csvFile = 'registrations.csv';

// Get form data
$name = trim($_POST['name']);
$email = trim($_POST['email']);

// Check if the CSV file exists
if (!file_exists($csvFile)) {
    // If it doesn't exist, create it and add the headers
    $file = fopen($csvFile, 'w');
    fputcsv($file, ['ID', 'Name', 'Email']);
    fclose($file);
}

// Generate registration ID
$csvData = file($csvFile);
$registrationID = strtolower(substr($name, 0, 4)) . str_pad(count($csvData), 4, '0', STR_PAD_LEFT);

// Open the CSV file to append the new registration
$file = fopen($csvFile, 'a');

// Check if the email already exists in the CSV to prevent duplicates
$duplicate = false;
foreach ($csvData as $line) {
    $data = str_getcsv($line);
    if (strtolower($data[2]) === strtolower($email)) {
        $duplicate = true;
        break;
    }
}

if (!$duplicate) {
    // Add the registration data to the CSV file
    fputcsv($file, [$registrationID, $name, $email]);
    echo $registrationID;  // Return only the registration ID
} else {
    echo 'duplicate';
}

// Close the CSV file
fclose($file);
?>
