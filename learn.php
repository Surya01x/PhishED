<?php include("auth.php"); include "session_check.php";?>
<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Learn About Phishing | PhishEd</title>
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
    .scroll-animate {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .scroll-animate.in-view {
      opacity: 1;
      transform: translateY(0);
    }
    .email-container {
      position: relative;
      background-color: #2d3748;
      color: #e2e8f0;
      border: 1px solid #4a5568;
      border-radius: 0.5rem;
      padding: 1rem;
      font-family: 'Courier New', monospace;
      font-size: 0.95rem;
      line-height: 1.5;
      overflow: hidden;
    }
    .email-container a { color: #63b3ed; }
    .highlight-area {
      position: absolute;
      background-color: rgba(255, 255, 0, 0.4);
      border: 1px dashed #facc15;
      cursor: pointer;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      z-index: 10;
    }
    .highlight-area.active { opacity: 1; }
    .highlight-area:hover { background-color: rgba(255, 255, 0, 0.6); }
    .highlight-feedback {
      background-color: #4a5568;
      border-left: 4px solid #f59e0b;
      padding: 1rem;
      margin-top: 1rem;
      border-radius: 0.375rem;
      color: #fbd38d;
      font-size: 0.9rem;
      display: none;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }
    .highlight-feedback.show { display: block; opacity: 1; }
  </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">


  <header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white text-center py-12 px-4 shadow-md">
    <h1 class="text-4xl font-extrabold mb-3">🧠 Learn to Spot Phishing</h1>
  </header>

  <main class="max-w-5xl mx-auto py-12 px-4 space-y-16 flex-grow">

    <section class="bg-gray-800 p-6 rounded-xl shadow-lg scroll-animate border border-gray-700">
      <h2 class="text-2xl font-bold text-blue-400 mb-4">🎣 What is Phishing?</h2>
      <p class="mb-4 leading-relaxed text-gray-200">
        Phishing is when someone tries to trick you online by pretending to be someone you know or trust—like your bank, a delivery company, or even a friend. The scammer’s goal is to get you to share private details such as your passwords, bank account numbers, or other sensitive information. They do this through messages that look real but are fake. Once you share your information, it can be used to steal your money or your identity.
      </p>
      <div class="mt-5 bg-yellow-900 border-l-4 border-yellow-700 p-4 rounded text-yellow-200 shadow-sm">
        <strong>💡 Key Tip:</strong> Scammers want you to act fast. They use urgent language or emotional tricks to stop you from thinking clearly. Always pause before clicking links or sharing any information—when in doubt, check with the real company or person through official channels.
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-xl shadow-lg scroll-animate border border-gray-700">
      <h2 class="text-2xl font-bold text-blue-400 mb-4 text-center">🚩 Common Phishing Signs</h2>
      <div class="space-y-6">
        <div>
          <h3 class="font-semibold text-red-400">🚨 Urgent or Scary Messages</h3>
          <p class="text-gray-300 mt-1">You might see words like “Immediate Action Needed” or “Account Suspended.” Scammers want you to panic and follow their instructions without thinking.</p>
        </div>
        <div>
          <h3 class="font-semibold text-red-400">🔗 Unusual Links or Attachments</h3>
          <p class="text-gray-300 mt-1">Before clicking a link, hover over it (or press and hold on mobile) to see where it really goes. If it looks strange or unfamiliar, don’t click!</p>
        </div>
        <div>
          <h3 class="font-semibold text-red-400">✉️ Strange Email Addresses and Typos</h3>
          <p class="text-gray-300 mt-1">Always look at who the email came from—scammers often use addresses that look similar to real ones, with small changes. Bad grammar and spelling mistakes are also warning signs.</p>
        </div>
        <div>
          <h3 class="font-semibold text-red-400">🤫 Requests for Private Info</h3>
          <p class="text-gray-300 mt-1">Legitimate companies never ask for your password, credit card, or full personal details in an email or text. If someone does, it’s likely a scam.</p>
      </div>
        <div>
          <h3 class="font-semibold text-red-400">💰 Too-Good-To-Be-True Offers</h3>
          <p class="text-gray-300 mt-1">Be cautious of messages promising free gifts, prize money, cashback offers, scholarships, or high-paying jobs that seem unrealistic, as scammers often use excitement and greed to attract victims.

Example:
“🎉 Congratulations! You’ve won a free iPhone. Claim now!”.</p>
      </div>


        <div>
          <h3 class="font-semibold text-red-400">🧑‍💼 Fake Authority or Impersonation</h3>
          <p class="text-gray-300 mt-1">Attackers frequently pretend to be trusted organizations such as banks, colleges, HR departments, delivery services, or senior officials to pressure users into taking immediate action without verification.

Example:
“Your bank account will be suspended unless you verify immediately.”</p>
      </div>

        <div>
          <h3 class="font-semibold text-red-400">🌐 Suspicious or Look-Alike Websites</h3>
          <p class="text-gray-300 mt-1">Phishing links may redirect users to fake websites that closely resemble real websites but contain slightly modified domain names or suspicious URLs designed to steal login credentials.

Example:
amaz0n-login.com instead of amazon.com</p>
      </div>

        <div>
          <h3 class="font-semibold text-red-400">📎 Unexpected Attachments</h3>
          <p class="text-gray-300 mt-1">Avoid opening unexpected email attachments such as invoices, result documents, payment receipts, or compressed files because they may contain malware or ransomware.

Example:
“Invoice_2025.zip” or “Exam_Results.pdf.exe”</p>
      </div>


        <div>
          <h3 class="font-semibold text-red-400">🔐 Fake Login or Payment Pages</h3>
          <p class="text-gray-300 mt-1">If a message redirects you to a login or payment page requesting passwords, OTPs, banking details, or card information, always verify the website manually instead of trusting the provided link.

Example:
A fake Paytm or banking login page asking for your OTP.</p>
      </div>

        <div>
          <h3 class="font-semibold text-red-400">🛡️ Stay Safe Online</h3>
          <p class="text-gray-300 mt-1">Always verify website URLs carefully, avoid clicking unknown links, never share OTPs or passwords, enable two-factor authentication (2FA), and report suspicious messages immediately to stay protected from phishing attacks.</p>
      </div>



      </div>
    </section>

    <section class="bg-gray-800 p-8 rounded-xl shadow-lg scroll-animate border border-gray-700">
      <h2 class="text-3xl font-bold text-blue-400 mb-4 text-center">🔍 Types of Phishing Explained</h2>
      <p class="mb-8 text-center text-gray-300">Phishing scams usually take one of three main forms. Here’s how to recognize each:</p>
      <div class="space-y-10">
        <!-- Email Phishing -->
        <div class="flex flex-col md:flex-row items-center gap-6">
          <img src="email.png" alt="Email Phishing" class="w-24 h-24 mb-4 md:mb-0">
          <div>
            <h3 class="text-2xl font-semibold text-blue-300 mb-2">📧 Email Phishing</h3>
            <p class="text-gray-300 mb-2">Fake emails that look like they’re from a trusted company. They ask you to click links, open attachments, or share login details on fake websites.</p>
            <p class="text-gray-400 mb-2"><strong>Example:</strong> An email says, “Your account needs urgent action. Update your details now.” with a suspicious link.</p>
            <p class="text-red-400 font-semibold">How to spot it: Check the sender address, beware urgent requests, and avoid unfamiliar links.</p>
          </div>
        </div>
        <!-- Smishing -->
        <div class="flex flex-col md:flex-row items-center gap-6">
          <img src="sms.png" alt="SMS Phishing" class="w-24 h-24 mb-4 md:mb-0">
          <div>
            <h3 class="text-2xl font-semibold text-blue-300 mb-2">📱 Smishing (SMS Phishing)</h3>
            <p class="text-gray-300 mb-2">Scam text messages pretending to be from courier services, banks, or companies. They urge you to click a link or reply with personal info.</p>
            <p class="text-gray-400 mb-2"><strong>Example:</strong> A text says, “Your parcel is on hold. Pay shipping here: [fake-link.com]”</p>
            <p class="text-red-400 font-semibold">How to spot it: Unfamiliar numbers, shortened links, and urgent requests for personal information.</p>
          </div>
        </div>
        <!-- Vishing -->
        <div class="flex flex-col md:flex-row items-center gap-6">
          <img src="phone.png" alt="Voice Phishing" class="w-24 h-24 mb-4 md:mb-0">
          <div>
            <h3 class="text-2xl font-semibold text-blue-300 mb-2">☎️ Vishing (Voice Phishing)</h3>
            <p class="text-gray-300 mb-2">Fraudulent phone calls from people pretending to be your bank or a government department, asking for sensitive info or verification codes.</p>
            <p class="text-gray-400 mb-2"><strong>Example:</strong> Someone calls claiming, “This is your bank. Please confirm the OTP we sent to secure your account.”</p>
            <p class="text-red-400 font-semibold">How to spot it: Pressure to act immediately, requests for passwords or codes, and unfamiliar or spoofed caller IDs.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-gray-800 p-6 rounded-xl shadow-lg scroll-animate border border-gray-700">
      <h2 class="text-2xl font-bold text-blue-400 mb-4">🕵️ Spot the Phish!</h2>
      <p class="mb-6 text-gray-200">Let’s test your skills! Below are two emails—one real, one fake. Look for clues: strange senders, urgent or threatening language, bad spellings, or weird links. Practice spotting these signs so you can avoid real scams in your inbox every day.</p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="email-container shadow-md">
          <h3 class="font-bold text-blue-400 mb-2">✔️ Legit Email</h3>
          <p><strong class="text-gray-300">From:</strong> <span class="text-blue-300">service@paypal.com</span></p>
          <p><strong class="text-gray-300">Subject:</strong> Login Activity Detected</p>
          <hr class="my-3 border-gray-600">
          <p class="mt-3 text-gray-200">Dear John,</p>
          <p class="text-gray-200">We noticed a login from a new device. If this was you, no action is needed.</p>
          <p class="mt-3 text-gray-200">Otherwise, please go to <a class="text-blue-300 underline" href="https://www.paypal.com/myaccount">paypal.com/myaccount</a> to secure your account.</p>
        </div>
        <div class="email-container shadow-md border border-red-700">
          <h3 class="font-bold text-red-400 mb-2">⚠️ Phishing Example</h3>
          <p><strong class="text-gray-300">From:</strong> <span class="text-red-400">service@paypa1.com</span></p>
          <p><strong class="text-gray-300">Subject:</strong> Urgent: Account Limited!</p>
          <hr class="my-3 border-gray-600">
          <p class="mt-2 text-gray-200">Dear Customer,</p>
          <p class="text-gray-200">We detected suspicious activty on your PayPal account. To restore access, click below:</p>
          <p><a href="http://verify.payypa1.com/login" class="text-blue-300 underline">verify.payypa1.com/login</a></p>
          <p class="text-gray-200">If you don’t respond in 24 hours, your account will be suspended.</p>
          <div class="highlight-area" style="top: 50px; left: 10px; width: 180px; height: 20px;" data-feedback="Fake sender address using 'paypa1.com' instead of 'paypal.com'. Check carefully!" tabindex="0"></div>
          <div class="highlight-area" style="top: 75px; left: 10px; width: 250px; height: 20px;" data-feedback="Urgent language triggers panic. Don’t act without verifying." tabindex="0"></div>
          <div class="highlight-area" style="top: 130px; left: 180px; width: 100px; height: 20px;" data-feedback="'activty' is a typo. Scammers often overlook grammar." tabindex="0"></div>
          <div class="highlight-area" style="top: 155px; left: 10px; width: 90%;" data-feedback="Fake URL: 'payypal.com' is not the real PayPal domain. Hover over links before clicking." tabindex="0"></div>
          <div class="highlight-area" style="top: 180px; left: 10px; width: 90%;" data-feedback="Threat of account suspension = scare tactic to pressure you." tabindex="0"></div>
        </div>
      </div>
      <div id="highlight-feedback-area" class="highlight-feedback mt-6"></div>
    </section>

    <section class="bg-gray-800 p-6 rounded-xl shadow-lg scroll-animate border border-gray-700">
      <h2 class="text-2xl font-bold text-blue-400 mb-4">🛡️ How to Stay Safe</h2>
      <p class="mb-4 text-gray-200">Building good digital habits is the best way to protect yourself. Here are key practices to make part of your routine:</p>
      <ul class="list-disc pl-6 space-y-3 text-gray-200">
       <div>
  <h3 class="font-semibold text-red-400">🔑 Make Unique Passwords</h3>
  <p class="text-gray-300 mt-1">
    Avoid reusing the same password across multiple websites or applications. Using strong and unique passwords for every account reduces the risk of attackers gaining access to multiple services if one password is compromised. Password managers can help generate and securely store complex passwords.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">📲 Enable Two-Factor Authentication (2FA)</h3>
  <p class="text-gray-300 mt-1">
    Two-factor authentication adds an extra layer of security by requiring a verification code from your phone or authentication app in addition to your password. Even if attackers steal your password, they cannot easily access your account without the second verification step.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">🧠 Think Before You Click</h3>
  <p class="text-gray-300 mt-1">
    Always pause and carefully examine emails, messages, links, and attachments before interacting with them. Scammers often rely on urgency, fear, or excitement to trick users into making quick decisions without verifying authenticity.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">🌐 Visit Official Websites Directly</h3>
  <p class="text-gray-300 mt-1">
    If you receive a suspicious message from your bank, social media platform, delivery service, or any organization, avoid clicking the provided link. Instead, manually type the official website address into your browser or use the official mobile application.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">🚫 Never Share OTPs or Passwords</h3>
  <p class="text-gray-300 mt-1">
    Legitimate organizations never ask users to share OTPs, passwords, PINs, or verification codes through emails, calls, or messages. Treat any such request as suspicious and avoid responding.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">📎 Avoid Downloading Unknown Files</h3>
  <p class="text-gray-300 mt-1">
    Do not open unexpected attachments or download files from unknown sources, especially compressed files, executable programs, or suspicious documents, as they may contain malware or ransomware.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">🔍 Verify Website URLs Carefully</h3>
  <p class="text-gray-300 mt-1">
    Before entering sensitive information, always check the website address carefully for spelling mistakes, unusual domains, or missing HTTPS encryption. Fake websites often imitate real websites with slightly modified URLs.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">🛑 Watch for Suspicious Popups</h3>
  <p class="text-gray-300 mt-1">
    Avoid clicking on random popups claiming your device is infected, outdated, or offering rewards. Many malicious websites use fake alerts to trick users into installing harmful software.
  </p>
</div>

<div class="mt-4">
  <h3 class="font-semibold text-red-400">🛡️ Stay Informed About Cyber Threats</h3>
  <p class="text-gray-300 mt-1">
    Cyber threats constantly evolve, so staying informed about common phishing tactics, scams, and online safety practices can significantly improve your ability to recognize and avoid attacks.
  </p>
</div>
</div>
    <div class="flex flex-wrap justify-center gap-4 mt-10">
      <a href="quiz.php" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-all duration-300 ease-in-out hover:translate-y-[-2px] shadow-lg">🧠 Try a Quiz</a>
      <a href="index.html" class="bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-all duration-300 ease-in-out hover:translate-y-[-2px] shadow-lg">🏠 Back to Home</a>
    </div>
  </main>

 <footer class="bg-gray-900 text-white text-center text-sm py-4 mt-auto shadow-inner">
    <p>PhishED | Educating users for a safer digital world</p>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const highlightAreas = document.querySelectorAll('.highlight-area');
      const feedbackBox = document.getElementById('highlight-feedback-area');
      highlightAreas.forEach(area => {
        area.addEventListener('click', () => {
          highlightAreas.forEach(a => a.classList.remove('active'));
          area.classList.add('active');
          feedbackBox.textContent = area.dataset.feedback;
          feedbackBox.classList.add('show');
        });
        area.addEventListener('mouseover', () => {
          feedbackBox.textContent = area.dataset.feedback;
          feedbackBox.classList.add('show');
        });
        area.addEventListener('mouseout', () => {
          if (!area.classList.contains('active')) feedbackBox.classList.remove('show');
        });
      });
      const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
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
  </script>



<script>
function submitFeedback() {
    let fb = document.getElementById("user-feedback").value.trim();
    if (fb === "") {
        document.getElementById("feedback-msg").textContent = "Feedback cannot be empty";
        return;
    }

    fetch("feedback_submit.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "feedback=" + encodeURIComponent(fb)
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            document.getElementById("feedback-msg").textContent = "Thank you! Your feedback was submitted ✔";
            document.getElementById("user-feedback").value = "";
        } else {
            document.getElementById("feedback-msg").textContent = "Error: " + data;
        }
    });
}
</script>

</body>
</html>
