<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'model' => 'required|string|min:3|max:255',
            'horses' => 'required|integer|min:1',

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Guardar la imagen en el almacenamiento (en este caso, se guarda en el disco público)

            $image->storeAs('resources/images', $imageName);
        } else {
            $imageName = '';
        }

        // Crear un nuevo estudiante usando el método `create` del modelo

        $data = $request->all();
        $data['image'] = $imageName;
        Car::create($data);

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('cars.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'model' => 'required|string|min:3|max:255',
            'horses' => 'required|integer|min:1',
        ]);

        // Buscar el estudiante por su ID
        $car = Car::findOrFail($id);

        // Actualizar los datos del estudiante
        $car->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('cars.index');
    }

    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return redirect()->route('cars.index');
    }
}
