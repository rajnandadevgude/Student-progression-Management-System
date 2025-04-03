<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'];
    $data = $_POST['data'];

    // Open the file for writing
    if (($handle = fopen("files/" . $filename, 'w')) !== false) {
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
        echo "Changes saved successfully!";
    } else {
        echo "Error opening the file!";
    }
} else {
    echo "Invalid request!";
}
?>
