@extends('customers.layout.shardClient')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assets') }}/css/fancybox.css" rel="stylesheet">
    <link href="{{ asset($globalVariable . 'asstesService') }}/css/service.css" rel="stylesheet"">
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
            <h3>Programming projects</h3>
            <div class="d-flex">
                <!-- {{-- Add Photo --}} -->
                <button class="btnGray w-100" data-bs-toggle="modal" data-bs-target="#addProject">
                    <i class="fa-solid fa-plus"></i>
                    Add Photo
                </button>
            </div>
        </div>

        <!-- photography -->
        <section class="content">
            <div class="d-flex justify-content-between">
                <span class="mx-3 mt-4">
                    <h5 class="text-color">Total Projects ( <span id="numberOfCards"></span> )</h5>
                </span>
            </div>
            <div class="px-2">
                <!-- programming -->
                <div class="tab-pane" id="programming" role="tabpanel" aria-labelledby="programming-tab">
                    <div class="row">
                        @foreach ($programmingData as $proData)
                            <div class="col-4">
                                <section class="part">
                                    <div class="project-card my-3">
                                        <img src="{{ asset($globalVariable . '/image/services/' . $proData->image) }}"
                                            alt="Project 1">
                                        <div class="overlay"></div>
                                    </div>
                                    <span class="title-cards mx-3">
                                        <h4>{{$proData->title}}</h4>
                                        {{-- <article class=" my-2">website: marketing & programming</article> --}}
                                        <div>
                                            <a class="btn btn-sm  btn-dark"
                                                href="{{ asset($globalVariable . '/image/services/' . $proData->image) }}"
                                                data-fancybox="gallery"><i class="fa-solid fa-expand fa-xl"></i></a>

                                            <form action="{{route('delete-programmingService' ,['id'=>$proData->id])}}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-sm  btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                                <a href="{{route('edit-programmingService' ,['id'=> $proData->id])}}" class="btn btn-sm btn-success">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </span>
                                </section>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
    </header>


    {{-- Popup Window Crate Client --}}
    <form action="{{ route('create-programming') }}" method="POST" class="modal fade" id="addProject"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Upload  --}}
                <div class="modal-body row">
                    <div class="col-12 mx-2 my-2">
                        <section class="part">
                            <div class="project-card my-3">
                                <img id="selectedImage"
                                    src="{{ asset($globalVariable . 'asstesService') }}/img/ui masar 1.png" alt="Project 1">
                                <div class="overlay"></div>
                            </div>
                            <span class="title-cards opacity-1">
                                <h4 class="mx-2" id="d-titleProject">title project</h4>
                                <article class="mx-2" id="d-Description">Description</article>
                            </span>
                        </section>
                    </div>
                    <div class="col-12 my-3">
                        <div class="input-group pb-2">
                            <input type="text" id="live-titleProject" class="form-control" placeholder="Title Project"
                                name="title">
                        </div>
                        <div class="input-group py-2">
                            <input type="text" id="live-Description" class="form-control" placeholder="Description"
                                name="descriptions">
                        </div>
                        <span class="input-group pt-2">
                            <input type="file" id="imageInput" class="form-control" placeholder="Long picture"
                                name="image">
                        </span>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btnPrimary">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/fancybox.umd.js"></script>
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function() {
                var input = this;
                var img = $('#selectedImage');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        img.attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
    {{-- Live typeing --}}
    <script>
        // ======================= Live typing text =============================
        $(document).ready(function() {
            $("#live-titleProject").on("input", function() {
                var projectValue = $(this).val();
                $("#d-titleProject").text(projectValue);
            });
            $("#live-Description").on("input", function() {
                var descriptioneValue = $(this).val();
                $("#d-Description").text(descriptioneValue);
            });
        });
    </script>
    <script>
        Fancybox.bind("[data-fancybox]", {

        });
    </script>
    {{-- total Lenght photo --}}
    <script>
        function updateNumberOfCards() {
            var numberOfCards = $('#programming .part').length;
            $('#numberOfCards').text(numberOfCards);
        }
        $(document).ready(updateNumberOfCards);
    </script>
@endsection
