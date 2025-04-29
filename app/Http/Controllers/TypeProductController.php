<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    public function create()
    {
        return view('admin.ajouterType');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:type_products,nom|max:255'
        ]);

        TypeProduct::create($request->only('nom'));

        return redirect()->route('admin.ajouterType')
                        ->with('success', 'type ajouté avec succès');
    }
}
