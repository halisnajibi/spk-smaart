 @include('partials.header')
 @include('partials.mobile')
 <div class="flex">
    @include('partials.sidebar')
    <div class="content">
        @include('partials.topbar')
       @yield('content')
    </div>
</div>
@include('partials.footer')