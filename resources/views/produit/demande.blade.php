@extends('admin.include.default')
@section('style')
<style>
</style>
@endsection
@section('content')
<div id="tabs" class="col-md-12">
    <ul>
        <li> <a href="#fort"> Fort</a></li>
        <li> <a href="#moyenne">moyenne</a></li>
        <li> <a href="#faible">Faible </a></li>
    </ul>
    <div id="fort"> fort </div>
    <div id="moyenne"> moyenne </div>
    <div id="faible"> faible </div>
</div>

@endsection



@section('script')
<script>
    $(document).ready(function() {
        $("#tabs").tabs();
    });
</script>
@endsection
