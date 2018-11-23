<body>
@include('layouts.page_load')
{{-- 框架页加载导航栏 --}}
@if ($page_type=='frame')
    @include('layouts.page_navbar')
@endif
@include('layouts.page_content')

</body>
