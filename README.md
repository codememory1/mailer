# Mailer

> Mailer - Отправка сообщений на почты

## Установка

```
composer require codememory/mailer
```

## Добавления серверов
```php
<?php

use Codememory\Components\Mail\Workers\ServerWorker;
use Codememory\Components\Mail\Interfaces\ServerConfigurationInterface;

require_once 'vendor/autoload.php';

$serverWorker = new ServerWorker();

$serverWorker
    ->add('server-name', function (ServerConfigurationInterface $configuration) {
        $configuration
            ->setHost('smtp.gmail.com')
            ->setPort(487)
            ->setMimeTypeBody('text/html')
            ->setCharset('utf8');
    });
```

## Добавления пользователей
```php
<?php

use Codememory\Components\Mail\Workers\UserWorker;
use Codememory\Components\Mail\Interfaces\UserConfigurationInterface;

require_once 'vendor/autoload.php';

$userWorker = new UserWorker();

$userWorker
    ->addUser('user-alias', function (UserConfigurationInterface $configuration) {
        $configuration
            ->setUsername('example@gmail.com')
            ->setPassword('user password')
            ->setServer($serverWorker->getServer('server-name')) // Сервер, добавленный ранее
            ->addFrom('example@gmail.com', 'Example')
    });
```

## Отправка сообщений
```php
<?php

use Codememory\Components\Mail\Mailer;
use Codememory\Components\Mail\Interfaces\MessageInterface;

// В качестве параметра, передать добавленного пользователя
$mailer = new Mailer($userWorker->getUser('user-alias'));

$mailer
    ->createMessage(function (MessageInterface $message) {
        $message
            ->setSubject('Тема #1')
            ->setBody('Контент темы #1')
            ->addRecipientAddress('email', 'user<необязательно>')
            ->attach('images/image.png');
    })
    ->createMessage(function (MessageInterface $message) {
        $message
            ->setSubject('Тема #2')
            ->setBody('Контент темы #2')
            ->addRecipientAddress('email');
    });

// Отправляем все созданные сообщения
$mailer->send();
```

## Использование MailerPack

> Обязательно выполняем следующие команды
* Создание глобальной конфигурации, если ее не существует
    * `php vendor/bin/gc-cdm g-config:init`
* Merge всей конфигурации
    * `php vendor/bin/gc-cdm g-config:merge --all`

Создаем файл конфигурации **mail.yaml** в папке **configs**
Данными именами, можно руководить с помощью глобальной конфигурации **.config/.codememory.json**   

#### Пример использования MailerPack

```php
<?php

use Codememory\Components\Mail\MailerPack;

require_once 'vendor/autoload.php';

$mailerPack = new MailerPack($serverWorker, $userWorker);

$mailer = $mailerPack->getMailer(); // Returned: Codememory\Components\Mail\Mailer
```