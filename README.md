# php-skype

php-skype is a library that makes it easy for developers to use Skype Web API. The library is designed to be user-friendly and comes with comprehensive documentation and examples to help integrate Skype functionality into projects quickly and easily.

## Installation

Use the package manager composer to install php-skype.

```bash
$ php composer.phar require a-kbv/php-skype
```


## Usage
```PHP
<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Akbv\PhpSkype\SkypeClient;
use Akbv\PhpSkype\Services\SessionManager;

$sessionManager = new SessionManager(
    __DIR__ . '/sessions',
    Akbv\PhpSkype\Utils\EnvUtil::getSecret()
);
/** @var Akbv\PhpSkype\SkypeClient $client*/
$client = new SkypeClient($sessionManager);

$account = new Akbv\PhpSkype\Models\Account(Akbv\PhpSkype\Utils\EnvUtil::getEmail(), Akbv\PhpSkype\Utils\EnvUtil::getPassword());
$session = $client->login($account);

/** @var Akbv\PhpSkype\Models\Contact[] $contacts*/
$contacts = $client->loadAllContacts($session);

$conversation = new Akbv\PhpSkype\Models\Conversation($contacts[0]->getProfile()['skype_handle'], 'skype');
$client->sendMessage($session, $conversation, 'Hello World!');

```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)