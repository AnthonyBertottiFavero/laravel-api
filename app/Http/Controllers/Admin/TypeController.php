<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private $validations = [
        'name' => 'required|string|min:5|max:20',
        'description' => 'required|string|min:5|max:200',
    ];

    private $validations_messages = [
        'required' => 'Il campo :attribute è richiesto',
        'min' => 'Il campo :attribute deve avere almeno :min caratteri',
        'max' => 'Il campo :attribute deve avere massimo :max caratteri',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
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

        // salvare i dati nel db se validi
        $newType = new Type();
        $newType->name = $data['name'];
        $newType->description = $data['description'];

        $newType->save();

        // reindirizzare su una rotta di tipo get

        return to_route('admin.types.show', ['type' => $newType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $types = Type::all();
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // salvare i dati nel db se validi
        $type->name = $data['name'];
        $type->description = $data['description'];

        $type->update();

        // reindirizzare su una rotta di tipo get

        return to_route('admin.types.show', ['type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        foreach ($type->portfolios as $portfolio) {
            $portfolio->type_id = 1;
            $portfolio->update();
        }

        $type->delete();

        return to_route('admin.types.index')->with('delete_success', $type);
    }
}
