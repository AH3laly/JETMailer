# JETMailer
Is a mailing microservice with high degree of certainty.

## Environment:

### JETMailer was installed, developed and tested on the following environment aspects:
- CentOS Linux 7.8 
- PHP 7.3.26.
- MariaDB 5.5.68.

## Installation:
You can use **Manual** or **Automatic** installtion
- Make sure PHP Composer is installed.
- Make sure Git is installed.

`It's recommended to use Automatic Installation to install JETMailer on a Docker container`

### Automatic Installation:
- Make sure Docker is installed.
- Make sure docker-compose is installed.
- Open [JETMailer Automatic Installer](https://github.com/AH3laly/JETMailer/tree/master/_Auto_Install_To_Docker)
- Download all files to single directory.
- On Bash, execute **sh install.sh**

```sh
# Install JETMailer
$ sh install.sh

# Stop JETMailer
$ sh stop.sh

# Start JETMailer
$ sh start.sh

# Uninstall JETMailer
$ sh uninstall.sh

```

**Automatic Installation Demo:**

https://www.youtube.com/watch?v=rNm7t0ogbh0

### Manual Installation:
- Download Fresh Laravel project
```sh
$ composer create-project --prefer-dist laravel/laravel JETMailer
```
- Clone JETMailer project
```sh
$ git clone https://github.com/AH3laly/JETMailer.git JETMailerTemp
```
- Copy JETMailer to the fresh Laravel Project
```sh
$ cp -rf JETMailerTemp/*.*  JETMailer/
$ cp -rf JETMailerTemp/*  JETMailer/
$ cp -rf JETMailerTemp/.*  JETMailer/
$ rm -rf JETMailerTemp
```

- Update packages using composer:
```sh
$ cd JETMailer
$ composer update
```

- Set your Database configuration in .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
- Set **QUEUE_CONNECTION=database** in .env

- Make sure the database exists
```sh
$ mysql -u root -p -e "CREATE database laravel"
```

- Initialize JETMailer
```sh
# Drop and Re-install Database tables
$ php artisan migrate:fresh

# Create at least one MTAServer to start delivering Mails
$ php artisan jetMailer:CreateMTA --host=smtp1.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"
```

- Start JETMailer
```sh
$ php artisan queue:work &
$ php artisan serve --host 127.0.0.1 --port 8090
```
- Open the URL http://127.0.0.1:8090 on your browser.

## URLs:
- **Browser**   / (Open Portal Dashboard)
- **GET**       /api/mail (Get list of emails)
- **POST**      /api/mail (Schedule new Mail for delivery)
- **GET**       /api/mail/statistics (Returns some Statistics)
- **GET**       /api/mtaserver (Returns MTA Servers list)
- **GET**       /api/log (Returns Log list)

## Questions:

### Why Laravel framework?
Because it's rich, stable, solid and well designed framework.

### Why VueJS library for UI?
Because I am new to Vue, so wanted to have some fun.

### Why used PHPMailer in app/Libraries ?
Because it's a required, to not use the native Laravel Mailer.

### Why used Laravel Jobs and Queues?
Because it allows to process tasks asynchronously in the background.

### What are MTA Servers?
They are SMTP servers used by JETMailer to deliver email messages.

**Note:**
`Only enabled MTA Servers are used for Mails delivery, so make sure you have enough enabled servers, anyway When you create a new MTA Server it will be enabled by default `

### What is the SendMailJob?

It's the backgorund job responsible for deliverying emails.

**Note:**
`Jobs are processed only if the Laravel Queue Processor is running, to run it check the command` **php artisan queue:work** `in the Important Commands section blow`

### What happen if the command queue:work is not running?
The emails will be added as Jobs but will not be delivered until the **queue:work** command is started.

### How many MTA Servers you need?
As much as you can, it's fine for load balancing and fallback.

### What happen if an MTA server is failing?
Don't worry, the **SendMailJob** will keep trying different MTA Servers until delivers successfuly.

### What happen if All MTA Servers are failing?
**SendMailJob** will throw an exception and move the Job to Failed Jobs.

### How to retry processing the failed Job?
Check the command **php artisan queue:retry** in the Important Commands section blow.

### How do I know that a specific MTA Server is failing?
The field **failures** in the **mta_servers** table represents the number of failures of each MTA Server, and the **SendMailJob** increments that value each time the MTA Server fail.

### Where the logs are saved and how to view them?
Logs are saved in a database table called **logs**, 
you can view them by quering the database or from **UI**

### What are the email formats available?
TEXT, HTML, MARKDOWN

### How are Markdown formatted Emails saved and parsed?
Markdown Messages are saved in the database in Markdown format,
And it parsed to HTML just before delivery.


### What is the delivery algorithm?
- **SendMailJob** gets a list of all **Enabled** MTA Servers.
- It shuffles the MTA Servers list, so it wont start with the same server every time tries to deliver a Mail.
- **SendMailJob** starts delivering the Email message, using any random MTA server.
- If delivery was successful:
    - Update the Mail status to **Delivered**.
    - Add a new Log to **logs** table confirming the delivery.
- If delivery failed:
    - Increment the **failues** column of the failed MTA Server.
    - Add a new Log to **logs** table describing the failure.
    - Try the next MTA server, and keep trying until the mail is delivered successfully.
- If unable to deliver the message by any MTA Server:
    - Update the Mail status to **Failed**.
    - Log a new entry to **logs** table.
    - Throw an exception and move the Job to **failed_jobs** table, so we can retry them later after fixing the issue.

## Important Commands:

### Drop all tables and re-run all migrations:
```sh
# From project home directory
php artisan migrate:fresh
```

### List MTA Servers:
```sh
# From project home directory
# --enabled and --disabled options are available for some filtering
php artisan jetMailer:ListMTA
```

### Create MTA Server:
```sh
# From project home directory
php artisan jetMailer:CreateMTA --host=smtp.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"
```

### Enable MTA Server:
```sh
# From project home directory
php artisan jetMailer:EnableMTA {mta_server_id}
```

### Disable MTA Server:
```sh
# From project home directory
php artisan jetMailer:DisableMTA {mta_server_id}
```

### Run Test Cases:
```sh
# From project home directory
php artisan test
```

### Schedule a new Mail for delivery:
```sh
# From project home directory
$ php artisan jetMailer:CreateMail --fromName="Helaly" --fromEmail=helaly@somedomain.local --toEmail=someone@somedomain.local --subject="My Message Subject" --body="Email Message"
```

### Start the JETMailer project:
```sh
# From project home directory
$ php artisan serve
```

### Start Queue processing:
```sh
# From project home directory
$ php artisan queue:work
```

### Show Failed Jobs:
```sh
# From project home directory
$ php artisan queue:failed
```

### Retry a Failed Job:
```sh
# From project home directory
$ php artisan queue:retry [jobId]
```

### Delete a Failed Job:
```sh
# From project home directory
$ php artisan queue:forget  [jobId]
```

### Delete All Failed Jobs:
```sh
# From project home directory
$ php artisan queue:flush
```

### Schedule Mail for Delivery using bash:
```bash
$ curl -X POST -H "Content-type: application/json" \
-d '{"fromName":"Helaly", "fromEmail":"helaly@somedomain.local", "toEmail":"someone@somedomain.local", "subject":"My Message Subject", "body":"Email Message Body", "format":"text"}' \
http://127.0.0.1:8000/api/mail/
```
