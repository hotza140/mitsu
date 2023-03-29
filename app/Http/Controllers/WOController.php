<?php

namespace App\Http\Controllers;

use App\WO;
use Illuminate\Http\Request;
use App\Http\Requests\WOCreateRequest;

class WOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WOCreateRequest $request)
    {
        try {
            $request->validate();
            $year_4 = date("Y");
            $year_2 = date("y");
            $month_2 = date("m");

            $number_id = WO::whereRaw('YEAR(created_at)=' . $year_4)->whereRaw('MONTH(created_at)=' . $month_2)->count() + 1;
            $format = "WO" . $year_2 . $month_2 . "%'.07d";
            $wo = WO::create([
                'wo_number' => sprintf($format, $number_id),
                'wo_date' => $request->wo_date,
                'wo_time' => $request->wo_time,
                'wo_type' => $request->wo_type,
                'wo_breakdown' => $request->wo_breakdown,
                'air_model' => $request->air_model,
                'error_code' => $request->error_code,
                'wo_price' => $request->wo_price,
                'customer_id' => $request->customer_id,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data has been saved',
                'data' => $wo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
