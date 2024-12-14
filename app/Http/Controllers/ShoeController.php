<?php

namespace App\Http\Controllers;
use App\Models\Shoe;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    public function index()
    {
        return response()->json([
            'products' => Shoe::all()
        ]); //return response()->json(Shoe::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|url',
        ]);
    
        // Si no se proporciona 'thumbnail', asignar el mismo valor que 'image'
        $validatedData['thumbnail'] = $request->input('thumbnail', $validatedData['image']);
    
        $shoe = Shoe::create($validatedData);
        return response()->json($shoe, 201);
    } 


    public function show(Shoe $shoe)
    {
        return $shoe;
    }

    public function update(Request $request, Shoe $shoe)
    {
        $shoe->update($request->all());
        return response()->json($shoe, 200);
    }

    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return response()->json(null, 204);
    }
}
