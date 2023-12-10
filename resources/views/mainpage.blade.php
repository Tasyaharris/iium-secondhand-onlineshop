@extends('layouts.main')


@section ('container')

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function(event)){
        Echo.channel('hello-channel')
            .listen('HelloEvent'),(e) => {
                console.log(e);
            }
    }
</script>


