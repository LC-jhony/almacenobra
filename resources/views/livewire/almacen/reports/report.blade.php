<x-bree.container>
    <form wire:submit='filter'>
        <button type="submit" class="px-4 py-3 bg-green-500 text-white rounded-lg">Filtrar</button>
        {{ $this->form }}
    </form>
    <h2 class="text-xl font-bold">{{ $monthName }}</h2>
    <table class="border border-indigo-600 ">
        <thead class="border border-indigo-600 ">
            <th scope="col" class="border border-indigo-600 ">COD.</th>
            <th scope="col" class="border border-indigo-600 ">DESCRIPCION</th>
            <th scope="col" class="border border-indigo-600 ">P.U</th>
            <th scope="col" class="border border-indigo-600 ">U.M</th>
            <th scope="col" class="border border-indigo-600 ">O/C</th>
            @for ($i = 1; $i <= $daysInMonth; $i++)
                <th class="border border-indigo-600 uppercase">
                    {{ substr(\Carbon\Carbon::createFromDate(null, $month, $i)->translatedFormat('D'), 0, 1) }}
                    <p class="border-t border-indigo-500">{{ $i }}</p>
                </th>
            @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriesWithProducts as $category)
                <tr class="">
                    <td class="border border-indigo-600 ">{{ $category->id }}</td>
                    <td class="border border-indigo-600 " colspan="36">{{ $category->name }}</td>
                </tr>
                @foreach ($category->products as $product)
                    <tr class="">
                        <td class="border border-indigo-600 ">{{ $product->code }}</td>
                        <td class="border border-indigo-600 ">{{ $product->name }}</td>
                        <td class="border border-indigo-600 ">{{ $product->pu }}</td>
                        <td class="border border-indigo-600 ">{{ $product->um }}</td>
                        <td class="border border-indigo-600 ">{{ $product->oc }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>

    </table>

</x-bree.container>
