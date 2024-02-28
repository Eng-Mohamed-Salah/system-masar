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
            <h3>Edit Marketing</h3>
            <a href="/show-marketing" class="btnGray py-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

        <!-- marketing -->
        <form action="{{ route('update-marketing', ['id' => $marketData->id]) }}" method="POST" class="content"
            id="addmarketing">
            @csrf
            @method('PUT')
            <div class="modal-body row">
                <div class="col-8 my-3">
                    <div class="input-group pb-2">
                        <select name="department" class="form-select" id="Marketing-type">
                            <option value="Digital Marketing"
                                {{ $marketData->department == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing
                            </option>
                            <option value="Digital Print"
                                {{ $marketData->department == 'Digital Print' ? 'selected' : '' }}>Digital Print</option>
                            <option value="Affiliate Marketing"
                                {{ $marketData->department == 'Affiliate Marketing' ? 'selected' : '' }}>Affiliate Marketing
                            </option>
                            <option value="Real Estate Marketing"
                                {{ $marketData->department == 'Real Estate Marketing' ? 'selected' : '' }}>Real Estate
                                Marketing</option>
                            <option value="Media Production"
                                {{ $marketData->department == 'Media Production' ? 'selected' : '' }}>Media Production
                            </option>

                        </select>
                    </div>
                    <div class="input-group py-2">
                        <input type="text" class="form-control" id="live-Marketing" placeholder="Title Marketing"
                            name="title" value="{{ $marketData->title }}">
                    </div>
                    <div class="input-group py-2">
                        <textarea class="form-control" id="live-Description" name="descriptions" cols="30" rows="10"
                            placeholder="Description">{{ $marketData->descriptions }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="card-features" style="max-width:none">
                        <div class="container-card bg-blue-box" style="height: 377px">
                            <h3 class="text-color" id="d-Marketing">{{ $marketData->title }}</h3>
                            <p class="text-color" id="d-description">{{ $marketData->descriptions }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btnPrimary">Save</button>
                </div>
            </div>
        </form>

    </header>
@endsection
@section('scripts')
    <script>
        // ======================= Live typing text =============================
        $(document).ready(function() {
            $("#live-Marketing").on("input", function() {
                var projectValue = $(this).val();
                $("#d-Marketing").text(projectValue);
            });
            $("#live-Description").on("input", function() {
                var DescriptiontValue = $(this).val();
                $("#d-description").text(DescriptiontValue);
            });
        });
    </script>
@endsection
