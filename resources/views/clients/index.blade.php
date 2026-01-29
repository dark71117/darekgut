@extends('layout')

@section('content')
<h1>Lista klientów</h1>
<a href="{{ route('clients.create') }}">Dodaj klienta</a>
<table>
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client->id) }}">Edytuj</a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Usuń</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
