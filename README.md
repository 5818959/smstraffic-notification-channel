# Laravel SmsTraffic Notification Channel

## Details

Based on [Laravel Nexmo Notification Channel](https://github.com/laravel/nexmo-notification-channel).

## Official Documentation

See documentation for Laravel Nexmo Notification Channel on the [Laravel website](https://laravel.com/docs/notifications#sms-notifications).

## Configuration options

You will need to add a few configuration options to your `config/services.php` configuration file. You may copy the example configuration below to get started:

```
'smstraffic' => [
    'login' => env('SMSTRAFFIC_LOGIN'),
    'password' => env('SMSTRAFFIC_PASSWORD'),
    'sms_from' => env('SMSTRAFFIC_SMS_FROM'),
],
```

The `sms_from` option is the phone number that your SMS messages will be sent from. You should use a phone number from your SmsTraffic control panel.

For testing purposes you may want to change the URL that smstraffic-client makes requests to from `https://api.smstraffic.ru/multi.php` to something else. You can do this by providing a `url` option.

```
'smstraffic' => [
    ...
    'url' => env('SMSTRAFFIC_URL'),
],
```

## License

Laravel SmsTraffic Notification Channel is open-sourced software licensed under the [MIT license](LICENSE.md).
