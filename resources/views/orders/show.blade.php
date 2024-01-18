<x-layout>
    <div class="cart-container">
    <h1>Všetky objednávky</h1>
        <form action="/{{$user?->name}}" method="get">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select my-4" aria-label="Default select example" name="filter">
                        <option value="all" selected>Všetky objednávky</option>
                        <option value="0">Objednané</option>
                        <option value="1">Potvrdené</option>
                        <option value="2">Zrušené</option>
                        <option value="3">Odoslané</option>
                    </select>
                </div>
                <div class="col-md-3 my-4">
                    <button class="btn-custom" type="submit">Filtruj</button>
                </div>
            </div>
        </form>
    @if (count($orders) > 0)
        <table>
            @csrf
            <thead>
            <tr>
                <th>ID</th>
                <th>Meno a priezvisko</th>
                <th>Telefón</th>
                <th>Stav</th>
                <th>Zrušiť</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="{{$user->name}}/order/{{$order->id}}">{{$order->id}}</a></td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->phoneNumber}}</td>
                        @switch($order->state)
                            @case(0)
                                <td>Objednane</td>
                            @break

                            @case(1)
                                <td>Potvrdene</td>
                                @break

                            @case(2)
                                <td>Zrusene</td>
                                @break

                            @case(3)
                                <td>Odoslane</td>
                                @break
                        @endswitch
                        @if($order->state != 2 && $order->satte != 1 && $order->satte != 3)
                            <td>
                                <a href="/order/{{$order->id}}/cancel"><i class="bi bi-x-lg"></i></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Žiadne objednávky</p>
    @endif
    </div>

</x-layout>
