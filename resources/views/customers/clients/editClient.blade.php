@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset($globalVariable . 'assets') }}/css/edit.css" rel="stylesheet"">
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


    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Edit Client</h3>
            <a href="{{ route('showDetails-client', ['id' => $clientData->id]) }}" class="btnGray py-2"><i
                    class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
        <!-- view heade -->
        <div class="viewHead">
            <!-- Card Employee -->
            <div class="boxCard">
                <div class="d-flex w-100">
                    <div class="cover">
                        <div class="cardImg">
                            <img id="myImage3"
                                src="{{ isset($clientData->image) ? asset($globalVariable . 'images/client/' . $clientData->image) : asset($globalVariable . 'assetsClinet/imgs/testi-2.jpg') }}"
                                alt="{{ Auth::user()->name }}" alt="">
                            <span id="editBtn3" class="">
                                <i class="fa-solid fa-camera fa-xl"></i>
                            </span>
                        </div>
                    </div>
                    <div class="userName">
                        <h4 id="d-name">{{ $clientData->name }}</h4>
                    </div>
                </div>
                <div class="infoCard">
                    <span id="d-email" class="py-2">{{ $clientData->email }}</span>
                    <span id="d-address" class="py-2">{{ $clientData->address }}</span>
                    <span id="ageSpan" class="py-2"></span>
                    <h6 id="d-status" class="py-2"></h6>
                </div>
                <div class="rating">
                </div>
            </div>
            <!-- Personal Details -->
            <div class="personalDetails">
                <div class="container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                    <div class="tab-pane fade show active" id="person" role="tabpanel" aria-labelledby="person-tab">
                        <!-- person -->
                        <form action="{{ route('update-client', ['id' => $clientData->id]) }}" method="POST"
                            class="viewBar" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box1 w-50">
                                {{-- User Name --}}
                                <div class="boxInput">
                                    <input id="live-name" type="text" class="form-control" placeholder="User Name"
                                        name="name" aria-label="Username" aria-describedby="addon-wrapping"
                                        value="{{ $clientData->name }}">
                                </div>
                                {{-- email --}}
                                <div class="boxInput">
                                    <input id="live-email" type="email" name="email" class="form-control"
                                        placeholder="@email.com" value="{{ $clientData->email }}">
                                </div>
                                {{-- Address --}}
                                <div class="boxInput">
                                    <input id="live-address" name="address" type="text"
                                        value="{{ $clientData->address }}" class="form-control" placeholder="Address"
                                        aria-label="Username" aria-describedby="addon-wrapping">
                                </div>
                                {{-- Moblie --}}
                                <div class="boxInput">
                                    <input type="text" value="{{ $clientData->phone }}" name="phone" maxlength="11"
                                        class="form-control" placeholder="+20 01" aria-label="Username"
                                        aria-describedby="addon-wrapping">
                                </div>
                                {{-- age --}}
                                {{-- <div class="boxInput salery">
                                    <span class="mx-4">Age</span>
                                    <input id="birthdate" type="date" name="age" class="form-control" placeholder="Birthday" aria-label="Username" value="" aria-describedby="addon-wrapping">
                                </div> --}}
                                {{-- gender --}}
                                {{-- <div class="boxInput">
                                    <select id="inputGroupSelect03" name="gender"
                                        aria-label="Example select with button addon">
                                        <option value=" male">male</option>
                                        <option value="female">female </option>
                                    </select>
                                </div> --}}
                            </div>

                            <div class="boxIdcard">
                                {{-- <div class="idaCard"> --}}
                                <!-- {{-- Set the image to the employee's image --}} -->
                                {{-- <img class="loupe" id="myImage2" src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}" alt="{{ Auth::user()->name }}" alt="Employee Image">
                                    <img id="zoomedImage">
                                    <span id="editBtn2" class="">
                                        <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                    </span>
                                    <input type="file" name='image3' id="newImage2" style="display:none;">
                                </div> --}}

                                {{-- <div class="idaCard"> --}}

                                <!-- {{-- Set the image to the employee's image --}} -->
                                {{-- <img class="loupe" id="myImage" src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}" alt="{{ Auth::user()->name }}" alt="Employee Image">
                                    <img id="zoomedImage">

                                    <span id="editBtn" class="">
                                        <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                    </span>
                                    <input type="file" name='image2' id="newImage" style="display:none;">
                                </div> --}}

                                <input type="file" name='image' id="newImage3" style="display:none;">

                                <button type="submit" class="saveBtn btn btn-primary">Update</button>

                            </div>
                        </form>
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
                                        <th scope="col">Notes</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        <th scope="col">Complete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientData->subscribes as $subscribe)
                                        <tr>

                                            <!-- ID -->
                                            <th>#{{ $subscribe->id }}</th>
                                            <form action="{{route('update-subscribe',['id'=>$subscribe->id])}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Day -->
                                                <td>
                                                    {{-- Select Plan --}}
                                                    <div class="mx-1">
                                                        <select class="form-select" name="plane_service_id"
                                                            aria-label="Default select example">
                                                            @foreach ($planeData as $plane)
                                                                <option value="{{ $plane->id }}"
                                                                    {{ $subscribe->planeService->id == $plane->id ? 'selected' : '' }}>
                                                                    {{ $plane->title }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </td>
                                                <!-- Start Date -->
                                                <td>
                                                    <div class="mx-1">
                                                        <input type="date" class="form-control" placeholder="Start"
                                                            name="start_data" aria-describedby="addon-wrapping"
                                                            value="{{ $subscribe->start_data }}">
                                                    </div>
                                                </td>
                                                <!-- End Date -->
                                                <td>
                                                    <div class="mx-1">
                                                        <input type="date" class="form-control" placeholder="End"
                                                            name="end_data" aria-describedby="addon-wrapping"
                                                            value="{{ $subscribe->end_data }}">
                                                    </div>
                                                </td>
                                                <!-- Notes -->
                                                <td>
                                                    <span class="btnAccordion">
                                                        Notes
                                                    </span>
                                                    <div class="panel">
                                                        <!-- <input type="hidden" name="_method" value="PUT"> -->
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="attendance_notes" name="notes" rows="3">{{ $subscribe->notes }}</textarea>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            {{-- <button class="btnPrimary my-2">Update</button> --}}
                                                            <span class="closeNotes"><i
                                                                    class="fa-solid fa-angle-down"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- edit Buttons -->
                                                <td>
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa-regular fa-pen"></i>
                                                    </button>
                                                </td>
                                            </form>
                                            {{-- <td>
                                                <div class="d-flex align-items-center justify-content-between position-relative flex-wrap-reverse m-auto" style="max-width: 120px">
                                                    <input type="number" class="form-control" placeholder="Edit Price" value="" name="amount" step="any">
                                                    <span class="position-absolute text-warning" style="right: 5px">EGP</span>
                                                </div>
                                            </td> --}}

                                            <!-- delete Buttons -->
                                            <td>
                                                <form action="{{ route('delete-subscribe', ['id' => $subscribe->id]) }}"
                                                    method="POST" class="delete btn-danger">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm delete btn-danger">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>

                                                </form>
                                            </td>
                                            <!-- Complete -->
                                            <td>
                                                <form id="subscribeForm"
                                                    action="{{ route('subscribe.updateComplete', ['subscribe' => $subscribe->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input name="complete" type="checkbox" class="complete-checkbox"
                                                        value="1" data-subscribe-id="{{ $subscribe->id }}"
                                                        {{ $subscribe->complete == 1 ? 'checked' : '' }}>
                                                </form>
                                            </td>
                                            <!-- price -->
                                        </tr>
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
@endsection

<!-- Alert Notes -->
<div id="notes-container" style="display:none;">
    <div class="navNotes">
        <i id="closeNotes" class="fa-solid fa-x"></i>
        <img src="">
    </div>
    <p id="notes"></p>
</div>

@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/edit.js"></script>

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
        $(document).ready(function() {
            $('.complete-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $(this).val(0);
                } else {
                    $(this).val(1);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.complete-checkbox').change(function() {
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
                    success: function(data) {
                        console.log('تم التحديث بنجاح');
                    },
                    error: function(data) {
                        console.log('حدث خطأ أثناء محاولة التحديث');
                    }
                });
            });
        });


        $(document).ready(function() {
            $('select[name="plane_service_id"], input[name="start_data"], input[name="end_data"], textarea[name="notes"]')
                .change(function() {
                    var id = $(this).closest('tr').data('id');
                    var plane_service_id = $('select[name="plane_service_id"]').val();
                    var start_data = $('input[name="start_data"]').val();
                    var end_data = $('input[name="end_data"]').val();
                    var notes = $('textarea[name="notes"]').val();

                    $.ajax({
                        url: '{{ route('updateSubscribe') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            plane_service_id: plane_service_id,
                            start_data: start_data,
                            end_data: end_data,
                            notes: notes,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log('Data updated successfully');
                            } else {
                                console.log('Error updating data');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });
        });
    </script>
@endsection
