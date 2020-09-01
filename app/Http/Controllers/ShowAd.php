<?php


namespace App\Http\Controllers;


class ShowAd
{
    public function __invoke()
    {
        $ad = \App\Ad::where('id', request()->id)->first();
        return view('showAd', ['ad' => $ad]);
    }
}
