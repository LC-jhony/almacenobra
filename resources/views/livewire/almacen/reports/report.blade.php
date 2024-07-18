<x-bree.container>
    <form wire:submit='filter'>

        {{ $this->form }}
    </form>
    <h2 class="text-xl font-bold">{{ $monthName }}</h2>
    <div class="bg-white mt-6">
        <table class="divide-y divide-gray-200 dark:divide-none">
            <thead class="bg-green-600">
                <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">COD.</th>
                <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">DESCRIPCION</th>
                <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">P.U</th>
                <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">U.M</th>
                <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">Entrada y salida
                    </>
                <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">O/C</th>
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    <th class="p-2 text-start uppercase text-white font-medium text-xs border border-white">
                        {{ substr(\Carbon\Carbon::createFromDate(null, $month, $i)->translatedFormat('D'), 0, 1) }}
                        <p class="border-t border-white">{{ $i }}</p>
                    </th>
                @endfor
                </tr>
            </thead>
            <tbody "bg-white divide-y divide-gray-200 border border-rose-100">
                @foreach ($categoriesWithProducts as $category)
                    <tr class="text-white font-medium text-xs uppercase">
                        <td class="border
                    border-slate-100 bg-neutral-400 text-white">
                            {{ $category->id }}
                        </td>
                        <td class="border border-slate-100 bg-neutral-400 text-white" colspan="36">
                            {{ $category->name }}
                        </td>
                    </tr>
                    @foreach ($category->products as $product)
                        <tr class="">
                            <td rowspan="2" class="border border-slate-100">{{ $product->code }}
                            </td>
                            <td rowspan="2" class="border border-slate-100">{{ $product->name }}
                            </td>
                            <td rowspan="2" class="border border-slate-100">{{ $product->pu }}
                            </td>
                            <td rowspan="2" class="border border-slate-100">{{ $product->um }}
                            </td>
                            <td class="border border-slate-100">Entrada</td>
                            <td rowspan="2" class="border border-slate-100 p-2">{{ $product->order->number }}</td>
                        </tr>
                        <td class="border border-slate-100 bg-neutral-400 text-white">Salida</td>
                    @endforeach
                @endforeach
            </tbody>

        </table>
    </div>
</x-bree.container>
