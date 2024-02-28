@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assetsCustomers') }}/css/showPlans.css" rel="stylesheet"">
@endsection


@section('content')
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Edit Plan</h3>
            <a href="/show-plane" class="btnGray py-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
        @foreach ($planeData as $plane )

        <!-- payment -->
        <section class="payment py-5" id="payment">
            <form action="{{route('update-plane',['id'=> $plane->id])}}" method="POST" class="container">
                @csrf
                @method('PUT')
                <div class="modal-body row">
                    <div class="col-7 mb-3">
                        <div class="input-group pb-2">
                            <input type="text" id="live-plan" class="form-control" name="title" value="{{ $plane->title }}" placeholder="Plan Name" >
                        </div>
                        <div class="input-group py-2 justify-content-end">
                            <input type="number" id="live-price" class="form-control" placeholder="Type Price" value="{{$plane->cost}}" name="cost" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                        </div>
                        @foreach($plane->customService as $index => $customService)
                        <div class="input-group py-2">
                            <input type="text" id="live-item-{{$index + 1}}" class="form-control" value="{{$customService}}" name="customService[]" placeholder="item {{$index + 1}}" >
                        </div>
                        @endforeach
                     </div>
                    <div class="col card-payment mx-2 mb-3">
                        <div class="card-head card-orange">
                            <span class="circle"></span>
                            <span class="img-head">
                                <img src="{{ asset($globalVariable . 'assetsCustomers') }}/img/icon8.png" alt="">
                            </span>
                        </div>
                        <div class="prise">
                            <span id="d-plan" class="basic">basic</span>
                            <div>
                                <span class="dolar text-warning">EGP</span>
                                <span id="d-price" class="number">2999</span>
                                <span class="month">/month</span>
                            </div>
                        </div>
                        <ul class="h-75">
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-1"> item 1</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-2"> item 2</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-3"> item 3</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-4"> item 4</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-5"> item 5</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-6"> item 6</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-7"> item 7</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-8"> item 8</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-9"> item 9</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-10"> item 10</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-11"> item 11</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-12"> item 12</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-13"> item 13</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-14"> item 14</span></li>
                            <li> <span class="p-2 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> <span id="d-item-15"> item 15</span></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btnPrimary">Save</button>
                </div>
            </form>
        </section>
        @endforeach

    </header>
@endsection
@section('scripts')
<script>
    // ======================= Live typing text =============================
    $(document).ready(function () {
        $("#live-plan").on("input", function() {
            var planValue = $(this).val();
            $("#d-plan").text(planValue);
        });
        $("#live-price").on("input", function() {
            var priceValue = $(this).val();
            $("#d-price").text(priceValue);
        });

        $("#live-item-1").on("input", function() {
            var item1 = $(this).val();
            $("#d-item-1").text(item1);
        });
        $("#live-item-2").on("input", function() {
            var item2 = $(this).val();
            $("#d-item-2").text(item2);
        });
        $("#live-item-3").on("input", function() {
            var item3 = $(this).val();
            $("#d-item-3").text(item3);
        });
        $("#live-item-4").on("input", function() {
            var item4 = $(this).val();
            $("#d-item-4").text(item4);
        });
        $("#live-item-5").on("input", function() {
            var item5 = $(this).val();
            $("#d-item-5").text(item5);
        });
        $("#live-item-6").on("input", function() {
            var item6 = $(this).val();
            $("#d-item-6").text(item6);
        });
        $("#live-item-7").on("input", function() {
            var item7 = $(this).val();
            $("#d-item-7").text(item7);
        });
        $("#live-item-8").on("input", function() {
            var item8 = $(this).val();
            $("#d-item-8").text(item8);
        });
        $("#live-item-9").on("input", function() {
            var item9 = $(this).val();
            $("#d-item-9").text(item9);
        });
        $("#live-item-10").on("input", function() {
            var item10 = $(this).val();
            $("#d-item-10").text(item10);
        });
        $("#live-item-11").on("input", function() {
            var item11 = $(this).val();
            $("#d-item-11").text(item11);
        });
        $("#live-item-12").on("input", function() {
            var item12 = $(this).val();
            $("#d-item-12").text(item12);
        });
        $("#live-item-13").on("input", function() {
            var item13 = $(this).val();
            $("#d-item-13").text(item13);
        });
        $("#live-item-14").on("input", function() {
            var item14 = $(this).val();
            $("#d-item-14").text(item14);
        });
        $("#live-item-15").on("input", function() {
            var item15 = $(this).val();
            $("#d-item-15").text(item15);
        });
    });
</script>

@endsection
