<?php

namespace App\Http\Controllers;

use App\Models\User_nutrition;
use Illuminate\Http\Request;

class UserNutritionController extends Controller
{
    function Edit_data (Request $request){

        // dd($request);

        $request->validate([

            'user_id' => ['required'],
            'gender' => ['required'],
            'age' => ['required','max:3'],
            'weight' => ['required', 'min:2', 'max:3'],
            'height' => ['required', 'min:3', 'max:3'],
            'activity' => ['required'],

        ]);


        // คำนวน BMR
        if($request->get('gender') == 1){
            $bmr = (((66.47 + (13.75 * $request->get('weight'))) + (5.003 * $request->get('height'))) - (6.755 * $request->get('age')));
        } else{
            $bmr = (((655.1 + (9.563 * $request->get('weight'))) + (1.85 * $request->get('height'))) - (4.676 * $request->get('age')));
        }

        //ตำนวน tdee
        $tdee = $request->get('activity') * $bmr;

        // dd($tdee);
        // dd($bmr);
        if($request->get('age') >= 21){

            $height = $request->get('height') / 100;

            $bmi = $request->get('weight') / ($height ** 2);
        }
        
        // dd($bmr);

        $userdata = new User_nutrition
        (['user_id'=> $request->get('user_id'),
        'gender' => $request->get('gender'),
        'age' => $request->get('age'),
        'weight' => $request->get('weight'),
        'height' => $request->get('height'),
        'activity' => $request->get('activity'),
        'bmr' => $bmr,
        'bmi' => $bmi,
        'tdee' => $tdee,
        ]);
        $userdata->save();
        return redirect()->back()->with('success','เรียบร้อย');

        // dd($userdata->bmi);

    }

    


}
