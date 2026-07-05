
<?php include("auth.php"); ?>
<?php include("header.php"); 
include "session_check.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Phishing Simulation - PhishEd</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #1a202c;
      color: #e2e8f0;
      background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0);
      background-size: 20px 20px;
    }
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      align-items: center;
      justify-content: center;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s;
    }
    .modal-overlay.show {
      display: flex;
      opacity: 1;
    }
    .modal-content-box {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
      max-width: 90%;
      width: 350px;
      text-align: center;
      color: #2d3748;
    }
    .modal-content-box .phish { color: #c53030; }
    .modal-content-box .safe { color: #2f855a; }
    .scroll-animate {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s, transform 0.6s;
    }
    .scroll-animate.in-view {
      opacity: 1;
      transform: translateY(0);
    }
    .tick {
  color: #22c55e;
  font-size: 1.3rem;
  margin-left: 8px;
  display: none;
}
.tick.completed {
  display: inline;
}
    button, .sms-link {
      outline: none !important;
    }
    button:focus, .sms-link:focus {
      box-shadow: 0 0 0 3px #63b3ed;
    }
  </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">



  <header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white text-center py-12 px-4">
  <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Phishing Simulation</h1>
  <p class="text-lg md:text-xl font-light mt-2">
    Learn by experiencing fake attacks and safe choices.
  </p>
</header>

  <main class="max-w-4xl mx-auto py-8 px-4 flex-grow">

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">📧 Email Phishing Simulation</h2>  <span id="tick-email-phishing" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> You received an email claiming you’ve won a free gift card. Should you click the link?</p>
      <div class="border-b border-gray-700 pb-4 mb-4">
        <p class="text-gray-200"><strong>From:</strong> <span class="text-blue-400">support@amaz0n.com</span></p>
        <p class="text-gray-200"><strong>Subject:</strong> Free Gift Card</p>
        <p class="text-gray-200">Dear Customer, You have Won a Free Gift Card.</p>
      </div>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('email-phishing', 'feedback'); showFeedback('Phishing Email Detected','This message uses a fake sender address (amaz0n.com), an unexpected prize, and a suspicious link. Never click!','phish','email-phishing')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('email-phishing', 'simulate'); window.open('fake-offer.html', '_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">🪟 Pop-Up Phishing Simulation</h2><span id="tick-popup-phishing" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> A website popup says, “Claim your free iPhone!” Would you trust it?</p>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('popup-phishing','feedback'); showFeedback('Pop-Up Scam!','Pop-ups offering big prizes are almost always scams. They want you to click so they can steal your info. Ignore and close suspicious pop-ups.','phish','popup-phishing')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('popup-phishing','simulate'); window.open('fake-iphone.html','_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>


<section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
  <h2 class="text-2xl font-semibold text-blue-400 mb-4">📱 SMS (Smishing) & OTP Phishing</h2><span id="tick-sms-otp" class="tick">✔</span>

  <p class="text-gray-300 mb-2"><strong>Scenario:</strong> You received an SMS from an unknown number asking for your OTP. What should you do?</p>
  <div class="flex flex-col md:flex-row gap-4">
    <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
      onclick="handleSimulation('sms-otp','feedback'); showFeedback('Smishing Alert','Never share OTPs from SMS, even if the sender seems real. Scammers trick you into revealing important codes!','phish','sms-otp')">
      Check for Phishing Clues
    </button>
    <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
      onclick="smsOtpSimulation()">
      Click here to Simulate (Safe Learning)
    </button>
  </div>
</section>

<div id="sms-notification-popup" style="display:none; position:fixed; bottom:25px; left:50%; transform:translateX(-50%); background:rgba(0,0,0,0.95); color:white; padding:18px 32px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.3); font-size:1rem; z-index:9999;">
  <div style="width:100%; text-align:center;">
    <span style="font-size:2.2em; display:block; margin-bottom:8px;">💬</span>
  </div>
  <span id="sms-notification-text"></span>
  <br>
  <button onclick="openOtpPage()" style="margin-top:10px; background:#4299e1; color:white; border:none; padding:8px 26px; border-radius:6px; font-weight:600; cursor:pointer;">Go to OTP page</button>
</div>



    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">📷 Camera Access Phishing</h2><span id="tick-camera-sim" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> A website is requesting access to your camera to “verify your identity for security purposes.” What’s the safest choice?</p>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('camera-sim','feedback'); showFeedback('Camera Access Warning','Never allow camera or microphone access unless absolutely necessary—and only if you trust the website. Scammers can abuse device permissions.','phish','camera-sim')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('camera-sim','simulate'); window.open('fake-cam.html','_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">🔒 Ransomware Simulation</h2><span id="tick-ransomware-sim" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> Clicking a suspicious link could trigger a ransomware attack that locks your files and demands payment. What should you consider?</p>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('ransomware-sim','feedback'); showFeedback('Ransomware Warning','Malicious downloads or links can encrypt your files and demand money. Always check links carefully and avoid downloads from unknown sources.','phish','ransomware-sim')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('ransomware-sim','simulate'); window.open('fake-ransomware.html','_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">🌐 Fake Browser Update Phishing</h2><span id="tick-chrome-update" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> A pop-up says, “Your browser is outdated. Update now!” Should you trust it?</p>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('chrome-update','feedback'); showFeedback('Browser Update Scam','Never download updates from pop-ups. Always update through your browser’s official settings or website to stay safe.','phish','chrome-update')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('chrome-update','simulate'); window.open('fake-chrome-update.html','_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">🖼️ Malicious Image Download Phishing</h2><span id="tick-image-download" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> You're trying to download a photo, but it might contain hidden malware. What should you do?</p>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('image-download','feedback'); showFeedback('Hidden Malware Possible','Even images and files can carry viruses or ransomware. Only download from sources you trust.','phish','image-download')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('image-download','simulate'); window.open('fake-image-download.html','_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">
      <h2 class="text-2xl font-semibold text-blue-400 mb-4">📱 QR Code Phishing (Quishing)</h2><span id="tick-qr-phishing" class="tick">✔</span>

      <p class="text-gray-300 mb-2"><strong>Scenario:</strong> You scan a QR code that leads to a suspicious site or offer. How should you respond?</p>
      <div class="flex flex-col md:flex-row gap-4">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"
          onclick="handleSimulation('qr-phishing','feedback'); showFeedback('QR Code Alert','Always double-check QR codes before scanning, especially in public places. Scammers use fake links to steal your data.','phish','qr-phishing')">
          Check for Phishing Clues
        </button>
        <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"
          onclick="handleSimulation('qr-phishing','simulate'); window.open('fake-qr-phishing.html','_blank');">
          Click here to Simulate (Safe Learning)
        </button>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">

  <h2 class="text-2xl font-semibold text-blue-400 mb-4">
    📞 Voice Call Phishing (Vishing)
  </h2><span id="tick-vishing" class="tick">✔</span>


  <p class="text-gray-300 mb-2">
    <strong>Scenario:</strong> You receive a phone call from someone claiming to be from your bank. The caller says your account will be blocked unless you immediately share the OTP sent to your phone. What should you do?
  </p>

  <div class="flex flex-col md:flex-row gap-4">

    <button
      class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"

      onclick="handleSimulation('vishing','feedback'); showFeedback(
      'Voice Call Scam Detected',
      'Legitimate banks never ask for OTPs, passwords, or PINs over phone calls. Scammers often create urgency and fear to steal sensitive information.',
      'phish',
      'vishing'
      )">

      Check for Phishing Clues

    </button>

    <button
      class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"

      onclick="handleSimulation('vishing','simulate'); window.open('fake-vishing.html','_blank');">

      Click here to Simulate (Safe Learning)

    </button>

  </div>
  </section>
<section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">

  <h2 class="text-2xl font-semibold text-blue-400 mb-4">
    💼 Business Email Compromise (BEC)
  </h2><span id="tick-bec" class="tick">✔</span>


  <p class="text-gray-300 mb-2">
    <strong>Scenario:</strong> You receive an email appearing to be from your manager requesting an urgent money transfer or confidential company information. How would you verify the request?
  </p>

  <div class="flex flex-col md:flex-row gap-4">

    <button
      class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"

      onclick="handleSimulation('bec','feedback'); showFeedback(
      'Business Email Compromise Detected',
      'Attackers often impersonate managers or company executives to trick employees into transferring money or sharing confidential information. Always verify requests through official communication channels.',
      'phish',
      'bec'
      )">

      Check for Phishing Clues

    </button>

    <button
      class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"

      onclick="handleSimulation('bec','simulate'); window.open('fake-bec.html','_blank');">

      Click here to Simulate (Safe Learning)

    </button>

  </div>

</section>





<section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">

  <h2 class="text-2xl font-semibold text-blue-400 mb-4">
    🐋 Whaling Attack
  </h2><span id="tick-whaling" class="tick">✔</span>


  <p class="text-gray-300 mb-2">
    <strong>Scenario:</strong> A company executive receives an urgent email requesting sensitive financial data or confidential business documents. What precautions should be taken?
  </p>

  <div class="flex flex-col md:flex-row gap-4">

    <button
      class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"

      onclick="handleSimulation('whaling','feedback'); showFeedback(
      'Whaling Attack Detected',
      'Whaling attacks specifically target high-level executives by impersonating trusted business contacts to steal sensitive company information.',
      'phish',
      'whaling'
      )">

      Check for Phishing Clues

    </button>

    <button
      class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"

      onclick="handleSimulation('whaling','simulate'); window.open('fake-whaling.html','_blank');">

      Click here to Simulate (Safe Learning)

    </button>

  </div>

</section>





<section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate">

  <h2 class="text-2xl font-semibold text-blue-400 mb-4">
    📱 Smishing (SMS Phishing)
  </h2><span id="tick-smishing" class="tick">✔</span>

  <p class="text-gray-300 mb-2">
    <strong>Scenario:</strong> You receive a text message claiming your bank account or delivery service needs urgent verification through a suspicious link. Should you click it?
  </p>

  <div class="flex flex-col md:flex-row gap-4">

    <button
      class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all"

      onclick="handleSimulation('smishing','feedback'); showFeedback(
      'SMS Phishing Attempt',
      'Smishing attacks use fake SMS messages containing malicious links or urgent requests to steal sensitive information.',
      'phish',
      'smishing'
      )">

      Check for Phishing Clues

    </button>

    <button
      class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-all"

      onclick="handleSimulation('smishing','simulate'); window.open('fake-smishing.html','_blank');">

      Click here to Simulate (Safe Learning)

    </button>

  </div>

