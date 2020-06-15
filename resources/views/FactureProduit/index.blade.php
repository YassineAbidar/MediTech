@extends('admin.include.default')
@section('style')
<style>
</style>
@endsection

@section('content')
    <div class="col-md-12">
        <form action="{{route('FacturProduit.store')}}" method="POST">
            @csrf
            <input type="text" name="facture_id">
            <input type="text" name="produit_id">
            <input type="number" name="qty">
            <button type="submit">Save</button>

        </form>
    </div>
@endsection
