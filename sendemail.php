<?php
/**
 * Cron Email Sender
 *
 * This script sends a test email using cPanel cron and logs the process.
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
