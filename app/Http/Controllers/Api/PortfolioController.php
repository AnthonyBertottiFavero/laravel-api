<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // filtro risultati
        // gestione paramentro q
        $searchString = $request->query('q', '');

        $portfolios = Portfolio::with('type', 'technologies')->where('name', 'LIKE', '%' . $searchString . '%')->paginate(6);
        // $portfolios = Portfolio::with('type', 'technologies')->paginate(6);

        return response()->json([
            'success' => true,
            'results' => $portfolios,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        $portfolio = Portfolio::where('id', $id)->first();
        return response()->json([
            'success' => $portfolio ? true : false,
            'results' => $portfolio]);
    }

    public function random() {
        $portfolios = Portfolio::inRandomOrder()->limit(9)->get();

        return response()->json([
            'success'   => true,
            'results'   => $portfolios,
        ]);
    }
}
