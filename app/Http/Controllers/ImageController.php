<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function show($imageName)
    {
        // Ruta completa de la imagen
        $imagePath = storage_path('resources/images/' . $imageName);

        // Verificar si la imagen existe
        if (File::exists($imagePath)) {
            // Obtener el tipo MIME de la imagen
            $mimeType = File::mimeType($imagePath);

            // Cargar el contenido de la imagen
            $imageContent = File::get($imagePath);

            // Devolver la imagen como respuesta con el tipo MIME adecuado
            return response($imageContent)->header('Content-Type', $mimeType);
        } else {
            // Si la imagen no existe, devolver una respuesta 404
            abort(404);
        }
    }
}
