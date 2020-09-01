<?php


namespace App\Http\Controllers;


final class AdController
{
    public function create($id = null){
        $ad = null;
        $button = 'Create';
        if($id !== null){
            $ad = \App\Ad::find($id);
            $button = 'Save';
        }

        return view('ad-form', ['ad' => $ad, 'button' => $button]);
    }

    public function save($id = null){
        $validator = \Illuminate\Support\Facades\Validator::make(
            request()->all(),
            [
                'title' => 'required|min:10|max:255',
                'description' => 'required|min:25|max:65535',
            ]
        );

        if($validator->fails()){
            return redirect()
                ->route('ad.create', ['id' => $id !== null ? $id : null])
                ->withErrors($validator->errors())
                ->withInput(request()->all()
            );
        }

        if($id !== null){
            $ad = \App\Ad::find($id);
            $ad->title = request()->get('title');
            $ad->description = request()->get('description');
            $ad->save();
        }else{
            $ad = new \App\Ad();
            $ad->title = request()->get('title');
            $ad->description = request()->get('description');
            auth()->user()->ads()->save($ad);
        }

        return redirect()
            ->route('home')
            ->with("success", "Ad \"{$ad->title}\" was successfully ".($id === null ? "created" : "saved").".");
    }
}
