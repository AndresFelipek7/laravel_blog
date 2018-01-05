<?php

namespace App\Http\Middleware;

use Closure;

class checkRoles
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//Obtenemos todo los parametros que recibe este metodo en un arreglo
		$roles = func_get_args();
		//Eliminamos los dos primeros parametros del arreglo para solo tener los roles
		$roles =array_slice($roles , 2);

		if (auth()->user()->hasRoles($roles)) {
			return $next($request);
		}


		return redirect("/");

	}
}
