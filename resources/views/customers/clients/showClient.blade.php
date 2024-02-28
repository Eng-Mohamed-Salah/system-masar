@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assetsCustomers') }}/css/showClinet.css" rel="stylesheet"">
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
            <h3>Client</h3>

            <div class="d-flex">
                <!-- {{-- Add Card --}} -->
                <button class="btnGray w-100" data-bs-toggle="modal" data-bs-target="#exampleModalBasic">
                    <i class="fa-solid fa-plus"></i>
                    Add Client
                </button>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="d-flex justify-content-between">
                    <span class="mx-3 mt-4">
                        <h5 class="text-color">Total Clients ( <span id="numberOfCards"></span> )</h5>
                    </span>
                    {{-- <!-- Search Employees --> --}}
                    <div class="mx-3 mt-4">
                        <input class="form-control" type="text" id="searchInput" placeholder="Search Name or ID">
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div id="cardContainer" class="row d-flex align-items-stretch">
                        @foreach ($clientData as $client)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="text-color"><b>{{ $client->name }}</b></h2>
                                                <ul class="px-0 fa-ul text-muted">
                                                    <li class="small my-4">
                                                        <strong>ID : #{{ $client->id }}</strong>
                                                    </li>
                                                    <li class="small my-4">
                                                        <span class="pr-2"><i class="fas fa-lg fa-phone"></i></span>
                                                        Phone : {{ $client->phone }}
                                                    </li>
                                                    <li class="small my-4">
                                                        <span class="pr-2"><i class="fa-solid fa-envelope"></i></span>
                                                        Email : {{ $client->email }}
                                                    </li>
                                                    <li class="small my-4">
                                                        <span class="pr-2"><i class="fas fa-lg fa-building"></i></span>
                                                        Address : {{ $client->address ?? '' }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ isset($client->image) ? asset($globalVariable . 'images/client/' . $client->image) : asset($globalVariable . 'assetsClinet/imgs/testi-2.jpg') }}"
                                                    alt="" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="{{ route('showDetails-client', ['id' => $client->id]) }}"
                                                class="btn btnPrimary">
                                                <i class="fas fa-user"></i> profile
                                            </a>
                                            <button class="btn btnGray" data-bs-toggle="modal"
                                                data-bs-target="#cratePlan{{ $client->id }}">
                                                <i class="fas fa-handshake"></i> subscription
                                            </button>
                                            <form action="{{ route('delete-client', ['id' => $client->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="row">
                                    <div class="col-7">
                                        <h2 class="text-color"><b>mohamed</b></h2>
                                        <ul class="px-0 fa-ul text-muted">
                                            <li class="small my-4">
                                                <strong>ID : #5785</strong>
                                            </li>
                                            <li class="small my-4">
                                                <span class="pr-2"><i class="fas fa-lg fa-phone"></i></span>
                                                Phone : 01030804922
                                            </li>
                                            <li class="small my-4">
                                                <span class="pr-2"><i class="fa-solid fa-envelope"></i></span>
                                                Email : hadyrabie@gmail.com
                                            </li>
                                            <li class="small my-4">
                                                <span class="pr-2"><i class="fas fa-lg fa-building"></i></span>
                                                Address : cairo , Elmokkatam , Elhadaba-elwstaa
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/testi-2.jpg" alt="" class="img-circle img-fluid">
                                    </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{url('/profile')}}" class="btn btnPrimary">
                                            <i class="fas fa-user"></i> profile
                                        </a>
                                        <button class="btn btnGray" data-bs-toggle="modal" data-bs-target="#cratePlan">
                                            <i class="fas fa-handshake"></i> subscription
                                        </button>
                                        <button class="btn btn-sm  btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </header>


    {{-- Popup Window Crate Client --}}
    <form action="{{ route('create-client') }}" method="POST" class="modal fade" id="exampleModalBasic"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body row">
                    <div class="col-7 mb-3">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                aria-label="Username" aria-describedby="basic-addon1" value="">
                        </div>
                        <div class="input-group mb-4">
                            <input type="email" class="form-control" placeholder="name@email.com" name="email"
                                aria-label="Username" aria-describedby="basic-addon1" value="">
                        </div>
                        <div class="input-group mb-4 justify-content-end">
                            <input type="number" class="form-control" placeholder="Phone Number" value=""
                                name="phone" step="any">
                        </div>
                        <div class="input-group mb-4 justify-content-end">
                            <textarea class="form-control" placeholder="Address" name="address" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    {{-- Upload  --}}
                    <div class="col mb-3">
                        <div class="input-group uploadImg">
                            <span class="minImg">
                                <label for="file-upload0" class="custom-upload-button">Upload Image</label>
                                <input type="file" id="file-upload0" name="image" class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btnPrimary">Save</button>
                </div>
            </div>
        </div>
    </form>


    @foreach ($clientData as $client)
        {{-- Popup Window Crate plan --}}
        <form class="modal fade" id="cratePlan{{ $client->id }}" action="{{ route('create-subscribe') }}"
            method="POST">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <div class="modal-dialog">
                <div class="modal-content popupWindow">
                    {{-- Nav Popup --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Subscribe to new plan</h5>
                        <button type="button" class="btn-close closepopup" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body row">
                        <div class="col-7 mb-3">
                            {{-- Select Type --}}
                            <div class="input-group mb-4">
                                <select class="form-select" name= "plane_service_id" aria-label="Default select example">
                                    <option selected disabled>Select Plan </option>
                                    @foreach ($planeData as $plane)
                                        <option value="{{ $plane->id }}">{{ $plane->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" placeholder="Start" name="start_data"
                                    aria-describedby="addon-wrapping" value="">
                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" placeholder="End" name="end_data"
                                    aria-describedby="addon-wrapping" value="">
                            </div>
                        </div>
                        <div class="col input-group">
                            <textarea class="form-control" style="height: 85% !important;" placeholder="Notes" name="notes"
                                aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btnPrimary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endsection
@section('scripts')
    <script>
        // ============================== upload images2 ==============================
        $(document).ready(function() {
            $('.file-upload').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                var minImg = $(this).closest('.minImg');

                reader.onload = function() {
                    var img = minImg.find('img');
                    img.attr('src', reader.result);
                    img.css('display', 'block');
                    minImg.find('.delete-button').css('display', 'flex');
                };

                reader.readAsDataURL(file);
            });

            $('.delete-button').click(function() {
                var minImg = $(this).closest('.minImg');
                var img = minImg.find('img');
                img.attr('src', '');
                img.css('display', 'none');
                var input = minImg.find('.file-upload');
                input.val('');
                $(this).css('display', 'none');
            });
        });
    </script>

    <script>
        // البحث عند كتابة في حقل البحث
        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().trim().toLowerCase();

            // تنفيذ البحث على النصوص الموجودة في البطاقات
            $('#cardContainer .card').each(function() {
                var cardText = $(this).text().toLowerCase();
                if (cardText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // عرض جميع البطاقات عند تحميل الصفحة
        $(document).ready(function() {
            // يمكنك ترك هذا الجزء إذا كنت تريد عرض جميع البطاقات عند بدء التحميل
        });
    </script>
    <script>
        function updateNumberOfCards() {
            var numberOfCards = $('#cardContainer .card').length;
            $('#numberOfCards').text(numberOfCards);
        }
        $(document).ready(updateNumberOfCards);
    </script>
@endsection
