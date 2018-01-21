# PHP JIRA Agile Rest Client

# Requirements

- PHP >= 5.5.9
- [php JsonMapper](https://github.com/netresearch/jsonmapper)
- [phpdotenv](https://github.com/vlucas/phpdotenv)

# Installation

1. Download and Install PHP Composer.

   ``` sh
   curl -sS https://getcomposer.org/installer | php
   ```

2. Next, run the Composer command to install the latest version of php jira rest client.
   ``` sh
   php composer.phar require lesstif/php-jira-rest-client "^1.7.0"
   ```
    or add the following to your composer.json file.
   ```json
   {
       "require": {
           "lesstif/php-jira-rest-client": "^1.7.0"
       }
   }
   ```
   **Note:**
   If you are using **laravel 5.0 or 5.1**(this version dependent on phpdotenv 1.x), then use **"1.5.\*"** version instead.

3. Then run Composer's install or update commands to complete installation. 

   ```sh
   php composer.phar install
   ```

4. After installing, you need to require Composer's autoloader:

   ```php
   require 'vendor/autoload.php';
   ```

# Configuration

you can choose loads environment variables either 'dotenv' or 'array'.

## use dotenv


copy .env.example file to .env on your project root.	

```sh
JIRA_HOST="https://your-jira.host.com"
JIRA_USER="jira-username"
JIRA_PASS="jira-password"
```

**important-note:** If you are using previous versions(a prior v1.2), you should move config.jira.json to .env and will edit it. 

If you are developing with laravel framework(5.x), you must append above configuration to your application .env file.

## use array

create Service class with ArrayConfiguration parameter.

```php
use JiraRestApi\Configuration\ArrayConfiguration;
use JiraRestApi\Issue\IssueService;

$iss = new IssueService(new ArrayConfiguration(
          array(
               'jiraHost' => 'https://your-jira.host.com',
               'jiraUser' => 'jira-username',
               'jiraPassword' => 'jira-password',
          )
   ));
```

# License
Apache V2 License

# JIRA Rest API Documents
* 6.4 - https://docs.atlassian.com/jira/REST/6.4/
* Jira Server latest - https://docs.atlassian.com/jira/REST/server/
* Jira Cloud latest - https://docs.atlassian.com/jira/REST/latest/
