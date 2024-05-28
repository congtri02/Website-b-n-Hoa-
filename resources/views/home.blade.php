@extends('main')

@section('content')
<!-- Slider -->
<section class="section-slide">

    <div class="wrap-slick1">
        <div class="slick1">
            @foreach($sliders as $slider)
            <div class="item-slick1" style="background-image: url({{ asset($slider->thumb) }});">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl0 respon2">
									SHOP HOA
								</span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-201 cl0 p-t-19 p-b-43 respon1">
                                {{ $slider->name }}
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="{{ $slider->url }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @foreach($news as $new)
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset($new->thumb) }}" alt="IMG-BANNER">
{{--tin-tuc/{{ $new->id }}-{{ \Str::slug($new->Blog_title, '-') }}.html--}}
                    <a href="{{route('new.shop', ['id' => $new->id, 'slug' => \Str::slug($new->Blog_title, '-')])}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$new->Blog_title}}
								</span>

                            <span class="block1-info stext-102 trans-04">
									Tin Tức
								</span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                {{$new->created_at}}
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10 ">
            <h3 style="font-weight: normal; font-size: 36px; line-height: 1.1; text-transform: uppercase;" class="cl5 ">
                Sản Phẩm
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Filter
                </div>

{{--                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4">--}}
{{--                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>--}}
{{--                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>--}}
{{--                    <button class=' cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search' >--}}
{{--                        <a href="{{route('ai.shop')}}" class="nav-link"></a>tìm kiếm </button>--}}

{{--                </div>--}}
                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4">
                    <a href="{{route('ai.shop')}}" class="nav-link">
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        <button class="cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search">Tìm kiếm</button>
                    </a>
                </div>
            </div>

            <!-- Search product -->
{{--            <div class="dis-none panel-search w-full p-t-10 p-b-15">--}}
{{--                <div class="bor8 dis-flex p-l-15">--}}
{{--                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">--}}
{{--                        <i class="zmdi zmdi-search"></i>--}}
{{--                    </button>--}}

{{--                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Sort By
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04">
                                    Default
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04">
                                    Price: Low to High
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04">
                                    Price: High to Low
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Price
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                    All
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04">
                                    0 VND - 50000 VND
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link stext-106 trans-04">
                                    50000 VND - 200000 VND
                                </a>
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
    </div>

        <div id="loadProduct" >
            @include('products.list')
        </div>

        <div class="flex-c-m flex-w w-full p-t-45" id="button-loadMore">
            <input type="hidden" value="1" id="page">
            <a onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>
    </div>
</section>

<!--===============================================================================================-->
<script>
    var uploadMore = '{{route('services.load-product')}}';

    function loadMore()
{
    const page = $('#page').val();
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : { page, "_token": "{{ csrf_token() }}" },
        url : uploadMore,
        success : function (result) {
            if (result.html !== '') {
                $('#loadProduct').append(result.html);
                $('#page').val(page + 1);
            } else {
                alert('Đã load xong Sản Phẩm');
                $('#button-loadMore').css('display', 'none');
            }
        }
    })
}

</script>
@endsection

