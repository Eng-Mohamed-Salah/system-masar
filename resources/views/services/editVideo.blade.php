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
            <h3>Video</h3>
            <a href="/show-video" class="btnGray py-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

        <!-- Video -->
        <form method="POST" action="{{route('update-video',['id'=>$videoData->id])}}" class="content" id="addvideo" enctype="multipart/form-data">
           @csrf
           @method("PUT")
            <div class="modal-body row">

                <div class="col-6 my-3">
                    <div class="input-group pb-2">
                        <input type="text" class="form-control" id="videoInput" placeholder="رابط الفيديو أو اختر ملفًا"
                            name="url" value="{{ $videoData->url }}">
                    </div>
                    <span class="input-group py-2">
                        <input type="file" id="videoFileInput" class="form-control" accept="video/*"
                            placeholder="صورة طويلة" name="video" value="{{ $videoData->video }}">
                    </span>
                    <div class="input-group py-2">
                        <input type="text" id="live-titlevideo" class="form-control" placeholder="Title Video"
                            name="title" value="{{ $videoData->title }}">
                    </div>
                    <div class="input-group pt-2">
                        <textarea class="form-control" id="live-Description" id="" cols="30" rows="10"
                            placeholder="Description" style="height: 215px" name="descriptions">{{ $videoData->descriptions }}</textarea>
                    </div>
                </div>
                <div class="col my-2">
                    <div class="card">
                        <div id="videoContainer"></div>
                        @if ($videoData->video)
                            <video src="{{ asset('service/video/' . $videoData->video) }}" controls id="selectedVideo" style="max-height: 300px"
                                value="@if ($videoData->video) {{ asset('service/video/' . $videoData->video) }} @else{{ $videoData->url }} @endif"></video>
                        @else
                            <iframe controls id="selectedVideo" style="max-height: 300px" src="{{ $videoData->url }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        @endif
                        <span class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 id="d-titlevideo" class="card-title w-50">Title Video</h5>
                            </div>
                            <p id="d-Description" class="card-text">Description</p>
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-between pt-4">
                    {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">delete</button> --}}
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
        </section>
    </header>
@endsection
@section('scripts')
    {{-- Live typeing --}}
    <script>
        $(document).ready(function() {
            $("#live-titlevideo").on("input", function() {
                var videoValue = $(this).val();
                $("#d-titlevideo").text(videoValue);
            });
            $("#live-Description").on("input", function() {
                var descriptioneValue = $(this).val();
                $("#d-Description").text(descriptioneValue);
            });
        });
    </script>

    <script>
        // Read More & Read less
        $(document).ready(function() {
            var maxWords = 14;
            $(".show-read-more").each(function() {
                var text = $(this).text();
                var words = text.split(' ');
                if (words.length > maxWords) {
                    var shortenedText = words.slice(0, maxWords).join(' ');
                    var remainingText = words.slice(maxWords).join(' ');
                    $(this).empty().html(shortenedText + '<span class="more-text">' + remainingText +
                        '</span> <a href="#" class="read-more-link">read more</a>');
                }
            });


            //  Read More
            $(".read-more-link").click(function(e) {
                e.preventDefault();
                var moreText = $(this).prev('.more-text');
                moreText.toggle();
                if (moreText.is(':visible')) {
                    $(this).text('read less');
                } else {
                    $(this).text('read more');
                }
            });
        });
    </script>

    {{-- total Lenght Video --}}
    <script>
        function updateNumberOfCards() {
            var numberOfCards = $('#video .card').length;
            $('#numberOfCards').text(numberOfCards);
        }
        $(document).ready(updateNumberOfCards);
    </script>

    <script>
        $(document).ready(function() {
            // استمع إلى حدث تغيير حقل الإدخال باستخدام jQuery
            $('#videoInput').on('input', function() {
                var inputVal = $('#videoInput').val();
                var isYouTubeLink = isYouTubeURL(inputVal);

                // إذا كان رابطًا لفيديو YouTube
                if (isYouTubeLink) {
                    var videoId = extractVideoId(inputVal);
                    var embeddedYouTubeLink = "https://www.youtube.com/embed/" + videoId;
                    var iframe = $('<iframe>').attr({
                        src: embeddedYouTubeLink,
                        width: 560,
                        height: 315
                    });

                    $('#videoContainer').empty().append(iframe);
                    $('#selectedVideo').hide();
                } else {
                    // إذا كان ملفًا محليًا
                    $('#selectedVideo').show();
                    $('#videoContainer').empty();
                }
            });

            // استمع إلى حدث تغيير الملف باستخدام jQuery
            $('#videoFileInput').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    var videoURL = URL.createObjectURL(selectedFile);
                    var videoElement = $('#selectedVideo');
                    videoElement.attr('src', videoURL);
                    videoElement.show();
                    $('#videoContainer').empty();
                }
            });

            // وظيفة لفحص ما إذا كان الرابط هو رابط YouTube
            function isYouTubeURL(url) {
                var youtubeRegex =
                    /^(https?:\/\/)?(www\.)?(youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)/;
                return youtubeRegex.test(url);
            }

            // وظيفة لاستخراج معرف الفيديو من رابط YouTube
            function extractVideoId(link) {
                var videoIdRegex =
                    /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
                var match = link.match(videoIdRegex);
                return (match && match[1]) ? match[1] : null;
            }

            // وظيفة لتحميل الفيديو عند النقر على زر "حفظ"
            function loadVideo() {
                var inputVal = $('#videoInput').val();
                var isYouTubeLink = isYouTubeURL(inputVal);

                if (isYouTubeLink) {
                    var videoId = extractVideoId(inputVal);
                    var embeddedYouTubeLink = "https://www.youtube.com/embed/" + videoId;
                    var iframe = $('<iframe>').attr({
                        src: embeddedYouTubeLink,
                        width: 560,
                        height: 315
                    });

                    $('#videoContainer').empty().append(iframe);
                    $('#videoTitle').text($('#liveTitle').val());
                    $('#videoDescription').text($('#liveDescription').val());
                    $('#selectedVideo').hide();
                } else {
                    var selectedFile = $('#videoFileInput')[0].files[0];

                    if (selectedFile) {
                        var videoURL = URL.createObjectURL(selectedFile);
                        var videoElement = $('#selectedVideo');
                        videoElement.attr('src', videoURL);
                        videoElement.show();
                        $('#videoContainer').empty();
                    } else {
                        alert("الرجاء إدخال رابط فيديو صحيح من YouTube أو اختيار ملف.");
                    }
                }
            }
        });
    </script>
@endsection
