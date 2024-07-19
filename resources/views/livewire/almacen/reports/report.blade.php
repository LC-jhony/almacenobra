<x-bree.container>
    <form wire:submit='filter'>

        {{ $this->form }}
    </form>
    <h2 class="text-xl font-bold">{{ $monthName }}</h2>

    <table class="">
        <thead class="">
            <th class="">COD.</th>
            <th class="">DESCRIPCION</th>
            <th class="">P.U</th>
            <th class="">U.M</th>
            <th class="">Entrada y salida
                </>
            <th class="">O/C</th>
            @for ($i = 1; $i <= $daysInMonth; $i++)
                <th class="">
                    {{ substr(\Carbon\Carbon::createFromDate(null, $month, $i)->translatedFormat('D'), 0, 1) }}
                    <p class="">{{ $i }}</p>
                </th>
            @endfor
            </tr>
        </thead>
        <tbody "">
            @foreach ($categoriesWithProducts as $category)
                <tr class="">
                    <td class="">
                        {{ $category->id }}
                    </td>
                    <td class="" colspan="36">
                        {{ $category->name }}
                    </td>
                </tr>
                @foreach ($category->products as $product)
                    <tr class="">
                        <td rowspan="2" class="">{{ $product->code }}
                        </td>
                        <td rowspan="2" class="">{{ $product->name }}
                        </td>
                        <td rowspan="2" class="">{{ $product->pu }}
                        </td>
                        <td rowspan="2" class="">{{ $product->um }}
                        </td>
                        <td class="">Entrada</td>
                        <td rowspan="2" class="">{{ $product->order->number }}</td>
                    </tr>
                    <td class="">Salida</td>
                @endforeach
            @endforeach
        </tbody>

    </table>

</x-bree.container>
