<?php
namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;


class ImageController extends Controller
{

    public function index()
    {
        $images = Image::all();
        return view('gallery', compact('images'));
    }

    public function upload(Request $request)
    {
        // Validazione del form
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prompt' => 'required|string',
        ]);

        // Caricamento immagine
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Nome unico
            $image->move(public_path('uploads'), $imageName);

            // Salva il percorso e il prompt nel database
            Image::create([
                'image_path' => 'uploads/' . $imageName,
                'prompt' => $request->prompt,
            ]);
        }

        return back()->with('success', 'Immagine caricata con successo.');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }

        $image->delete();

        return back()->with('success', 'Immagine eliminata con successo.');
    }

    public function update(Request $request, $id)
    {
        // Validazione del nuovo prompt
        $request->validate([
            'prompt' => 'required|string',
        ]);

        // Trova l'immagine e aggiorna il prompt
        $image = Image::findOrFail($id);
        $image->prompt = $request->prompt;
        $image->save();

        return back()->with('success', 'Prompt aggiornato con successo.');
    }


}
