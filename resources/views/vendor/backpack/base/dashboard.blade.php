@extends(backpack_view('blank'))

@section('content')
    <div id="admin-dashboard">
        <admin-dashboard></admin-dashboard>
    </div>

    <!-- Подключение vue -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
