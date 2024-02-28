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
            <h3>Galary</h3>
            <div class="d-flex">
                <!-- {{-- Add Photo --}} -->
                <button class="btnGray w-100" data-bs-toggle="modal" data-bs-target="#addPhoto">
                    <i class="fa-solid fa-plus"></i>
                    Add Photo
                </button>
            </div>
        </div>

        <!-- photography -->
        <section class="content">
            <div class="d-flex justify-content-between">
                <span class="mx-3 mt-4">
                    <h5 class="text-color">Total Clients ( <span id="numberOfCards"></span> )</h5>
                </span>
            </div>
            <div class="psm-0 card-body">
                <div id="photography">
                    <div id="cardContainer" class="gallary ">
                        @foreach ($galaryData as $galary)
                            @if (isset($galary->img400x400))
                                {{-- Image 400X400 --}}
                                <div class="minImg">
                                    {{-- <form id="updateFormimg400x400" data-id="{{$galary->id}}" data-filename="{{ $galary->img400x400 }}"  action="{{route('update-galary',['id'=>$galary->id,'filename'=>$galary->img400x400])}}" method="POST" >
                                        @csrf
                                        @method('PUT')

                                    <label for="file-upload{{ $galary->img400x400 }}" class="custom-upload-button"><i
                                            class="fas fa-pen"></i></label>
                                    <input type="file" id="file-upload{{ $galary->img400x400 }}"
                                        name="{{ $galary->img400x400 }}" class="file-upload">
                                    <img sr alt="">
                                    </form> --}}
                                    <form id="updateFormimg400x400" data-id="{{ $galary->id }}"
                                        data-filename="{{ $galary->img400x400 }}" class="update-form">
                                        <label for="file-upload{{ $galary->img400x400 }}" class="custom-upload-button"><i
                                                class="fas fa-pen"></i></label>
                                        <input type="file" id="file-upload{{ $galary->img400x400 }}" name="img400x400"
                                            class="file-upload">
                                        <img src="{{ isset($galary->img800x800) ? asset('image/services/' . $galary->img800x800) : '' }}"
                                            alt="" id="imagePreview{{ $galary->id }}">
                                    </form>


                                    <form id="deleteFormimg400x400" data-id="{{ $galary->id }}"
                                        data-filename="{{ $galary->img400x400 }}"
                                        action="{{ route('delete-galary', ['id' => $galary->id, 'filename' => $galary->img400x400]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="delete-button"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <a class="view"
                                        href="{{ isset($galary->img400x400) ? asset('image/services/' . $galary->img400x400) : '' }}"
                                        data-fancybox="gallery"><i class="fa-solid fa-expand fa-xl"></i></a>
                                    <img src="{{ isset($galary->img400x400) ? asset('image/services/' . $galary->img400x400) : '' }}"
                                        alt="8.1">
                                </div>
                            @endif

                            @if (isset($galary->img800x800))
                                {{-- Image 800X800 --}}
                                <div class="big minImg">
                                    {{-- <label for="file-upload{{ $galary->img800x800 }}" class="custom-upload-button"><i
                                            class="fas fa-pen"></i></label>
                                    <input type="file" id="file-upload{{ $galary->img800x800 }}"
                                        name="{{ $galary->img800x800 }}" class="file-upload">
                                    <img src="{{ isset($galary->img800x800) ? asset('image/services/' . $galary->img800x800) : '' }}"
                                        alt="10"> --}}
                                    <form id="updateFormimg800x800" data-id="{{ $galary->id }}"
                                        data-filename="{{ $galary->img800x800 }}" class="update-form">
                                        <label for="file-upload{{ $galary->img800x800 }}" class="custom-upload-button"><i
                                                class="fas fa-pen"></i></label>
                                        <input type="file" id="file-upload800x800" name="img800x800" class="file-upload">
                                        <img src="{{ isset($galary->img800x800) ? asset('image/services/' . $galary->img800x800) : '' }}"
                                            alt="" id="imagePreview{{ $galary->id }}">
                                    </form>
                                    <form id="deleteFormimg800x800" data-id="{{ $galary->id }}"
                                        data-filename="{{ $galary->img800x800 }}"
                                        action="{{ route('delete-galary', ['id' => $galary->id, 'filename' => $galary->img800x800]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="delete-button"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <a class="view"
                                        href="{{ isset($galary->img800x800) ? asset('image/services/' . $galary->img800x800) : '' }}"
                                        data-fancybox="gallery"><i class="fa-solid fa-expand fa-xl"></i></a>
                                </div>
                            @endif

                            @if (isset($galary->img400x800))
                                {{-- Image 400X800 --}}
                                <div class="vertical minImg">
                                    <label for="file-upload{{ $galary->img400x800 }}" class="custom-upload-button"><i
                                            class="fas fa-pen"></i></label>
                                    <input type="file" id="file-upload{{ $galary->img400x800 }}"
                                        name="{{ $galary->img400x800 }}" class="file-upload">
                                    <img src="{{ isset($galary->img400x800) ? asset('image/services/' . $galary->img400x800) : '' }}"
                                        alt="11">
                                    <form id="deleteFormimg400x800" data-id="{{ $galary->id }}"
                                        data-filename="{{ $galary->img400x800 }}"
                                        action="{{ route('delete-galary', ['id' => $galary->id, 'filename' => $galary->img400x800]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="delete-button"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <a class="view"
                                        href="{{ isset($galary->img400x800) ? asset('image/services/' . $galary->img400x800) : '' }}"
                                        data-fancybox="gallery"><i class="fa-solid fa-expand fa-xl"></i></a>
                                </div>
                            @endif
                            @if (isset($galary->img800x400))
                                {{-- Image 800X400 --}}
                                <div class="horizontal minImg">
                                    <label for="file-upload{{ $galary->img800x400 }}" class="custom-upload-button"><i
                                            class="fas fa-pen"></i></label>
                                    <input type="file" id="file-upload{{ $galary->img800x400 }}"
                                        name="{{ $galary->img800x400 }}" class="file-upload">
                                    <img src="{{ isset($galary->img800x400) ? asset('image/services/' . $galary->img800x400) : '' }}"
                                        alt="11">
                                    <form id="deleteFormimgimg800x400" data-id="{{ $galary->id }}"
                                        data-filename="{{ $galary->img800x400 }}"
                                        action="{{ route('delete-galary', ['id' => $galary->id, 'filename' => $galary->img800x400]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="delete-button"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                    <a class="view"
                                        href="{{ isset($galary->img800x400) ? asset('image/services/' . $galary->img800x400) : '' }}"
                                        data-fancybox="gallery"><i class="fa-solid fa-expand fa-xl"></i></a>
                                </div>
                            @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
    </header>


    {{-- Popup Window Crate Client --}}
    <form action="{{ route('create-galary') }}" method="POST" class="modal fade" id="addPhoto"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog" style="max-width: 900px">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Photo</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- Upload  --}}
                <div class="gallary ">
                    <span class="vertical minImg">
                        <label for="file-upload16" class="custom-upload-button"><i class="fas fa-pen"></i></label>
                        <input type="file" id="file-upload16" name="img400x800" class="file-upload">
                        <img src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg"
                            alt="2">
                        <div class="delete-button"><i class="fas fa-trash"></i></div>
                    </span>
                    <span class="horizontal minImg">
                        <label for="file-upload17" class="custom-upload-button"><i class="fas fa-pen"></i></label>
                        <input type="file" id="file-upload17" name="img800x400" class="file-upload">
                        <img src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg"
                            alt="3">
                        <div class="delete-button"><i class="fas fa-trash"></i></div>
                    </span>
                    <span class="big minImg">
                        <label for="file-upload18" class="custom-upload-button"><i class="fas fa-pen"></i></label>
                        <input type="file" id="file-upload18" name="img800x800" class="file-upload">
                        <img src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg"
                            alt="4">
                        <div class="delete-button"><i class="fas fa-trash"></i></div>
                    </span>
                    <span class="minImg">
                        <label for="file-upload19" class="custom-upload-button"><i class="fas fa-pen"></i></label>
                        <input type="file" id="file-upload19" name="img400x400" class="file-upload">
                        <img src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg"
                            alt="8">
                        <div class="delete-button"><i class="fas fa-trash"></i></div>
                    </span>
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
        // ============================== upload images2 ==============================
        $(document).ready(function() {
            $('#addPhoto .file-upload').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                var minImg = $(this).closest('#addPhoto .minImg');

                reader.onload = function() {
                    var img = minImg.find('img');
                    img.attr('src', reader.result);
                    img.css('display', 'block');
                    minImg.find('#addPhoto .delete-button').css('display', 'flex');
                };

                reader.readAsDataURL(file);
            });

            $('#addPhoto .delete-button').click(function() {
                var minImg = $(this).closest('.minImg');
                var img = minImg.find('img');
                img.attr('src', '');
                img.css('display', 'none');
                var input = minImg.find('#addPhoto .file-upload');
                input.val('');
                $(this).css('display', 'none');
            });
        });
    </script>
    <script>
        // ============================== upload images2 ==============================
        $(document).ready(function() {
            $('#photography .file-upload').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                var minImg = $(this).closest('#photography .minImg');

                reader.onload = function() {
                    var img = minImg.find('img');
                    img.attr('src', reader.result);
                    img.css('display', 'block');
                    minImg.find('#photography .delete-button').css('display', 'flex');
                };

                reader.readAsDataURL(file);
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
            var numberOfCards = $('#cardContainer .minImg').length;
            $('#numberOfCards').text(numberOfCards);
        }
        $(document).ready(updateNumberOfCards);
    </script>

    <script>
        $(document).ready(function() {
            $('.file-upload').on('change', function() {
                var form = $(this).closest('.update-form');
                var id = form.data('id');
                var filename = form.data('filename');
                var formData = new FormData(form[0]);

                // الحصول على قيمة الـ CSRF token
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/update-galary/' + id + '/' + filename,
                    type: 'PUT',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // تعيين قيمة الـ CSRF token
                    },
                    success: function(response) {
                        // قم بإجراء أي شيء بعد التحديث بنجاح
                        console.log(response);
                        // يمكنك إعادة تحميل الصفحة أو تحديث العرض بشكل ديناميكي هنا
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
