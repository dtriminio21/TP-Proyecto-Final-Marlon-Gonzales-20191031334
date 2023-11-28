<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $notas = $usuario->notas()->paginate(20);
            $categorias = Categoria::all(); // Obtén todas las categorías
            $etiqueta = Etiqueta::all(); // Obtén todas las etiquetas
            return view('inicio', compact('notas', 'categorias', 'etiqueta'));
        } else {
            return redirect('/login');
        }
    }

    public function create()
    {
        return view('notas.formulario');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria' => 'required|string|max:255',
            'etiquetas' => 'nullable|string',
            'color' => 'required|string|max:7',
        ]);

        $usuario = Auth::user();

        $nota = new Nota([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('contenido'),
            'categoria' => $request->input('categoria'),
            'etiquetas' => $request->input('etiquetas'),
            'color' => $request->input('color'),
        ]);

        $usuario->notas()->save($nota);

        $categoria = Categoria::firstOrCreate(
            ['nombre' => $request->input('categoria')],
            ['user_id' => $usuario->id]
        );

        $nota->categorias()->attach($categoria->id);

        if ($request->input('etiquetas')) {
            $etiquetas = explode(',', $request->input('etiquetas'));
            foreach ($etiquetas as $etiquetaNombre) {
                $etiqueta = Etiqueta::firstOrCreate(
                    ['nombre' => trim($etiquetaNombre)],
                    ['color' => $request->input('color')]
                );
                $nota->etiquetas()->attach($etiqueta->id);
            }
        }

        return redirect()->route('notas.index')->with('mensaje', 'Nota guardada exitosamente');
    }

    public function show($id)
    {
        $nota = Nota::findOrFail($id);
        $etiquetas = $nota->etiquetas;
        return view('notas.show')->with('nota', $nota)->with('etiquetas', $etiquetas);
    }

    public function edit($id)
    {
        $nota = Nota::findOrFail($id);
        return view('notas.formulario')->with('nota', $nota);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria' => 'required|string|max:255',
            'etiquetas' => 'nullable|string',
            'color' => 'required|string|max:7',
        ]);

        $nota = Nota::findOrFail($id);

        $nota->update([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('contenido'),
            'categoria' => $request->input('categoria'),
            'etiquetas' => $request->input('etiquetas'),
            'color' => $request->input('color'),
        ]);

        $nota -> titulo  = $request->input('titulo');

        $usuario = Auth::user();
        $categoria = Categoria::firstOrCreate(
            ['nombre' => $request->input('categoria')],
            ['user_id' => $usuario->id]
        );

        $nota->categorias()->sync([$categoria->id]);

        if ($request->input('etiquetas')) {
            $etiquetas = explode(',', $request->input('etiquetas'));
            $etiquetasIds = [];
            foreach ($etiquetas as $etiquetaNombre) {
                $etiqueta = Etiqueta::firstOrCreate(['nombre' => trim($etiquetaNombre)]);
                $etiquetasIds[] = $etiqueta->id;
            }
            $nota->etiquetas()->sync($etiquetasIds);
        } else {
            $nota->etiquetas()->detach();
        }

        $etiqueta->update(['color' => $request->input('color')]);

        return redirect()->route('notas.index')->with('mensaje', 'Nota actualizada exitosamente');
    }

    public function destroy($id)
    {
        $nota = Nota::findOrFail($id);

        // Eliminar categorías asociadas a la nota
        $nota->categorias()->detach();

        // Intentar eliminar la nota
        if ($nota->delete()) {
            return redirect()->route('notas.index')->with('mensaje', 'Nota borrada exitosamente');
        } else {
            return redirect()->route('notas.index')->with('mensaje', 'La nota no pudo ser eliminada');
        }
    }


    public function obtenerNotasPorCategoria(Request $request, $categoria)
    {
        $usuario = Auth::user();
        $categorias = Categoria::all();

        // Obtén las notas de la categoría seleccionada o todas las notas si no hay selección
        $notas = $categoria
            ? $usuario->notas()->where('categoria_id', $categoria)->get()
            : $usuario->notas()->get();

        return response()->json([
            'notas' => $notas,
            'categorias' => $categorias,
        ]);
    }

}
