
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotificationController extends CI_Controller {

  public function send_push_notification() {
    // Create a Firebase Cloud Messaging client
    $serviceAccount = ServiceAccount::fromJsonFile('sdiqro-594ed-firebase-adminsdk-zno6n-74c5ae1e5d.json');
    $factory = (new Factory)->withServiceAccount($serviceAccount);
    $messaging = $factory->createMessaging();

    // Create a notification message
    $notification = Notification::create('Title', 'Body');

    // Create a FCM message with the notification and target device token
    $message = CloudMessage::withTarget('token', 'diWk5f1TQUu8KmCTMp8Wgx:APA91bEVxnRlc-DTP_FXF3GL763J7kU5daCAzTG8R0b0rsAkbcHm51PoZO52hXFFKcaGbHi0U1QJt9TuZ5sB7T8OPRX-_QXkRJmQEM1MqkAHSI2-9L7RRPhtmQczyVlgS48QtjTzdfYx')->withNotification($notification);

    // Send the message
    $result = $messaging->send($message);

    echo 'Notification sent successfully.';
  }

}
