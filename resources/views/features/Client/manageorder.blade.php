@extends('layouts.master')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Laundry Name</th>
                    <th scope="col">Type of Laudry</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laundries as $laundry)
                    <tr>
                        <th scope="row">{{ $laundry->id }}</th>
                        <td>{{ $laundry->name }}</td>
                        <td>{{ $laundry->type_of_laundry }}</td>
                        <td>
                            <form action="manageorder/{{ $laundry->id }}" method="GET">
                                <button class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="card">
                        <div class="card-body">No laundries were published</div>
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
