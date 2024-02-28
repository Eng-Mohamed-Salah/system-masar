@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assets') }}/css/profile.css" rel="stylesheet"">
@endsection


@section('content')
{{-- Message Success --}}
@if(session('success'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="alertSuccess">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-circle-check fs-5"></i>
                <span class="mx-2"> {!!session('success')!!}  (<span class="countdown">5</span>)</span>
            </div>
        </div>
</div>
@endif

@yield('error')
{{-- Message Error --}}
@if(session('error'))
 <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="alertWrong">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                <span class="mx-2">{!!session('error')!!} (<span class="countdown">5</span>)</span>
            </div>
        </div>
    </div>
@endif


    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Client profile</h3>
            <!-- Edit Employee -->
            <div class="d-flex">
                <a href="{{ route('edit-client', ['id' => $clientData->id]) }}" class="btnGray py-2">Edit</a>
            </div>
        </div>

        <!-- View Bar -->
        <div class="viewBar">
            <div id="toggle-Attendance" class="boxBar department">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Plans</h6>
                        <div>
                            <h3 id="h3" class="d-inline-block"> {{$planesCount}}</h3>
                        </div>
                    </div>

                    <div class="boxIcon boxBlue">
                        <i class="fa-solid fa-handshake fa-xl"></i>
                    </div>
                </div>
            </div>
            <div id="toggle-Holidays" class="boxBar totalEmp">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total plans completed</h6>
                        <div>
                            <h3 id="h3" class="d-inline-block">{{$completeCount}} </h3>
                        </div>
                    </div>
                    <div class="boxIcon boxGreen">
                        <i class="fa-solid fa-check fa-xl"></i>
                    </div>
                </div>
            </div>
            <div id="toggle-Absence" class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total active plans </h6>
                        <div>
                            <h3 id="h3" class="d-inline-block">{{$activeCount}}</h3>
                        </div>
                    </div>
                    <div class="boxIcon boxRed">
                        <i class="fa-solid fa-rocket fa-xl"></i>
                    </div>
                </div>
            </div>
            <div id="toggle-triple" class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total payment </h6>
                        <div>
                            <h3 id="h3" class="d-inline-block">{{$totalPrice}}</h3>
                            <span class="text-warning"> EGP </span>
                        </div>
                    </div>
                    <div class="boxIcon boxGray">
                        <i class="fa-solid fa-coins fa-xl"></i>
                    </div>
                </div>
                <div class="statusBar">
                    <span id="span" class="opacityText">For Year </span>
                </div>
            </div>
        </div>
        <!-- view heade -->
        <div class="viewHead">
            <!-- Card Employee -->
            <div class="boxCard">
                <div class="d-flex w-100">
                    <div class="cover">
                        <div class="cardImg" id="willPopImgParent">
                            <img src="{{ isset($clientData->image) ? asset($globalVariable . 'images/client/' . $clientData->image) : asset($globalVariable . 'assetsClinet/imgs/testi-2.jpg') }}"
                                alt="img" id="willPopImg">
                        </div>

                        <div class="position-absolute "
                            style="z-index: 3 ; top:10% ; left:40% ; transition:.3s;scale:0;opacity:0 ; " id="popImgParent">
                            <img src="{{ isset($clientData->image) ? asset($globalVariable . 'images/client/' . $clientData->image) : asset($globalVariable . 'assetsClinet/imgs/testi-2.jpg') }}"
                                id="popImg"
                                style=" width:400px ; height:400px ; transition:.5s; border-radius:50% ;position: relative;z-index: 3; background-size: 100% 100% ">
                        </div>
                    </div>
                    <div class="userName">
                        <h4>{{ $clientData->name }}</h4>
                        <h6 class="py-2 h6">ID : #{{ $clientData->id }}</h6>
                    </div>
                </div>
                <div class="infoCard">
                    <span class="py-2">{{ $clientData->email }}</span>
                    <h6 class="py-2"></h6>
                    <span id="ageSpan" class="py-2"></span>
                    <h6 class="py-2"></h6>
                    <span class="m-0"> </span>
                </div>

                <div class="rating"></div>
            </div>
            <!-- Personal Details -->
            <div class="personalDetails">
                <div class="container">
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="person-tab" data-bs-toggle="tab" data-bs-target="#person"
                                type="button" role="tab" aria-controls="person" aria-selected="true">
                                person
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Status-tab" data-bs-toggle="tab" data-bs-target="#Status"
                                type="button" role="tab" aria-controls="Status" aria-selected="false">
                                Order
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <!-- person -->
                    <div class="tab-pane fade show active" id="person" role="tabpanel" aria-labelledby="person-tab">
                        <div class="d-flex">
                            <table class="table table-borderless mt-3">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name :</th>
                                        <td>{{ $clientData->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile</th>
                                        <td>{{ $clientData->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender</th>
                                        <td>male</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{ $clientData->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Join</th>
                                        <td>{{ $clientData->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Last Update :</th>
                                        <td>{{ $clientData->updated_at }}</td>
                                    </tr>
                                    <tr class="d-none">
                                        {{-- <th scope="row">age</th> --}}
                                        <td>
                                            {{-- <input id="birthdate" type="date" name="age"  value="22"> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="boxIdcard">
                                {{-- <div class="idaCard"> --}}
                                <!-- {{-- Set the image to a default path --}} -->
                                {{-- <img class="loupe" src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}" alt="{{ Auth::user()->name }}" alt="Employee Image"> --}}
                                <!-- {{-- Set the image to the employee's image --}} -->
                                {{-- <img class="loupe my-3" src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}" alt="{{ Auth::user()->name }}" alt="Employee Image">
                                        <img id="zoomedImage">
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- Order -->
                    <div class="tab-pane fade" id="Status" role="tabpanel" aria-labelledby="Status-tab">
                        <!-- <div class=""> -->
                        <div class="boxItem">
                            <table class="detailsMonth">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Plan price</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Complete</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientData->subscribes as $subscribe)
                                        <tr>
                                            <!-- Num -->
                                            <th>#{{ $subscribe->id }}</th>
                                            <!-- Plan Name -->
                                            <td>{{ $subscribe->planeService->title }}</td>
                                            <!-- Start date -->
                                            <td>{{ $subscribe->start_data }}</td>
                                            <!-- End date -->
                                            <td>{{ $subscribe->end_data }}</td>
                                            <!-- Price -->
                                            <td>{{ $subscribe->planeService->cost }} <span class="salery">.EGP</span></td>
                                            <!-- Notes -->
                                            <td id="employees" class="">
                                                <button class="btnAccordion employee-btn"
                                                    data-employee="{{ $subscribe->notes }}">Show Notes</button>
                                            </td>
                                            <!-- Complete -->
                                            <td>
                                                <form id="subscribeForm" action="{{ route('subscribe.updateComplete', ['subscribe' => $subscribe->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input name="complete" type="checkbox" class="complete-checkbox" value="1" data-subscribe-id="{{ $subscribe->id }}" {{$subscribe->complete == 1 ? 'checked' : ''}}>
                                                </form>
                                            </td>
                                            <!-- Action Button -->
                                            <td>
                                                <form action="{{ route('delete-subscribe', ['id' => $subscribe->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class=" text-danger btn-delete"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Alert Notes -->
                                        <div id="notes-container" style="display:none;">
                                            <div class="navNotes">
                                                <i id="closeNotes" class="fa-solid fa-angle-down"></i>
                                                <img src="{{ asset($globalVariable . 'images') }}/{{ Auth::user()->image }}"
                                                    alt="{{ Auth::user()->name }}">
                                            </div>
                                            <p id="notes"></p>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->
@endsection
@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/profile.js"></script>

    <script>
        // zoom img profile
        $(document).ready(function() {
            const $willPop = $("#willPopImg");
            const $popImg = $("#popImg");
            const $popImgParent = $("#popImgParent");
            const $willPopImgParent = $("#willPopImgParent");

            $willPop.on("mouseover", function() {
                $popImg.attr("src", $willPop.attr("src"));
                $popImgParent.css({
                    scale: '1',
                    opacity: '1'
                });
                $popImg.css({
                    transition: 'all .3s linear'
                });
            });

            $willPopImgParent.on("mouseleave", function() {
                $popImgParent.css({
                    scale: '0',
                    opacity: '0'
                });
                $popImg.css({
                    transition: 'all .3s linear'
                });
            });
        });
        // ======================= zoomed Image =============================
        $(document).ready(function() {
            $('.loupe').on(function() {
                var imageSrc = $(this).attr('src');
                $('#zoomedImage').attr('src', imageSrc).fadeToggle();
            });
        });
    </script>


    {{--  Update Complate Plane --}}
    <script>
        $(document).ready(function(){
            $('.complete-checkbox').click(function(){
                if($(this).is(':checked')) {
                    $(this).val(0);
                } else {
                    $(this).val(1);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.complete-checkbox').change(function(){
                var isChecked = $(this).prop('checked');
                var subscribeId = $(this).data('subscribe-id');
                var formData = {
                    'complete': isChecked ? 1 : 0,
                    '_token': $('input[name=_token]').val()
                };

                $.ajax({
                    type: 'PATCH',
                    url: '/subscribe/' + subscribeId,
                    data: formData,
                    success: function(data){
                        console.log('تم التحديث بنجاح');
                    },
                    error: function(data){
                        console.log('حدث خطأ أثناء محاولة التحديث');
                    }
                });
            });
        });
    </script>

@endsection
