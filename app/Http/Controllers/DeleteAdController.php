<?php


namespace App\Http\Controllers;


class DeleteAdController
{
    public function __invoke()
    {
        $ad = \App\Ad::where('id', request()->id)->first();
        $ad->delete();

        return redirect()
            ->route('home')
            ->with("success", "Ad \"{$ad->title}\" was successfully deleted");
    }
}
