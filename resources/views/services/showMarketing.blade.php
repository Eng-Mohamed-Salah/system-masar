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
            <h3>Marketing</h3>
            <div class="d-flex">
                <!-- {{-- Add marketing --}} -->
                <button class="btnGray w-100" data-bs-toggle="modal" data-bs-target="#addmarketing">
                    <i class="fa-solid fa-plus"></i>
                    Add Marketing
                </button>
            </div>
        </div>

        <!-- marketing -->
        <section id="marketing" class="content">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <span class=" mt-4">
                        <h5 class="text-color">Total Marketing ( <span id="numberOfCards"></span> )</h5>
                    </span>
                    <div class=" mt-4">
                        <select class="form-select" id="Marketing-type">
                            <option value="all" selected>all</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Digital Print">Digital Print</option>
                            <option value="Affiliate Marketing">Affiliate Marketing</option>
                            <option value="Real Estate Marketing">Real Estate Marketing</option>
                            <option value="Media Production">Media Production</option>
                        </select>
                    </div>
                </div>

                @foreach ($marketData as $market)
                    <div class="row" id="{{ $market->department }}">

                        <!-- Digital Marketing -->
                        <section id="{{ $market->department }}" data-type="{{ $market->department }}">
                            <div class="text-p mt-3" data-aos="fade-up" data-aos-duration="2000">
                                <h6>{{ $market->department }} ( <span id="numberMarketing"></span> )</h6>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="card-features">
                                        <div class="container-card bg-green-box">

                                            <h3 class="card-title">{{ $market->title }}</h3>
                                            <p class="card-description show-read-more">{{ $market->descriptions }}</p>
                                            <div class="d-flex">
                                                <form action="{{route('delete-marketing',['id'=>$market->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mx-2">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('edit-marketing', ['id' => $market->id]) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                @endforeach
            </div>
        </section>


    </header>


    {{-- Popup Window Crate Client --}}
    <form method="POST" action="{{ route('create-marketing') }}" class="modal fade" id="addmarketing">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add marketing</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Upload  --}}
                <div class="modal-body row">
                    <div class="col-12 my-3">
                        <div class="input-group pb-2">
                            <select name="department" class="form-select" id="Marketing-type">
                                <option value="" selected>Select type</option>
                                <option value="Digital Marketing">Digital Marketing</option>
                                <option value="Digital Print">Digital Print</option>
                                <option value="Affiliate Marketing">Affiliate Marketing</option>
                                <option value="Real Estate Marketing">Real Estate Marketing</option>
                                <option value="Media Production">Media Production</option>
                            </select>
                        </div>
                        <div class="input-group py-2">
                            <input type="text" id="live-titlemarketing" class="form-control"
                                placeholder="Title marketing" name="title">
                        </div>
                        <div class="input-group py-2">
                            <textarea class="form-control" id="" cols="30" rows="10" placeholder="Description"
                                name="descriptions"></textarea>
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
@endsection
@section('scripts')
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

    {{-- total Lenght marketing --}}
    <script>
        function updateNumberOfCards() {
            var numberOfCards = $('#marketing .card-features').length;
            $('#numberOfCards').text(numberOfCards);
        }
        $(document).ready(updateNumberOfCards);

        // <!-- Digital Marketing -->
        function updateDigitalMarketing() {
            var numberDigitalMarketing = $('#Digital-Marketing .card-features').length;
            $('#numberMarketing').text(numberDigitalMarketing);
        }
        $(document).ready(updateDigitalMarketing);

        // <!-- Digital Marketing -->
        function updateDigitalPrint() {
            var numberDigitalPrint = $('#Digital-Print .card-features').length;
            $('#numberPrint').text(numberDigitalPrint);
        }
        $(document).ready(updateDigitalPrint);

        // <!-- Digital Marketing -->
        function updateAffiliate() {
            var numberAffiliate = $('#Affiliate .card-features').length;
            $('#numberAffiliate').text(numberAffiliate);
        }
        $(document).ready(updateAffiliate);

        // <!-- Digital Marketing -->
        function updateReal() {
            var numberReal = $('#Real .card-features').length;
            $('#numberReal').text(numberReal);
        }
        $(document).ready(updateReal);

        // <!-- Digital Marketing -->
        function updateMedia() {
            var numberMedia = $('#Media .card-features').length;
            $('#numberMedia').text(numberMedia);
        }
        $(document).ready(updateMedia);
    </script>

    <script>
        $(document).ready(function() {
            // استمع إلى حدث تغيير حقل الإدخال باستخدام jQuery
            $('#marketingInput').on('input', function() {
                var inputVal = $('#marketingInput').val();
                var isYouTubeLink = isYouTubeURL(inputVal);

                // إذا كان رابطًا لفيديو YouTube
                if (isYouTubeLink) {
                    var marketingId = extractmarketingId(inputVal);
                    var embeddedYouTubeLink = "https://www.youtube.com/embed/" + marketingId;
                    var iframe = $('<iframe>').attr({
                        src: embeddedYouTubeLink,
                        width: 560,
                        height: 315
                    });

                    $('#marketingContainer').empty().append(iframe);
                    $('#selectedmarketing').hide();
                } else {
                    // إذا كان ملفًا محليًا
                    $('#selectedmarketing').show();
                    $('#marketingContainer').empty();
                }
            });

            // استمع إلى حدث تغيير الملف باستخدام jQuery
            $('#marketingFileInput').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    var marketingURL = URL.createObjectURL(selectedFile);
                    var marketingElement = $('#selectedmarketing');
                    marketingElement.attr('src', marketingURL);
                    marketingElement.show();
                    $('#marketingContainer').empty();
                }
            });

            // وظيفة لفحص ما إذا كان الرابط هو رابط YouTube
            function isYouTubeURL(url) {
                var youtubeRegex =
                    /^(https?:\/\/)?(www\.)?(youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)/;
                return youtubeRegex.test(url);
            }

            // وظيفة لاستخراج معرف الفيديو من رابط YouTube
            function extractmarketingId(link) {
                var marketingIdRegex =
                    /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
                var match = link.match(marketingIdRegex);
                return (match && match[1]) ? match[1] : null;
            }

            // وظيفة لتحميل الفيديو عند النقر على زر "حفظ"
            function loadmarketing() {
                var inputVal = $('#marketingInput').val();
                var isYouTubeLink = isYouTubeURL(inputVal);

                if (isYouTubeLink) {
                    var marketingId = extractmarketingId(inputVal);
                    var embeddedYouTubeLink = "https://www.youtube.com/embed/" + marketingId;
                    var iframe = $('<iframe>').attr({
                        src: embeddedYouTubeLink,
                        width: 560,
                        height: 315
                    });

                    $('#marketingContainer').empty().append(iframe);
                    $('#marketingTitle').text($('#liveTitle').val());
                    $('#marketingDescription').text($('#liveDescription').val());
                    $('#selectedmarketing').hide();
                } else {
                    var selectedFile = $('#marketingFileInput')[0].files[0];

                    if (selectedFile) {
                        var marketingURL = URL.createObjectURL(selectedFile);
                        var marketingElement = $('#selectedmarketing');
                        marketingElement.attr('src', marketingURL);
                        marketingElement.show();
                        $('#marketingContainer').empty();
                    } else {
                        alert("الرجاء إدخال رابط فيديو صحيح من YouTube أو اختيار ملف.");
                    }
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#Marketing-type").change(function() {
                var selectedType = $(this).val();
                if (selectedType === "all") {
                    $("#Marketing section").show();
                } else {
                    $("#Marketing section").hide();
                    $("#Marketing section[data-type='" + selectedType + "']").show();
                }
            });
            $("#programming-type").change(function() {
                var selectedType = $(this).val();
                if (selectedType === "all") {
                    $("#programming section").show();
                } else {
                    $("#programming section").hide();
                    $("#programming section[data-type='" + selectedType + "']").show();
                }
            });
        });
    </script>
@endsection
