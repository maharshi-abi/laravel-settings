<script type="text/javascript">
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
                @if($errors->any())
        var msg = '';
        @foreach ($errors->all() as $error)
            msg = msg + "- {{ $error }} <br/>";
        @endforeach
        toastr.error(msg, "Error");
        @endif
        @if(session('success'))
        toastr.success("{{ session('success') }}", "Success");
        @endif
        @if(session('error'))
        toastr.error("{{ session('error') }}", "Error");
        @endif
        @if(session('info'))
        toastr.error("{{ session('info') }}", "Info");
        @endif
        @if(session('warning'))
        toastr.warning("{{ session('warning') }}", "Warning");
        @endif
    })
</script>