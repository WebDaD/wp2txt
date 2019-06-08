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

## What is twtxt

TODO: link, etc