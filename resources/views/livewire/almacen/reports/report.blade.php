<x-bree.container>
    <form wire:submit='filter'>

        {{ $this->form }}
    </form>
    <h2>fecha: </h2>
    <h2 class="flex justify-end text-xl font-bold uppercase">Mes: {{ $monthName }}</h2>
    <div class="overflow-auto max-h-[70vh] max-w-full">
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
                    <th class="border uppercase">
                        {{ substr(\Carbon\Carbon::createFromDate(null, $month, $i)->translatedFormat('D'), 0, 1) }}
                        <p class="border-t p-2">{{ $i }}</p>
                    </th>
                @endfor
                </tr>
            </thead>
            <tbody class="">
                @foreach ($categoriesWithProducts as $category)
                    <tr class=" bg-slate-300 border">
                        <td class="">
                            {{ $category->id }}
                        </td>
                        <td class="" colspan="36">
                            {{ $category->name }}
                        </td>
                    </tr>
                    @foreach ($category->products as $product)
                        <tr class="border">
                            <td class="border"rowspan="2" class="">{{ $product->code }}
                            </td>
                            <td class="border"rowspan="2" class="">{{ $product->name }}
                            </td>
                            <td class="border"rowspan="2" class="">{{ $product->pu }}
                            </td>
                            <td class="border"rowspan="2" class="">{{ $product->um }}
                            </td>
                            <td class="border">Entrada</td>
                            <td class="border" rowspan="2" class="">{{ $product->order->number }}</td>
                            @for ($i = 1; $i <= $daysInMonth; $i++)
                                @php
                                    $date = \Carbon\Carbon::createFromDate(null, $month, $i)->format('Y-m-d');
                                    $entradaQuantity = $product->movementproduct
                                        ->where('created_at', '>=', $date . ' 00:00:00')
                                        ->where('created_at', '<=', $date . ' 23:59:59')
                                        ->where('movement.tipo', 'entrada')
                                        ->sum('quantity');
                                @endphp
                                <td class="border">{{ $entradaQuantity ?: ' ' }}</td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="">Salida</td>
                            @for ($i = 1; $i <= $daysInMonth; $i++)
                                @php
                                    $date = \Carbon\Carbon::createFromDate(null, $month, $i)->format('Y-m-d');
                                    $salidaQuantity = $product->movementproduct
                                        ->where('created_at', '>=', $date . ' 00:00:00')
                                        ->where('created_at', '<=', $date . ' 23:59:59')
                                        ->where('movement.tipo', 'salida')
                                        ->sum('quantity');
                                @endphp
                                <td class="border border-gray-100 bg-gray-200">{{ $salidaQuantity ?: ' ' }}</td>
                            @endfor
                        </tr>
                    @endforeach
                @endforeach
            </tbody>

        </table>
    </div>
</x-bree.container>
