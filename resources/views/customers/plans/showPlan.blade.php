@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assetsCustomers') }}/css/showPlans.css" rel="stylesheet"">
@endsection


@section('content')
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Plans</h3>
            <div class="d-flex">
                <!-- {{-- Add Card --}} -->
                <button class="btnGray w-100" data-bs-toggle="modal" data-bs-target="#cratePlan">
                    <i class="fa-solid fa-plus"></i>
                    Add Plan
                </button>
            </div>
        </div>

        <!-- payment -->
        <section class="payment" id="payment">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <span class="mx-3 mt-4">
                        <h5 class="text-color">Total Plans ( <span id="numberOfCards"></span> )</h5>
                    </span>
                </div>
                <div id="cardContainer" class="flex-payment">
                    @foreach($planeData as $plane)
                    <div class="card-payment">
                        <div class="card-head card-orange">
                            <span class="circle"></span>
                            <span class="img-head">
                                <img src="{{ asset($globalVariable . 'assetsCustomers') }}/img/icon8.png" alt="">
                            </span>
                        </div>
                        <div class="prise">
                            <span class="basic">{{ $plane->title }} </span>
                            <div>
                                <span class="dolar text-warning">EGP</span>
                                <span class="number">{{ $plane->cost }}</span>
                                <span class="month">/month</span>
                            </div>
                        </div>
                        <ul>
                            @foreach($plane->customService as $customService)
                                @if (@isset($customService))
                                <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> {{ $customService }}</li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="boxBtn">
                            <a class="btn btnPrimary w-50" href="{{ route('edit-plane',['id' => $plane->id]) }}" style="clip-path: polygon(0 0, 100% 0, 70% 100%, 0 100%);">Edit</a>
                            <form method="POST" action="{{route('delete-plane', ['id' => $plane->id])}}" class="btn btnTomato w-50" style="clip-path: polygon(39% 0, 100% 0, 100% 100%, 0 100%);">
                                @csrf
                                @method('DELETE')
                                <button class="btn btnTomato w-50" >Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="card-payment">
                        <div class="card-head card-orange">
                            <span class="circle"></span>
                            <span class="img-head">
                                <img src="{{ asset($globalVariable . 'assetsCustomers') }}/img/icon8.png" alt="">
                            </span>
                        </div>
                        <div class="prise">
                            <span class="basic">basic</span>
                            <div>
                                <span class="dolar text-warning">EGP</span>
                                <span class="number">2999</span>
                                <span class="month">/month</span>
                            </div>
                        </div>
                        <ul>
                            <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> Image Generation</li>
                            <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> Article Rewriting</li>
                            <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> Email Writeup</li>
                            <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> Monthly Reporting</li>
                            <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> PPC Advertising</li>
                            <li> <span class="px-3 textPrimary"> <i class="fa-solid fa-circle-check"></i> </span> Web Design & Development</li>
                        </ul>
                        <div class="boxBtn">
                            <a class="btn btnPrimary w-50" href="{{ url('/edit-plan') }}" style="clip-path: polygon(0 0, 100% 0, 70% 100%, 0 100%);">Edit</a>
                            <button class="btn btnTomato w-50" style="clip-path: polygon(39% 0, 100% 0, 100% 100%, 0 100%);">Delete</button>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
        <!-- End -->
    </header>

    {{-- Popup Window Crate Pplan --}}
    <div class="modal fade" id="cratePlan">
        <div  class="modal-dialog" style="max-width: 900px">
           <form method="POST" action="{{route('create-plane')}}">
            @csrf
                <div class="modal-content popupWindow">
                    {{-- Nav Popup --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Plan</h5>
                        <button type="button" class="btn-close closepopup" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body row">
                        <form class="col-7 mb-3">
                            <div class="input-group pb-2">
                                <input type="text" id="live-plan" class="form-control" placeholder="Plan Name" name="title">
                            </div>
                            <div class="input-group py-2 justify-content-end">
                                <input type="number" id="live-price" class="form-control" placeholder="Type Price" value="" name="cost" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-1" class="form-control" placeholder="item 1" name="customService[]">
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-2" class="form-control" placeholder="item 2" name="customService[]">
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-3" class="form-control" name="customService[]" placeholder="item 3" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-4" class="form-control" name="customService[]" placeholder="item 4" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-5" class="form-control" name="customService[]" placeholder="item 5" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-6" class="form-control" name="customService[]" placeholder="item 6" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-7" class="form-control" name="customService[]" placeholder="item 7" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-8" class="form-control" name="customService[]" placeholder="item 8" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-9" class="form-control" name="customService[]" placeholder="item 9" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-10" class="form-control" name="customService[]" placeholder="item 10" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-11" class="form-control" name="customService[]" placeholder="item 11" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-12" class="form-control" name="customService[]" placeholder="item 12" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-13" class="form-control" name="customService[]" placeholder="item 13" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-14" class="form-control" name="customService[]" placeholder="item 14" >
                            </div>
                            <div class="input-group py-2">
                                <input type="text" id="live-item-15" class="form-control" name="customService[]" placeholder="item 15" >
                            </div>
                        </form>
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
                </div>
             </form>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- Live typeing --}}
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
    {{-- total Linght cards --}}
    <script>
        function updateNumberOfCards() {
            var numberOfCards = $('#cardContainer .card-payment').length;
            $('#numberOfCards').text(numberOfCards);
        }
        $(document).ready(updateNumberOfCards);
    </script>
@endsection
