@if ($errors->any())
@foreach ($errors->all() as $error)
    <script type="text/javascript">
    $(function() {
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Verificação de dados',
            autohide: true,
            delay: 10000,
            body: '<strong>{{$error}}</strong>'
        });
    })
    </script>
@endforeach
@endif


@if(Session::has('message'))
<script type="text/javascript">
    $(function() {
        var type = "{{ Session::get('alert-type', 'info') }}";
        var title = "{{ Session::get('title') }}";
        var message = "{{ Session::get('message') }}";
        var icon = "";
        switch(type){
            case 'info':
                icon = "fas fa-info-circle";
                break;
            case 'warning':
                icon = "fas fa-exclamation-triangle";
                break;
            case 'success':
                icon = "far fa-check-circle";
                break;
            case 'danger':
                icon = "far fa-times-circle";
                break;
            default:
                icon = "far fa-info-circle";
            break;
        }
        $(document).Toasts('create', {
            class: 'bg-' + type,
            autohide: true,
            delay: 10000,
            icon: icon,
            title: title,
            body: message
        });
    });
</script>
@endif