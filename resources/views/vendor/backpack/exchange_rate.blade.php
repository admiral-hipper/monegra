@extends(backpack_view('blank'))

@section('content')
    <div id="admin-exchange-rates">
        <admin-exchange-rates :exchange-rates="{{ json_encode($exchangeRates) }}"></admin-exchange-rates>
    </div>

    <!-- Подключение vue -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
