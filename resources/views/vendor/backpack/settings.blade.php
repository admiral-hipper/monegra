@extends(backpack_view('blank'))

@section('content')
    <div id="admin-settings">
        <admin-settings :data="{{ json_encode($data) }}"
                        :token="{{ json_encode(csrf_token()) }}"
                        :validation-errors="{{ json_encode($errors->all()) }}"
                        :old-values="{{ json_encode(old()) }}"></admin-settings>
    </div>

    <!-- Подключение vue -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
