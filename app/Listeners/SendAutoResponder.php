<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAutoResponder implements ShouldQueue
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
		if (auth()->check()) {
			$message->email = auth()->user()->email;
		}
		Mail::send('emails.contact' , ['msg' => $message] , function($m) use ($message) {
			$m->to($message->email, $message->nombre)->subject('Tu mensaje ha sifo recibo Exitosamente');
		});
	}
}
