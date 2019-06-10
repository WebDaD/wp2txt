# Wordpress 2 twtxt

Gets Posts from your Workdpress Page and post it to your twtxt.txt

You may add it as a cronjob.

To prevent misuse, you may add a token to the file. Then you should call the cron.php with this token as argument, like cron.php?token=TOKEN

## Config

Just check out the first lines of cron.php:

- $wp_site: Base URL to your Wordpress
- $twtxt: Path to File
- $log: Where to log the actions to
- $token: Your Access-Token
- $days_back: How many Days of Posts should be pulled in.

If you dont already have a twtxt.txt-File, consider using the template from this project and fill out the blanks.

Also you may need to edit your _.htaccess_-File, vor example like this:

    # BEGIN WordPress
    <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteRule ^wp2twtxt\.php$ - [L]
    RewriteRule ^twtxt\.txt$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
    </IfModule>
    # END WordPress

## What is twtxt

[twtxt is a decentralised, minimalist microblogging service for hackers.](https://github.com/buckket/twtxt)