</section>
</section>
  
  </main>
  
<!-- FEEDBACK BOX 
<div class="bg-gray-800 text-white p-6 mt-10 shadow-xl">
    <h2 class="text-xl font-bold mb-3 text-blue-300">💬 Your Feedback</h2>

    <textarea id="user-feedback"
              class="w-full p-3 rounded-lg text-black"
              placeholder="Write your feedback here..."
              rows="4"></textarea>

    <button id="feedback-btn"
            onclick="submitFeedback()"
            class="mt-3 bg-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
        Submit Feedback
    </button>

    <p id="feedback-msg" class="mt-3 text-sm"></p>
</div>

<script>
function submitFeedback() {
    const feedback = document.getElementById("user-feedback").value.trim();
    const msg = document.getElementById("feedback-msg");
    const btn = document.getElementById("feedback-btn");

    // Clear previous message
    msg.innerText = "";

    if (feedback === "") {
        msg.innerText = "⚠️ Feedback cannot be empty";
        msg.className = "mt-3 text-red-400";
        return;
    }

    // Disable button to avoid double submit
    btn.disabled = true;
    btn.innerText = "Submitting...";

    fetch("feedback_submit.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "feedback=" + encodeURIComponent(feedback)
    })
    .then(res => res.text())
    .then(data => {
        if (data.trim() === "success") {
            msg.innerText = "✅ Feedback submitted successfully!";
            msg.className = "mt-3 text-green-400";
            document.getElementById("user-feedback").value = "";
        } else {
            msg.innerText = data;
            msg.className = "mt-3 text-red-400";
        }
    })
    .catch(() => {
        msg.innerText = "❌ Server error. Try again.";
        msg.className = "mt-3 text-red-400";
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerText = "Submit Feedback";
    });
}
</script>
-->


 <footer class="bg-gray-900 text-white text-center text-sm py-4 mt-auto shadow-inner">
    <p>PhishED | Educating users for a safer digital world</p>
  </footer>

  <div id="global-feedback-modal-overlay" class="modal-overlay">
    <div class="modal-content-box">
      <h3 id="modal-title" class="text-2xl font-bold mb-4"></h3>
      <p id="modal-message" class="mb-6"></p>
      <button onclick="closeModal()"
        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition duration-300 shadow-lg" aria-label="Acknowledge feedback">
        Got It!
      </button>
    </div>
  </div>

  <script>
    const simulationIds = [
  'email-phishing',
  'popup-phishing',
  'sms-otp',
  'camera-sim',
  'ransomware-sim',
  'chrome-update',
  'image-download',
  'qr-phishing',
  'vishing',
  'bec',
  'whaling',
  'smishing'
];

