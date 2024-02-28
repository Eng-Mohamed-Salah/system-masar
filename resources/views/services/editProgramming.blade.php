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
            <h3>Edit project</h3>
            <a href="/show-programming" class="btnGray py-2"><i class="fa-solid fa-arrow-left"></i> Back</a>

        </div>

        <!-- photography -->
        <form action="{{ route('update-programmingService', ['id' => $programmingData->id]) }}" method="POST"
            class="content" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body row">
                <div class="col my-4 ">
                    <div class="input-group pb-4">
                        <input type="text" id="live-titleProject" class="form-control" placeholder="Title Project"
                            name="title" value="{{ $programmingData->title }}">
                    </div>
                    <div class="input-group py-4">
                        <input type="text" id="live-Description" class="form-control" placeholder="Description"
                            name="descriptions" value="{{ $programmingData->descriptions }}">
                    </div>
                    <span class="input-group py-4">
                        <input type="file" id="imageInput" class="form-control" placeholder="Long picture" name="image"
                            value="{{ $programmingData->image }}">
                    </span>
                    <div class="d-flex justify-content-between pt-4">
                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">delete</button> --}}
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
                <div class="col-5 my-4">
                    <section class="part">
                        <div class="project-card" style="max-height: 300px; height:100%">
                            <img id="selectedImage"
                                src="{{ asset($globalVariable . '/image/services/' . $programmingData->image) }}"
                                alt="Project 1">
                            <div class="overlay"></div>
                        </div>
                        <span class="title-cards opacity-1">
                            <h4 class="mx-2" id="d-titleProject">{{ $programmingData->title }}</h4>
                            <article class="mx-2" id="d-Description">{{ $programmingData->descriptions }}</article>
                        </span>
                    </section>
                </div>
            </div>

        </form>
    </header>
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
@endsection
