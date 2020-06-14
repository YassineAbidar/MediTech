@extends('admin.include.default')
@section('style')
<style>
    hr{
        width: 100%;
        height: 2px;
        background-color: #1de9b6;
    }

</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card" style="box-shadow: none;">
        <div class="card-header bg-default text-white">
            Create new facture
        </div>
        <div class="card-body">
            <form id="form_facture" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <span class="font-weight-bold">Client</span>
                        <hr>

                        @csrf
                        <div class="form-group">
                            <label for="client">Select client</label>
                            <select name="client" id="client" class="form-control">
                                <option value="0">---</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->nom." ".$client->prenom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Code Client </label>
                            <input type="text" class="form-control" name="code_client" id="code_client">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="tele" id="tele">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="font-weight-bold">Product</span>
                        <hr>
                        <div class="form-group">
                            <div id="alert_message" style="display: none;" class="alert alert-warning" role="alert"></div>
                            <Label for="produit"></Label>
                            <select name="produits[]" id="produits" multiple class="form-control">
                                Select products
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->libelle}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <input type="button" class="btn btn-primary float-right" value="Add" id="btn_add_product">
                            </div>
                            <div class="form-group">

                                <table id="table_select_pro" style="display: none;" class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Prix unitaire</th>
                                            <th>Quantity stock</th>
                                            <th>Quantity Demande</th>
                                        </tr>
                                    </thead>
                                    <tbody name="produit"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button id="btn_save" style="display: none;" type="submit" class="btn btn-outline-primary" type="button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_add_product', function(e) {
            e.preventDefault();
            let list_product = $("#produits").val();
            console.log(list_product);
            $.ajax({
                url: "{{route('product.productChoisi')}}",
                type: "GET",
                contentType: 'application/json',
                data: {
                    'products': list_product,
                },
                success: function(data) {
                    console.log(data);
                    if (data.status) {
                        $("#table_select_pro").show();
                        $("tbody").html(data.products);
                        $("#btn_save").show();
                        $("#alert_message").hide();
                    } else {
                        $("#alert_message").show();
                        $("#alert_message").text(data.message);
                        $("#btn_save").hide();
                    }
                },
                error: function(err, two, tre) {
                    console.log(err);
                    console.log(two);
                    console.log(tre);
                }
            });

        });
        $(document).on('change', '#client', function(e) {
            e.preventDefault();
            let id_client = $("#client").val();
            console.log(id_client);
            $.ajax({
                url: "/admin/client/getInfo/" + id_client,
                type: "GET",
                data: {
                    'id_client': id_client,
                },
                success: function(data) {
                    console.log(data);
                    // client
                    if (data.status) {
                        $("#code_client").val(data.client.code_client);
                        $("#tele").val(data.client.tele);
                    } else {
                        $("#code_client").val("");
                        $("#tele").val("");
                    }
                },
                error: function(err, two, tre) {
                    console.log(err);
                    console.log(two);
                    console.log(tre);
                }
            });

        });
        $(document).on('submit', '#form_facture', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('facture.store')}}",
                method: "POST",
                data: $("#form_facture").serialize(),
                success: function(data) {
                    console.log(data);
                },
                error: function(one, two, three) {
                    console.log(one, two, three);
                }
            });


        });
    });
</script>
@endsection
