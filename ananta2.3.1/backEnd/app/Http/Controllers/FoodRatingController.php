<?php

namespace App\Http\Controllers;

use App\Models\Category_food;
use App\Models\Food;
use App\Models\Food_rating;
use App\Models\Step_of_food;
use App\Models\Igd_of_food;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use PDO;

class FoodRatingController extends Controller
{
    function show_food()
    {
        $user = '1';
        // $food = Food::find($id);
        $cate_food = Category_food::all();
        $food_info = Food::latest();
        $count = $food_info->count();
        $food_info = $food_info->paginate(10);

        // dd($count);

        return view('Users.add_food_rating', compact('user', 'count', 'food_info', 'cate_food'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    function addfood_data(Request $request)
    {

        // dd($request);
        $request->validate([

            'user_id' => ['required'],
            'food_id' => ['required'],
            'score_rating' => ['required']
        ]);


        $food_xx = Food_rating::Where('food_id',$request->get('food_id'))->latest()->count();

        if ($food_xx != 0) {
            return redirect()->back()->with('error', 'มีรายการเมนูอาหารนี้อยู่แล้ว');
        } else {

            $reting_menu = new Food_rating([
                    'user_id' => $request->get('user_id'),
                    'food_id' => $request->get('food_id'),
                    'rating_score' => $request->get('score_rating')
                ]);
            $reting_menu->save();
            return redirect()->back()->with('success', 'เพิ่มเรียบร้อยแล้ว');
        }
        
    }

    function search_food(Request $request)
    {

        $cate_food = Category_food::all();

        if ($request->get('category') == 0) {

            if ($request->get('search') != null) {
                $search = $request->get('search');
                $food_info = Food::Where('name', 'like', '%' . $search . '%')->latest();
            } else {
                $food_info = Food::latest();
            }
        } else {
            if ($request->get('search') != null) {
                $search = $request->get('search');
                $food_info = Food::Where('name', 'like', '%' . $search . '%')->where('cate_food_id', $request->get('category'))->latest();
            } else {
                $food_info = Food::Where('cate_food_id', $request->get('category'))->latest();
            }
        }

        $user = '1';
        $count = $food_info->count();
        $food_info = $food_info->paginate(10);
        $food_info->append($request->all());
        return view('Users.add_food_rating', compact('user', 'count', 'food_info', 'cate_food'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    function show_menu_rating()
    {

        $ratingDB = Food_rating::latest();
        $count = $ratingDB->count();
        $ratingDB = $ratingDB->paginate(10);


        return view('Users.Menu_rating', compact('ratingDB', 'count'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    public function show($id)
    {
        $food = Food::find($id);
        $category_food = Category_food::all();

        $iof = Igd_of_food::with("igd_info.cate_igd")->where('food_id', $id)->latest();
        $count_iof = $iof->count();
        $iof = $iof->paginate(10);

        $step = Step_of_food::where('food_id',  $id)->orderBy('order')->latest();
        $count_step = $step->count();
        $step = $step->paginate(10);

        return view('Users.ViewMenu_AddRating', compact('food', 'category_food', 'iof', 'count_iof', 'step', 'count_step'))->with('i', 0);
    }
}
