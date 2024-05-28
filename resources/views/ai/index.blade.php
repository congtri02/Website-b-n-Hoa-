<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body> <!--class="animsition" -->

<!-- Header -->
@include('header')

<div class="container" style="margin-top: 100px; padding: 50px; margin-bottom: 100px;">
    <h1 style="text-align: left; font-size: 30px; margin-bottom: 20px;">Tìm Kiếm</h1>
    <form id="uploadForm" enctype="multipart/form-data" style="text-align: center;">
        <div class="upload-container" style="display: flex; justify-content: flex-start; align-items: center; margin-bottom: 20px;">
            <label for="fileInput" class="upload-label" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 5px;"> Tải Ảnh  </label>
            <input type="file" name="file" id="fileInput" style="display: none;">
            <button type="submit" class="upload-button" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Tìm kiếm</button>
        </div>

        <div class="image-container" style="text-align: center; margin-top: 20px;">
            <img id="selectedImage" src="#" alt="Selected Image" class="selected-image" style="display: none; max-width: 100%;block-size: 80px;padding-left: 5px;">
        </div>
    </form>
    <div id="predictionResult" style="text-align: center; margin-top: 20px;"></div>
    <div class="search-1"></div>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        var selectedFile = this.files[0];
        var reader = new FileReader();

        reader.onload = function(event) {
            document.getElementById('selectedImage').src = event.target.result;
            document.getElementById('selectedImage').style.display = 'block';
        };

        reader.readAsDataURL(selectedFile);
    });
</script>
<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('user.sendAi') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result);

                    $('#predictionResult').html('<p>' + result.predicted_class + '</p>');
                    searchProducts(result.predicted_class);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        function searchProducts(predictedClass) {
            $.ajax({
                url: "{{ route('search.products') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { predicted_class: predictedClass },
                success: function(response) {
                    var products = response.products;
                    var grid = $('.search-1');
                    grid.empty();
                    products.forEach(function(product) {
                        var productHTML = '<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">';
                        productHTML += '<div class="block2">';
                        productHTML += '<div class="block2-pic hov-img0">';
                        productHTML += '<a href="{{ route('product.shop', ['id' => ':id', 'slug' => ':slug']) }}'.replace(':id', product.id).replace(':slug', product.slug) + '" class="block2-pic hov-img0">';
                        productHTML += '<img src="' + "{{ asset('') }}" + product.thumb + '" alt="' + product.name + '">';
                        productHTML += '</a>';
                        productHTML += '</div>';
                        productHTML += '<div class="block2-txt flex-w flex-t p-t-14">';
                        productHTML += '<div class="block2-txt-child1 flex-col-l">';
                        productHTML += '<a href="{{ route('product.shop', ['id' => ':id', 'slug' => ':slug']) }}'.replace(':id', product.id).replace(':slug', product.slug) + '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">';
                        productHTML += product.name;
                        productHTML += '</a>';
                        productHTML += '<span class="stext-105 cl3">';
                        productHTML += product.price_sale;
                        productHTML += '</span>';
                        productHTML += '</div>';
                        productHTML += '</div>';
                        productHTML += '</div>';
                        productHTML += '</div>';

                        grid.append(productHTML);
                    });

                    if (products.length === 0) {
                        $('#predictionResult').html('<p>No related products found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
@include('footer')
</html>
