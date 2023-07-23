<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Portfolio;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    private $validations = [
        'name' => 'required|string|max:100|min:5',
        'client_name' => 'required|string|max:100|min:5',
        'type_id' => 'required|integer|exists:types,id',
        'url_image' => 'nullable|url|max:400',
        'image' => 'nullable|image',
        'pickup_date' => 'required|date',
        'deploy_date' => 'required|date',
        'description' => 'required|string',
        'technologies' => 'nullable|array',
        'technologies.*' => 'integer|exists:technologies,id',
    ];

    private $validations_messages = [
        'required' => 'Il campo :attribute è richiesto',
        'min' => 'Il campo :attribute deve avere almeno :min caratteri',
        'max' => 'Il campo :attribute deve avere massimo :max caratteri',
        'url' => 'Il campo :attribute deve essere un URL valido',
        'date' => 'Il campo :attribute deve essere una data in formato valido',
        'exists' => 'Il campo :attribute non è valido',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::paginate(10);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.portfolios.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // salvare l'immagine nella cartella degli uploads
        // prendere il percorso dell'immagine appena salvata
        $imagePath = null;

        // if (isset($data['image'])) {
        //     $imagePath = Storage::put('uploads', $data['image']);
        // }

        if ($request->has('image')) {
            $imagePath = Storage::disk('public')->put('uploads', $data['image']);
        }

        // salvare i dati nel db se validi
        $newPortfolio = new Portfolio();
        $newPortfolio->name = $data['name'];
        $newPortfolio->client_name = $data['client_name'];
        $newPortfolio->type_id = $data['type_id'];
        $newPortfolio->url_image = $data['url_image'];
        $newPortfolio->image = $imagePath;
        $newPortfolio->pickup_date = $data['pickup_date'];
        $newPortfolio->deploy_date = $data['deploy_date'];
        $newPortfolio->description = $data['description'];

        $newPortfolio->save();

        // associare i tag
        $newPortfolio->technologies()->sync($data['technologies'] ?? []);

        // reindirizzare su una rotta di tipo get

        return to_route('admin.portfolios.show', ['portfolio' => $newPortfolio]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return view('admin.portfolios.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.portfolios.edit', compact('portfolio', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();


        if (isset($data['image'])) {
            // salvare l'immagine nuova
            $imagePath = Storage::disk('public')->put('uploads', $data['image']);

            // eliminare l'immagine vecchia
            if ($portfolio->image) {
                Storage::delete($portfolio->image);
            }

            // aggiormare il valore nella colonna con l'indirizzo dell'immagine nuova
            $portfolio->image = $imagePath;
        }

        // salvare i dati nel db se validi
        $portfolio->name = $data['name'];
        $portfolio->client_name = $data['client_name'];
        $portfolio->type_id = $data['type_id'];
        $portfolio->url_image = $data['url_image'];
        $portfolio->pickup_date = $data['pickup_date'];
        $portfolio->deploy_date = $data['deploy_date'];
        $portfolio->description = $data['description'];

        $portfolio->update();

        // associare i tag
        $portfolio->technologies()->sync($data['technologies'] ?? []);

        // reindirizzare su una rotta di tipo get

        return to_route('admin.portfolios.show', ['portfolio' => $portfolio]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            Storage::delete($portfolio->image);
        }

        // dissociare tutti i tag
        $portfolio->technologies()->detach();

        // eliminare il portfolio

        $portfolio->delete();

        return to_route('admin.portfolios.index')->with('delete_success', $portfolio);
    }
}
