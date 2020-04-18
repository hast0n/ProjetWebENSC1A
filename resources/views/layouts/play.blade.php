@extends("layouts.app")

@section("content")
    {{--  alias @card define in App\Providers\AppService\Provider  --}}
    @card

        @slot('main')
            @yield('main')
        @endslot

        @slot('side')

            @yield('side')

            @component('components.sideBar')
            @endcomponent

        @endslot

    @endcard

@endsection
