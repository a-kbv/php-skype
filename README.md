# php-skype

php-skype is a library that wraps Skype Web API. The library is designed to be user-friendly and comes with comprehensive documentation and examples to help integrate Skype functionality into projects quickly and easily.

## Installation

Use the package manager composer to install php-skype.

```bash
$ composer require akbv/php-skype
```


## Usage
```PHP
<?php

/** Create session manager
 * @return Akbv\PhpSkype\Services\SessionManager $sessionManager*/
$sessionManager = new \Akbv\PhpSkype\Services\SessionManager(
    __DIR__ . '/sessions',
    "hardToGuessSecretKeyUpTo32Characters"
);

/** Create account Object
 * @return Akbv\PhpSkype\Models\Account $account*/
$account = new Akbv\PhpSkype\Models\Account(
    'email@example.com',
    'password'
);

/** Login
 * @return Akbv\PhpSkype\Models\Account $account*/
$client = new Akbv\PhpSkype\SkypeClient($sessionManager);
$client->login($account);

/** Get contacts list
 * @return Akbv\PhpSkype\Models\Contact[] $contacts */
$client->getAllContacts();

/** Start chat with contact
 * @return Akbv\PhpSkype\Models\Chat $chat */
$chat = $client->chat('8:live:example');

/** Send message to chat
 * @return Akbv\PhpSkype\Models\Message $message */
$message = $chat->sendMessage('Hello world!'); 

```
## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)