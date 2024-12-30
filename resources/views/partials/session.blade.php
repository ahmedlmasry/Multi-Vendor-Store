
@if(session('success'))
    @push('scripts')
    <script>
        new Noty({
            text: "{{session('success')}}",
            type: 'success',
            dismissQueue: true,
            layout : "topRight",
            timeout:2000,
            killer:true
        }).show();
    </script>
    @endpush
@endif
@if(session('error'))
    @push('scripts')
    <script>
        new Noty({
            text: "{{session('error')}}",
            type: 'error',
            dismissQueue: true,
            layout : "topRight",
            timeout:2000,
            killer:true
        }).show();
    </script>
    @endpush
@endif
@if(session('edit'))
    @push('scripts')
        <script>
            new Noty({
                text: "{{session('edit')}}",
                type: 'warning',
                dismissQueue: true,
                layout : "topRight",
                timeout:2000,
                killer:true
            }).show();
        </script>
    @endpush
@endif
