<?php

namespace Illuminate\Notifications\Channels;

use SmsTraffic\Client as SmsTrafficClient;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SmsTrafficMessage;

class SmsTrafficSmsChannel
{
    /**
     * The SmsTraffic client instance.
     *
     * @var \SmsTraffic\Client
     */
    protected $smstraffic;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new SmsTraffic channel instance.
     *
     * @param  \SmsTraffic\Client  $smstraffic
     * @param  string  $from
     * @return void
     */
    public function __construct(SmsTrafficClient $smstraffic, $from)
    {
        $this->from = $from;
        $this->smstraffic = $smstraffic;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \SmsTraffic\Response
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('smstraffic', $notification)) {
            return;
        }

        $message = $notification->toSmsTraffic($notifiable);

        if (is_string($message)) {
            $message = new SmsTrafficMessage($message);
        }

        return $this->smstraffic->send(
            $message->from ?: $this->from,
            $to,
            trim($message->content)
        );
    }
}
