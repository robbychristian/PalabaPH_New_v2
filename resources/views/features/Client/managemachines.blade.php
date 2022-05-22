@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="h3 text-dark font-weight-bold">
            List of stores for machine
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Laundry Branch</th>
                    <th scope="col">Type of Laundry</th>
                    <th scope="col">Time Open</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laundries as $laundry)
                    <tr>
                        <td>{{ Str::substr($laundry->city, 6, Str::length($laundry->city)) }}, Brgy.
                            {{ Str::substr($laundry->barangay, 9, Str::length($laundry->barangay)) }}</td>
                        <td>{{ $laundry->type_of_laundry }}</td>
                        <td>
                            <span id="open">{{ $laundry->opening_time }}</span> -
                            <span id="close">{{ $laundry->closing_time }}</span>
                        </td>
                        <td>
                            <a href="/managemachine/{{ $laundry->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>
        <script>
            const openFormat = moment(document.getElementById('open').innerHTML).format('h:mmA')
            const closeFormat = moment(document.getElementById('close').innerHTML).format('h:mmA')

            document.getElementById('open').innerHTML = openFormat
            document.getElementById('close').innerHTML = closeFormat
        </script>
    </div>
@endsection
