<?php include("auth.php"); 
include "session_check.php";?>
<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Phishing Awareness Quiz - PhishEd</title>
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
    .feedback-message {
      display: none;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }
    .feedback-message.show {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
    .question-container {
      display: none; 
    }
    .question-container.active {
      display: block; 
    }
    .summary-section {
      display: none; 
    }
    .option-button {
      transition: background-color 0.3s ease, transform 0.2s ease, border-color 0.3s ease;
      background-color: #4a5568; 
      color: #e2e8f0; 
      border: 1px solid #6b7280; 
    }
    .option-button:hover {
      background-color: #6b7280; 
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .option-button.correct {
      background-color: #10b981; 
      border-color: #059669; 
      color: white;
    }
    .option-button.incorrect {
      background-color: #ef4444; 
      border-color: #dc2626; 
      color: white;
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
    .blink {
      animation: blink 1s step-end infinite;
    }
    @keyframes blink {
      50% { opacity: 0; }
    }
  </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
 

  <header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white text-center py-12 px-4">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Phishing Awareness Quiz</h1>
    <p class="text-lg md:text-xl font-light mt-2">Test your knowledge and sharpen your skills in identifying phishing attempts.</p>
  </header>

  <main class="max-w-4xl mx-auto py-8 px-4 flex-grow">
    <section class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 scroll-animate border border-gray-700" id="quiz-section">
      <div id="questions-container">
      </div>
      <div class="text-center mt-4">
        <span id="progress-indicator" class="text-gray-400 text-sm font-semibold"></span>
      </div>
      <div class="text-center mt-6">
        <button id="next-button" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all duration-300 ease-in-out hover:translate-y-[-2px] shadow-lg" aria-label="Proceed to next question" tabindex="0" style="display: none;">Next</button>
      </div>
    </section>

    <section id="summary-section" class="summary-section bg-gray-800 p-6 rounded-lg shadow-lg scroll-animate border border-gray-700">
      <h2 class="text-2xl md:text-3xl font-bold text-blue-400 mb-4">Summary Report</h2>
      <div id="summary-report" class="space-y-4 text-gray-200">
      </div>
      <button onclick="location.reload()" class="mt-8 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-all duration-300 ease-in-out hover:translate-y-[-2px] shadow-lg" aria-label="Restart the quiz" tabindex="0">Try Again</button>
      <a href="learn.php" class="ml-4 mt-8 bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-gray-700 transition-all duration-300 ease-in-out hover:translate-y-[-2px] shadow-lg" aria-label="Navigate to Learn More" tabindex="0">Learn More</a>
    </section>
  </main>

 <footer class="bg-gray-900 text-white text-center text-sm py-4 mt-auto shadow-inner">
    <p>PhishED | Educating users for a safer digital world</p>
  </footer>
  <script>
    const quizData = {
      "questions": [
        {
          "question": "What is the primary goal of most phishing attacks?",
          "hint": "Think about what attackers want to gain from their victims, which is often something of value they can use or sell.",
          "answerOptions": [
            {
              "text": "To test a company's security systems",
              "rationale": "While a phishing test can be used for this purpose by security teams, malicious attackers are not performing a service.",
              "isCorrect": false
            },
            {
              "text": "To steal sensitive information like credentials and financial details",
              "rationale": "Gaining access to private data allows attackers to impersonate victims, steal money, or sell the information.",
              "isCorrect": true
            },
            {
              "text": "To shut down a computer network completely",
              "rationale": "While some malware delivered via phishing can cause network outages, the initial goal is usually information theft, not just disruption.",
              "isCorrect": false
            },
            {
              "text": "To install promotional software on a user's computer",
              "rationale": "Unwanted software installed via phishing is typically malicious (malware, spyware), not just promotional.",
              "isCorrect": false
            }
          ]
        },
        {
          "question": "You receive an SMS message claiming to be from your bank, stating your account is locked and you must click a link to verify your identity. What type of attack is this?",
          "hint": "The name for this type of attack is a combination of 'SMS' and 'phishing'.",
          "answerOptions": [
            {
              "text": "Vishing",
              "rationale": "Vishing involves voice communication, such as a fraudulent phone call, not a text message.",
              "isCorrect": false
            },
            {
              "text": "Whaling",
              "rationale": "Whaling targets high-profile individuals like executives, whereas this attack is broad and not specific to the target's status.",
              "isCorrect": false
            },
            {
              "text": "Smishing",
              "rationale": "This attack uses SMS (Short Message Service) as the medium to deliver the fraudulent message, which is the definition of Smishing.",
              "isCorrect": true
            },
            {
              "text": "Pharming",
              "rationale": "Pharming involves redirecting users from a legitimate website to a fraudulent one, typically by compromising DNS.",
              "isCorrect": false
            }
          ]
        },
        {
          "question": "An email from 'Netflix' urges you to update your payment details. The sender's email address is `support@net-flix.co`. Which part of this is the most significant red flag?",
          "hint": "Attackers often create look-alike domains that are subtly different from the real company's.",
          "answerOptions": [
            {
              "text": "The sender's email address",
              "rationale": "A legitimate company will send emails from its official domain (e.g., netflix.com), not a slightly altered version with a hyphen.",
              "isCorrect": true
            },
            {
              "text": "The request to update payment details",
              "rationale": "While you should be cautious with such requests, companies do send legitimate emails about payment issues. The source is the key.",
              "isCorrect": false
            },
            {
              "text": "The use of the Netflix company name",
              "rationale": "Impersonating a well-known brand is a standard part of phishing, but it's the execution details that reveal the fraud.",
              "isCorrect": false
            },
            {
              "text": "An urgent tone in the subject line",
              "rationale": "Urgency is a common phishing tactic, but the sender's address is a more definitive piece of evidence in this case.",
              "isCorrect": false
            }
          ]
        },
        {
          "question": "How does Multi-Factor Authentication (MFA) primarily protect you if your password is stolen in a phishing attack?",
          "hint": "MFA adds another layer of security beyond just something you know (like your password).",
          "answerOptions": [
            {
              "text": "It blocks all suspicious emails from reaching your inbox.",
              "rationale": "MFA is an access control measure for accounts, it does not function as an email filter.",
              "isCorrect": false
            },
            {
              "text": "It requires a second, separate verification step to grant access.",
              "rationale": "Even with your password, an attacker cannot log in without the second factor (e.g., a code from your phone), securing your account.",
              "isCorrect": true
            },
            {
              "text": "It automatically encrypts your password so it cannot be read.",
              "rationale": "Password encryption (hashing) is a separate security measure; MFA's role is to require an additional proof of identity.",
              "isCorrect": false
            },
            {
              "text": "It scans your computer for viruses after you log in.",
              "rationale": "MFA is about verifying identity during login, not about scanning for malware on your device.",
              "isCorrect": false
            }
          ]
        },
        {
          "question": "Phishing emails often use language that creates a sense of urgency or fear. What is the main purpose of this psychological tactic?",
          "hint": "Emotional responses can often override careful, logical thinking.",
          "answerOptions": [
            {
              "text": "To encourage the recipient to act quickly without thinking critically.",
              "rationale": "By creating panic, attackers hope users will bypass normal security checks and click a malicious link or provide information immediately.",
              "isCorrect": true
            },
            {
              "text": "To make the email seem more important and professional.",
              "rationale": "While it adds intensity, unprofessional pressure and threats are often signs of a scam, not professionalism.",
              "isCorrect": false
            },
            {
              "text": "To test how quickly the recipient responds to emails.",
              "rationale": "The attacker's goal is a specific action (a click, a data entry), not to measure your general email response time.",
              "isCorrect": false
            },
            {
              "text": "To confirm that the recipient's email account is active.",
              "rationale": "Simply sending the email confirms the address is valid if it doesn't bounce; the urgency is for manipulation, not validation.",
              "isCorrect": false
            }
          ]
        },
        {
          "question": "You receive an unexpected email from a colleague with an attachment named 'Urgent_Report.docx'. What is the safest course of action?",
          "hint": "You need to verify the request is legitimate, but using the potentially compromised email thread is risky.",
          "answerOptions": [
            {
              "text": "Open the attachment immediately to see what is urgent.",
              "rationale": "This is risky as the attachment could contain malware, and the email account may have been compromised.",
              "isCorrect": false
            },
            {
              "text": "Reply to the email asking if your colleague sent it.",
              "rationale": "If your colleague's email is compromised, the attacker could simply reply 'yes', tricking you into opening the attachment.",
              "isCorrect": false
            },
            {
              "text": "Contact the colleague through a different, known channel to verify.",
              "rationale": "Using another method (like a phone call or a separate chat message) ensures you are communicating with the actual person, not an attacker.",
              "isCorrect": true
            },
            {
              "text": "Forward the email to your IT department and then delete it.",
              "rationale": "Reporting it is a good step, but verifying directly with the sender (out-of-band) is the most immediate way to confirm legitimacy for your own safety.",
              "isCorrect": false
            }
          ]
        },
        {
          "question": "Which of the following is the safest way to protect yourself online?",
          "hint": "Choose the best security practice.",
          "answerOptions": [
           {
            "text": "Use a weak password",
            "rationale": "Weak passwords are easy for attackers to guess or crack.",
            "isCorrect": false
          },
          {
          "text": "Use a strong password",
          "rationale": "Correct! A strong, unique password helps protect your accounts from unauthorized access.",
          "isCorrect": true
          },
          {
          "text": "Click links without checking them",
          "rationale": "Always verify links before clicking. Phishing attacks often use fake links.",
          "isCorrect": false
          },
          {
          "text": "Share your personal information with anyone",
          "rationale": "Never share sensitive information unless you are sure the request is legitimate.",
          "isCorrect": false
          }
        ]
        },
        {
          "question": "An email looks legitimate, but hovering your mouse over the 'Login Here' button reveals a URL that is different from the company's official website. What does this indicate?",
          "hint": "The displayed text of a link can be intentionally different from its actual destination.",
          "answerOptions": [
            {
              "text": "The company is using a new, third-party login page.",
              "rationale": "While possible, it is a significant security risk and a major red flag that points towards a phishing attempt.",
              "isCorrect": false
            },
            {
              "text": "The link is likely safe because the text says 'Login Here'.",
              "rationale": "The visible text of a hyperlink has no bearing on its safety; the underlying URL is what matters.",
              "isCorrect": false
            },
            {
              "text": "The email is a phishing attempt trying to lead you to a fake site.",
              "rationale": "A mismatch between the link text and the actual URL is a classic sign of a phishing attack designed to steal credentials on a fraudulent page.",
              "isCorrect": true
            },
            {
              "text": "The website's security certificate has just been updated.",
              "rationale": "A certificate update would not change the website's domain name or the fundamental URL structure.",
              "isCorrect": false
            }
          ]
        },
        {
  "question": "Which of the following is the safest way to avoid phishing attacks?",
  "hint": "Choose the safest online habit.",
  "answerOptions": [
    {
      "text": "Verify links before clicking",
      "rationale": "Correct! Always check links and the website address before clicking to avoid phishing scams.",
      "isCorrect": true
    },
    {
      "text": "Open every email attachment",
      "rationale": "Email attachments from unknown or unexpected senders may contain malware.",
      "isCorrect": false
    },
    {
      "text": "Share your OTP with callers",
      "rationale": "Never share OTPs or verification codes with anyone, even if they claim to be from your bank.",
      "isCorrect": false
    },
    {
      "text": "Ignore browser security warnings",
      "rationale": "Browser security warnings help protect you from unsafe websites and should not be ignored.",
      "isCorrect": false
    }
  ]
},
        {
          "question": "Which of the following is a common sign of a phishing email?",
          "hint": "Look for messages that create urgency or ask for sensitive information.",
          "answerOptions": [
            {
              "text": "An email asking you to verify your password immediately.",
      "rationale": "Phishing emails often ask users to share passwords, OTPs, or banking details by creating urgency.",
      "isCorrect": true
            },
            {
               "text": "A normal email from your teacher about homework.",
      "rationale": "Regular educational or official emails without suspicious links or urgent requests are generally safe.",
      "isCorrect": false
            },
            {
               "text": "A calendar reminder for your class schedule.",
      "rationale": "Calendar reminders are commonly used for notifications and are not usually phishing attempts.",
      "isCorrect": false
            },
            {
               "text": "A weather update notification on your phone.",
      "rationale": "Weather notifications are standard informational alerts and not related to phishing.",
      "isCorrect": false
            }

          ]
        }
      ]
    };

    let currentQuestionIndex = 0;
    let userAnswers = [];

    const questionsContainer = document.getElementById('questions-container');
    const progressIndicator = document.getElementById('progress-indicator');
    const summarySection = document.getElementById('summary-section');
    const summaryReport = document.getElementById('summary-report');
    const nextButton = document.getElementById('next-button');

    function shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; 
      }
    }

    function loadQuestion() {
      if (currentQuestionIndex < quizData.questions.length) {
        const questionData = quizData.questions[currentQuestionIndex];
        shuffleArray(questionData.answerOptions); 

        questionsContainer.innerHTML = `
          <div id="q-${currentQuestionIndex}" class="question-container active bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
            <h2 class="text-xl font-semibold mb-4 text-blue-400">Question ${currentQuestionIndex + 1} of ${quizData.questions.length}:</h2>
            <p class="text-gray-200 text-lg mb-4">${questionData.question}</p>
            <p class="text-gray-400 text-sm italic mb-6">Hint: ${questionData.hint}</p>
            <div class="flex flex-col space-y-3">
              ${questionData.answerOptions.map((option, idx) => `
                <button class="option-button bg-gray-600 text-gray-100 px-5 py-3 rounded-lg font-medium text-base hover:bg-gray-700 hover:translate-y-[-2px] focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-500"
                        onclick="checkAnswer(${currentQuestionIndex}, ${idx})" aria-label="Select ${option.text}">
                  ${option.text}
                </button>
              `).join('')}
            </div>
            <div id="feedback-${currentQuestionIndex}" class="feedback-message mt-6 p-4 rounded-md text-base"></div>
          </div>
        `;
        nextButton.style.display = 'none'; 
        updateProgressIndicator();
      } else {
        showSummary();
      }
    }

    function updateProgressIndicator() {
      progressIndicator.textContent = `Question ${currentQuestionIndex + 1} of ${quizData.questions.length}`;
    }

    function checkAnswer(questionIndex, selectedOptionIndex) {
      const questionData = quizData.questions[questionIndex];
      const selectedOption = questionData.answerOptions[selectedOptionIndex];
      const feedbackElement = document.getElementById(`feedback-${questionIndex}`);
      const buttons = document.querySelectorAll(`#q-${questionIndex} .option-button`);

      const isCorrect = selectedOption.isCorrect;
      userAnswers[questionIndex] = {
        question: questionData.question,
        selectedText: selectedOption.text,
        correctText: questionData.answerOptions.find(opt => opt.isCorrect).text,
        rationale: selectedOption.rationale,
        isCorrect: isCorrect
      };

      buttons.forEach((button, idx) => {
        button.disabled = true;
        if (idx === selectedOptionIndex) {
          button.classList.add(isCorrect ? 'correct' : 'incorrect');
        } else if (questionData.answerOptions[idx].isCorrect) {
          button.classList.add('correct');
        }
      });

      feedbackElement.classList.add('show');
      if (isCorrect) {
        feedbackElement.classList.add('bg-green-700', 'border', 'border-green-500', 'text-white');
        feedbackElement.innerHTML = `<strong>✅ Correct!</strong> ${selectedOption.rationale}`;
      } else {
        feedbackElement.classList.add('bg-red-700', 'border', 'border-red-500', 'text-white'); 
        feedbackElement.innerHTML = `<strong>❌ Incorrect.</strong> ${selectedOption.rationale}`;
      }

      nextButton.style.display = 'block';
    }

    function nextQuestion() {
      if (currentQuestionIndex < quizData.questions.length) {
        document.getElementById(`q-${currentQuestionIndex}`).classList.remove('active');
        currentQuestionIndex++;
        loadQuestion();
      }
    }

    function showSummary() {
      document.getElementById('quiz-section').style.display = 'none';
      summarySection.classList.remove('summary-section'); 
      summarySection.classList.add('block'); 

      const correctAnswersCount = userAnswers.filter(ans => ans.isCorrect).length;
      const totalQuestions = quizData.questions.length;

      summaryReport.innerHTML = `
        <h3 class="text-xl font-bold mb-4 text-blue-400">Your Score: ${correctAnswersCount} / ${totalQuestions}</h3>
        <div class="space-y-4">
          ${userAnswers.map((ans, idx) => `
            <div class="p-4 rounded-lg border ${ans.isCorrect ? 'border-green-700 bg-green-900' : 'border-red-700 bg-red-900'} shadow-sm text-gray-200">
              <p class="font-semibold text-gray-100 mb-2">Question ${idx + 1}: ${ans.question}</p>
              <p class="text-gray-200">Your Answer: <span class="font-bold ${ans.isCorrect ? 'text-green-400' : 'text-red-400'}">${ans.selectedText}</span></p>
              <p class="text-gray-200">Correct Answer: <span class="font-bold text-green-400">${ans.correctText}</span></p>
              <p class="text-gray-400 mt-2 text-sm">Rationale: ${ans.rationale}</p>
            </div>
          `).join('')}
        </div>
      `;
    }

    loadQuestion();

    nextButton.addEventListener('click', nextQuestion);

    document.querySelectorAll('a, button').forEach(element => {
      element.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && element.tagName === 'BUTTON') element.click();
      });
    });

    document.addEventListener('DOMContentLoaded', () => {
      const observerOptions = {
        root: null, 
        rootMargin: '0px',
        threshold: 0.1 
      };

      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            if (entry.target.id === 'summary-section') {
                observer.unobserve(entry.target);
            }
          }
        });
      }, observerOptions);

      observer.observe(document.getElementById('quiz-section'));
      observer.observe(document.getElementById('summary-section'));
    });
  </script>

</body>
</html>
