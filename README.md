# Cron Email Sender

This script sends a test email using cPanel cron and logs the process.

## Setup Instructions

To set this up as a cron job in cPanel, follow these steps:

1. Log in to your cPanel account.
2. Navigate to the "Cron Jobs" section.
3. Choose "Standard" or "Advanced" (whichever you prefer).
4. In the "Command" field, enter the path to your PHP script. For example:
   
```
php /home/yourusername/public_html/sendemail.php
```

Replace `/home/yourusername/public_html/sendemail.php` with the actual path to your PHP script.

5. Set the frequency at which you want the cron job to run (e.g., every hour, every day).
6. Click "Add New Cron Job" to save your changes.
To debug this script, you can also run it manually in the terminal by navigating to the script's directory and executing the following command:

```
php sendemail.php
```

This will execute the script and display any output or errors directly in the terminal.

## Important Notes

- Ensure that the sender address specified in the script ('From' header) is an email account set up in cPanel.
- Additionally, consider implementing SPF and DKIM sender authentication for better email deliverability and security.

## Author

This script was created by [Ecenica Limited](https://www.ecenica.com/).

## License

This script is released under the [MIT License](LICENSE).
