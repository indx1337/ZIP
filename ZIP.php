<?php

if (isset($_FILES['zipfile'])) {
    $fileName = $_FILES['zipfile']['name'];
    $tmpName  = $_FILES['zipfile']['tmp_name'];


    if (strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) !== 'zip') {
        echo "only .zip files are allowed";
        exit;
    }

    $zip = new ZipArchive;
    if ($zip->open($tmpName) === TRUE) {
        $zip->extractTo(__DIR__ . '/');
        $zip->close();
        echo "extraction completed.";
    } else {
        echo "failed to open ZIP file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZIP extraction</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="zipfile" accept=".zip" required>
        <button type="submit">upload</button>
    </form>
</body>
</html>