<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">PRODUTO</th>
            <th scope="col">EAN</th>
            <th scope="col">DESCRIÇÃO</th>
            <th scope="col">FORNECEDOR</th>
            @foreach($results->first() as $sale)
                <th scope="col">{{ $sale->data }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($results as $values)
            <tr>
                <td>{{ $values->first()->produto }}</td>
                <td>{{ $values->first()->ean }}</td>
                <td>{{ $values->first()->descricao }}</td>
                <td>{{ $values->first()->fornecedor }}</td>
                @foreach($values as $value)
                    <td scope="col"> {{ $value->valor }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
