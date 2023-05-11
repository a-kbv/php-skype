# php-skype
php-skype is a library that wraps Skype Web API. The library is designed to be user-friendly and comes with comprehensive documentation and examples to help integrate Skype functionality into projects quickly and easily.

# Note: `library is under development, please use it with caution`

## Installation 


Use the package manager composer to install php-skype. 

```bash 
$ composer require akbv/php-skype 
```

## Usage
```PHP
<?php

/** Create session manager */
$sessionManager = new \Akbv\PhpSkype\Services\SessionManager(
    __DIR__ . '/sessions',
    "hardToGuessSecretKeyUpTo32Characters"
);

/** Create account Object */
$account = new Akbv\PhpSkype\Models\Account(
    'email@example.com',
    'password'
);

/** Login */
$client = new Akbv\PhpSkype\SkypeClient($sessionManager);
$client->login($account);

/** Get contacts list */
$client->getAllContacts();

/** Start chat with contact */
$chat = $client->chat('8:live:example');

/** Send message to chat */
$message = $chat->sendMessage('Hello world!'); 

```

## Contributing

Pull requests are welcome.

## License

[BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause)

### NOTE: `This library is not affiliated with Skype or Microsoft in any way. Use at your own risk`.
