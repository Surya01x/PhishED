import qrcode

# Message you want to show when QR is scanned
message = "Warning: QR Code Phishing (Quishing)!  You 'scanned' a malicious QR code. These codes can lead to fake websites designed to steal your login credentials or install malware, just like malicious links. Always verify the source of QR codes."

# Create QR code
qr = qrcode.QRCode(
    version=1,  # size of the QR code (1 = small)
    error_correction=qrcode.constants.ERROR_CORRECT_H,
    box_size=10,
    border=4,
)

qr.add_data(message)
qr.make(fit=True)

# Create image
img = qr.make_image(fill_color="black", back_color="white")

# Save QR code
img.save("message_qr.png")

print("QR Code generated successfully as message_qr.png")
