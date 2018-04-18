VUMASMS Client Library for PHP 
============================


*This library requires a minimum PHP version of 5.6*

This is the PHP client library for use VumaSMS's API. To use this, you'll need a vumasms account. Sign up [for free at 
vumasms.com][signup]. This is currently a beta release, see [contributing](#contributing) for more information.

 * [Installation](#installation)
 * [Obtaining Api Keys](#obtaining-api-keys)
 * [Usage](#usage)
 * [Examples](#examples)
 * [VumaSMS Laravel](#laravel)
 * [Contributing](#contributing) 

Installation
------------

To use the client library you'll need to have [created a VUMASMS account][signup]. 


To install the PHP client library using Composer

```bash
composer require kreateyou/vumasms
```
Obtaining Api Keys
-----
* Loggin to your [VumaSMS account][signin].
* Click on Setting on the left side menu
* Click on Generate API credentials button
* Save the Key and Secret on you app
NOTE: vumaSMS will not store the api key or credentials it will generate new key every time please save the key for later use


Usage
-----

If you're using composer, make sure the autoloader is included in your project's bootstrap file:

```php
require_once "vendor/autoload.php";
```
    
Create a client with your API key and secret:

```php
$client = new  \Vumasms\VumaSMS(API_KEY, API_SECRET);     
```

Examples
--------

### Sending A Message

To use [VumaSMS's SMS API][doc_sms_link] to send an SMS message, call the `$client->send()` method.

The API can be called directly, using a simple array of parameters, the keys are as follows.
```bash
    to                // array of receipients
    sender            // registered sender ID, default VUMA
    message           // message
    scheduled_date    // date to be sent can be Datetime or Cron Expression
    scheduled_type    // date or cron
```


```php
$messageBag = [
    'to' => [2547XXXXXX],
    'sender' => VUMA,
    'message' => 'Test message from the vumaSMS PHP Client'
];
$message = $client->send($messageBag);
```
    
The API response json data can be is as follows. 

```php
{"success":true,"details":{"type":"outbox","status":"queued","payload":{"to":["2547XXXXXX"],"message":"Your verification code for PROJECT is 3434  \n","sender":"VUMA","scheduled_date":null,"scheduled_type":null},"created_by":"17","scheduled_at":null,"updated_at":"2018-04-18 10:14:22","created_at":"2018-04-18 10:14:22","sid":"36"}};
```
    
Laravel
------------
To use the components in laravel 5.x
Add  the VumaSMS provider in your Providers
```php
    Vumasms\Laravel\Providers\ServiceProvider::class,
```
Publish the Service provider as follow
```bash
  php artisan vendor:publish --provider = "Vumasms\Laravel\Providers\ServiceProvider::class"
```
on your config folder locate the vumasms.php config change the key & secret configuration
To send SMS in laravel is as follows
```php
    app("vumasms")->send($messageBag),
```

Contributing
------------

To contribute to the library, docs, or examples, [create an issue][issues] or a pull request. Please only raise issues
about features marked as working in the [API coverage](#API-Coverage) as the rest of the code is being updated.

License
-------

This library is released under the [MIT License][license]

[signup]: https://www.vumasms.com/account/signup
[license]: LICENSE.txt
[signin]: https://www.vumasms.com/account/login
[doc_sms_link]: #