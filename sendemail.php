<?php
/**
 * Cron Email Sender
 *
 * This script sends a test email using cPanel cron and logs the process.
 * 
 * To set this up as a cron job in cPanel, follow these steps:
 * 1. Log in to your cPanel account.
 * 2. Navigate to the "Cron Jobs" section.
 * 3. Choose "Standard" or "Advanced" (whichever you prefer).
 * 4. In the "Command" field, enter the path to your PHP script. For example:
 *    ```
 *    php /home/yourusername/public_html/sendemail.php
 *    ```
 *    Replace /home/yourusername/public_html/sendemail.php with the actual path to your PHP script.
 * 5. Set the frequency at which you want the cron job to run (e.g., every hour, every day).
 * 6. Click "Add New Cron Job" to save your changes.
 * 
 * To debug this script, you can also run it manually in the terminal by navigating to the script's directory
 * and executing the following command:
 * ```
 * php sendemail.php
 * ```
 * This will execute the script and display any output or errors directly in the terminal.
 *
 * Note: Ensure that the sender address specified in the script ('From' header) is an email account set up in cPanel.
 * Additionally, consider implementing SPF and DKIM sender authentication for better email deliverability and security.
 *
 * @author      Ecenica Limited
 * @copyright   Copyright (c) Ecenica Limited
 * @license     MIT License
 */

class CronEmailSender {
    private $logFile;

    public function __construct($logFile) {
        $this->logFile = $logFile;
        $this->ensureLogFileExists();
    }

    public function sendTestEmail() {
        try {
            // Log when the cron job starts
            $this->logMessage("Cron job started.");

            // Set the recipient email address
            $to = 'email@example.com';

            // Set the subject of the email
            $subject = 'Test Email';

            // Set the message body
            $message = 'This is a test email sent from PHP using cPanel cron.';

            // Set additional headers if needed
            $headers = 'From: email@example.com' . "\r\n" .
                'Reply-To: email@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // Send the email
            $mailSent = mail($to, $subject, $message, $headers);

            // Check if the mail was sent successfully
            if ($mailSent) {
                $this->logMessage("Test email sent successfully.");
            } else {
                throw new Exception("Failed to send test email.");
            }
        } catch (Exception $e) {
            // Log any errors
            $this->logMessage("Error: " . $e->getMessage());
        }
    }

    private function logMessage($message) {
        $this->ensureLogFileExists();
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
    }

    private function ensureLogFileExists() {
        if (!file_exists($this->logFile)) {
            touch($this->logFile);
        }
    }
}

// Usage:
$logFile = __DIR__ . '/cron_log.txt';
$cronEmailSender = new CronEmailSender($logFile);
$cronEmailSender->sendTestEmail();
?>
