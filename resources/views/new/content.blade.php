@extends('main')

@section('content')
    <div class="container p-t-80">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <h1 style="margin: 16px;">Tin Tức Mới:</h1>
{{--    <div class="col-md-8 col-lg-9 p-b-80">--}}
        <div class="p-r-45 p-r-0-lg">
            <div class="wrap-pic-w how-pos5-parent">
                <img src="{{ asset($news->thumb) }}" alt="IMG-BLOG">

                <div class="flex-col-c-m size-123 bg9 how-pos5">
                <span class="ltext-107 cl2 txt-center">
                    {{ $news->created_at->format('d') }}
                </span>
                    <span class="stext-109 cl3 txt-center">
                   {{ $news->created_at->format('M, Y') }}
                </span>
                </div>
            </div>

            <div class="p-t-32">
            <span class="flex-w flex-m stext-111 cl2 p-b-19">
                <span>
                    <span class="cl4">By</span> {{ $news->author }}
                    <span class="cl12 m-l-4 m-r-6">|</span>
                </span>

                <span>
                    {{ $news->created_at->format('d M, Y') }}
                    <span class="cl12 m-l-4 m-r-6">|</span>
                </span>
            </span>

                <h4 class="ltext-109 cl2 p-b-28">
                    {{ $news->Blog_title }}
                </h4>

                <p class="stext-117 cl6 p-b-26">
                    {{ $news->description }}
                </p>

                <p class="stext-117 cl6 p-b-26">
                    {{!! $news->content !!}}
                </p>
            </div>
            <div class="p-t-40">
                <h5 class="mtext-113 cl2 p-b-12">
                    Shop Hoa
                </h5>

                <p class="stext-107 cl6 p-b-40">
                   * cảm ơn khách hàng đã theo dõi *
                </p>

{{--                <form>--}}
{{--                    <div class="bor19 m-b-20">--}}
{{--                        <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>--}}
{{--                    </div>--}}

{{--                    <div class="bor19 size-218 m-b-20">--}}
{{--                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *">--}}
{{--                    </div>--}}

{{--                    <div class="bor19 size-218 m-b-20">--}}
{{--                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *">--}}
{{--                    </div>--}}

{{--                    <div class="bor19 size-218 m-b-30">--}}
{{--                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="web" placeholder="Website">--}}
{{--                    </div>--}}

{{--                    <button class=" flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04 mt-0" >--}}
{{--                        Post Comment--}}
{{--                    </button>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
    </div>

@endsection