function handleSimulation(simId) {
  localStorage.setItem("completed_" + simId, "true");

  const tick = document.getElementById("tick-" + simId);
  if (tick) tick.classList.add("completed");
}

function showFeedback(title, message, type, simId) {
  document.getElementById('modal-title').textContent = title;
  document.getElementById('modal-title').className =
    type === 'phish'
      ? 'text-2xl font-bold mb-4 phish'
      : 'text-2xl font-bold mb-4 safe';

  document.getElementById('modal-message').textContent = message;
  document.getElementById('global-feedback-modal-overlay').classList.add('show');

  handleSimulation(simId);
}

function closeModal() {
  document.getElementById('global-feedback-modal-overlay').classList.remove('show');
}

document.addEventListener('DOMContentLoaded', () => {
  simulationIds.forEach(id => {
    if (localStorage.getItem("completed_" + id) === "true") {
      const tick = document.getElementById("tick-" + id);
      if (tick) tick.classList.add("completed");
    }
  });

  const observerOptions = { root: null, rootMargin: '0px', threshold: 0.10 };
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.scroll-animate').forEach(section => {
    observer.observe(section);
  });
});
    function showFeedback(title, message, type, simId) {
      document.getElementById('modal-title').textContent = title;
      document.getElementById('modal-title').className = type === 'phish'
        ? 'text-2xl font-bold mb-4 phish'
        : 'text-2xl font-bold mb-4 safe';
      document.getElementById('modal-message').textContent = message;
      document.getElementById('global-feedback-modal-overlay').classList.add('show');
      handleSimulation(simId, 'feedback');
    }
    function closeModal() {
  document.getElementById('global-feedback-modal-overlay').classList.remove('show');
    }


    document.addEventListener('DOMContentLoaded', () => {
      updateProgress();
      const observerOptions = { root: null, rootMargin: '0px', threshold: 0.10 };
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);
      document.querySelectorAll('.scroll-animate').forEach(section => {
        observer.observe(section);
      });
    });
    function smsOtpSimulation() {
  var smsOtp = Math.floor(1000 + Math.random() * 9000);
  localStorage.setItem('currentOtp', smsOtp); 
  localStorage.setItem('currentSimulationId', 'sms-otp');

  document.getElementById('sms-notification-text').innerHTML = 'SMS received: Your OTP is <strong>' + smsOtp + '</strong>.<br>Do NOT share this code with anyone.';
  var smsPopup = document.getElementById('sms-notification-popup');
  smsPopup.style.display = 'block';
}

function openOtpPage() {
  document.getElementById('sms-notification-popup').style.display = 'none';
  window.open('fake-otp-input.html','_blank');
}


  </script>
</body>
</html>
