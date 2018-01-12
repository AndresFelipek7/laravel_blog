<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToTheOwner
{
	/**
	 * Handle the event.
	 *
	 * @param  MessageWasReceived  $event
	 * @return void
	 */
	public function handle(MessageWasReceived $event)
	{
		$message = $event->message;
		/*Mail::send('emails.notification_owner' , ['msg' => $message] , function($m) use ($message) {
			$m->from($message->email, $message->nombre)
				->to('andres@gmail.com','Andres')
				->subject('Tu mensaje ha sifo recibo Exitosamente');
		});*/
	}
}
