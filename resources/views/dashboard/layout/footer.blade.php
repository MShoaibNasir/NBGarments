@php
$year=date('Y');
@endphp
<footer>
    <p class="mb-0">© {{$year}} Invoice Management Sysem. All Rights Reserved.</p>
    {{--<small class="opacity-75">Designed & Developed by A2Z Creatorz</small>--}}
</footer>

<!-- JavaScript Libraries -->
@include('dashboard.layout.js')
</body>

</html>