<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class LicenceKey
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

        $date_end = '30/04/2021';
        $date_start = '01/05/2021';
        if($date_start > $date_end)
        {
            alert('Attention','Votre licence n\'est plus valide. Veuillez contacter l\'administrateur','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoClose(false);

            return redirect()->route('licence');
        }
        else
            {
                // dd("bien");
            }


        return $next($request);
    }
}
