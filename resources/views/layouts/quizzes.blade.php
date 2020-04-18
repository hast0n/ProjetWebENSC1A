@extends("layouts.app")

@section("content")
    {{--  alias @card define in App\Providers\AppService\Provider  --}}
    @card

        @slot('main')
            @yield('main')
        @endslot

        @slot('side')
            @component("components.sideBar")
                @slot('info')
                    @yield('info')
                @endslot
            @endcomponent
        @endslot

    @endcard

@endsection
