<x-layout>
    <div class="container d-flex row">
    <h1>Všetky objednávky</h1>
        <form action="/{{$user?->name}}" method="get">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select my-4" id="selectMenu" aria-label="Default select example" name="filter">
                        <option value="all" selected>Všetky objednávky</option>
                        <option value="0">Objednané</option>
                        <option value="1">Potvrdené</option>
                        <option value="2">Zrušené</option>
                        <option value="3">Poslať</option>
                    </select>
                </div>
            </div>
        </form>
    @if (count($orders) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-light table-sm text-center">
                @csrf
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Meno a priezvisko</th>
                    <th scope="col">Telefón</th>
                    <th scope="col">Email</th>
                    <th scope="col">Stav</th>
                    <th scope="col">Zrušiť</th>
                    <th scope="col">Vymazať</th>
                    <th scope="col">Upraviť</th>
                    @if(auth()->user()?->name == "admin")
                        <th scope="col">Potvrdiť</th>
                        <th scope="col">Poslaná</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row"><a href="{{$user->name}}/order/{{$order->id}}">{{$order->id}}</a></th>
                        <td>{{$order->name}}</td>
                        <td>{{$order->phoneNumber}}</td>
                        <td>{{$order->email}}</td>
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

                        @if($order->state != 3 && (($order->state != 2 && $order->state != 1) || (auth()->user()?->name == "admin")))
                            <td>
                                <a href="/order/{{$order->id}}/cancel"><i class="bi bi-x-lg"></i></a>
                            </td>
                        @else
                            <td>-</td>
                        @endif

                        @if($order->state == 2)
                            <td><a href="/order/{{$order->id}}/delete"><i class="bi bi-trash"></i></a></td>
                        @else
                            <td>-</td>
                        @endif

                        @if($order->state == 0)
                            <td><a href="/order/{{$order->id}}/edit"><i class="bi bi-pen"></i></a></td>
                        @else
                            <td>-</td>
                        @endif

                        @if(auth()->user()?->name == "admin")
                            @if($order->state == 0)
                                <td><a href="/order/{{$order->id}}/confirm"><i class="bi bi-check"></i></a></td>
                            @else
                                <td>-</td>
                            @endif

                            @if($order->state == 1)
                                    <td><a href="/order/{{$order->id}}/send"><i class="bi bi-check"></i></a></td>
                            @elseif($order->state == 3)
                                <td>Odoslané</td>
                            @else
                                <td>-</td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Žiadne objednávky</p>
    @endif
    </div>

</x-layout>
