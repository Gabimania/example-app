<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cars List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('cars.create') }}" class="bg-cyan-500 dark:bg-cyan-700 hover:bg-cyan-600 dark:hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded">Create Car</a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ID</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Name</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Model</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Horses</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Image</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $car->id }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $car->name }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $car->model }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $car->horses }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                    @if ($car->image)
                                    <img src="{{ route('imagecars', ['image' => $car->image]) }}" alt="Imagen del coche">
                                    @else
                                    No Image
                                    @endif
                                </td>

                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('cars.edit', $car->id) }}" class="bg-violet-500 dark:bg-violet-700 hover:bg-violet-600 dark:hover:bg-violet-800 font-bold py-2 px-4 rounded mr-2">Edit</a>
                                        <button type="button" class="bg-pink-400 dark:bg-pink-600 hover:bg-pink-500 dark:hover:bg-pink-700  font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $car->id }}')">Delete</button>

                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // forma 1
    function confirmDelete(id) {
        alertify.confirm("¿Confirm delete record?",
            function() {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/cars/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
                alertify.success('Ok');
            },
            function() {
                alertify.error('Cancel');
            });
    }

    // forma 2
    /* function confirmDelete(id) {
        alertify.confirm("¿Confirm delete record?", function (e) {
            if (e) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/students/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            } else {
                alertify.error('Cancel');
                return false;
            }
        });
    } */
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js" integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>