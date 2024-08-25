import os
import subprocess
import sys

# Change to the directory containing your PHP files
os.chdir('/data/data/com.termux/files/home/Hack')

# Ask the user for the port number
try:
    port = int(input('Which port? '))
except ValueError:
    print("Invalid port number.")
    sys.exit(1)

# Start the PHP built-in server with the user-specified port
print(f"Starting PHP server on port {port}...")
php_server = subprocess.Popen(['php', '-S', f'localhost:{port}'])

# Perform SSH port forwarding
print(f"Setting up SSH port forwarding on port {port}...")
ssh_command = ['ssh', '-R', f'80:localhost:{port}', 'serveo.net']
try:
    subprocess.run(ssh_command, check=True)
except subprocess.CalledProcessError as e:
    print(f"SSH command failed: {e}")
    php_server.terminate()  # Stop PHP server if SSH fails
    sys.exit(1)
