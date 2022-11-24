<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Topping;
use Illuminate\Http\Request;
use App\Http\Resources\Topping as ToppingResource;
use App\Http\Requests\ToppingValidated;
class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $toppings = Topping::orderBy('created_at','desc')->get();
        return ToppingResource::collection($toppings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToppingValidated $request)
    {
        //
        $request->validated();
        $newTopping = new Topping();
        $newTopping->name=$request->get('name');
        $newTopping->price=$request->get('price');
        $newTopping->discount=$request->get('discount');
        $newTopping->status=$request->get('status');
        $newTopping ->created_by=1;
        $newTopping->save();
        return response()->json($newTopping,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $topping = Topping::find($id);
        return response()->json($topping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function update(ToppingValidated $request, $id)
    {
        //
        $toppingUpdate = Topping::find($id);
        $request->validated();
        if($toppingUpdate){
            $toppingUpdate->name=$request->get('name');
            $toppingUpdate->price=$request->get('price');
            $toppingUpdate->discount=$request->get('discount');
            $toppingUpdate->status=$request->get('status');
            $toppingUpdate->created_by=1;
            $toppingUpdate->save();
        }
        return response()->json($toppingUpdate,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $toppingDs = Topping::find($id);
        if($toppingDs){
            $toppingDs->delete();
        }
        return response()->json('deleted succsess');
    }
}
