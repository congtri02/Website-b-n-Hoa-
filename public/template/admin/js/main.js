$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url)
{
	if (confirm('Xóa mà không thể khôi phục. Bạn có chắc?')) {

        // alert( url);
		$.ajax({
			method: "POST",
			datatype: 'JSON',
			data: {id},
			url: url,
			success: function(result){
				if (result.error == false)
				{
					location.reload();
				}else{
					alert('Xóa lỗi vui lòng thử lại');
				}
			}
		})
	}
}

// var imgInp = document.getElementById("upload");
// var blah = document.getElementById("blah");
// var test = document.getElementById("test");

// imgInp.onchange = evt => {
//     const [thumb] = imgInp.files
//     if (thumb) {
//         blah.src = URL.createObjectURL(thumb);
//         test.href = URL.createObjectURL(thumb);
//     }
// }

//$('#upload').change(function () {
    // const form = new FormData();
    // form.append('file', $(this)[0].files[0]);
    //
    // console.log("1: ",$(this)[0].files[0].name);
    // $('#image-show').html('<a href="' + $(this)[0].files[0].name + '" target="_blank">' +
    //              '<img src="' + $(this)[0].files[0].name + '" width="100px"></a>');


    // $.ajax({
    //     processData: false,
    //     contentType: false,
    //     type: 'POST',
    //     dataType: 'JSON',
    //     data: form,
    //     url: uploadRoute,
    //     success: function (results){
    //         //console.log("results",results);
    //         if (results.error === false){
    //          $('#image-show').html('<a href="' + results.url + '" target="_blank">' +
    //              '<img src="' + results.url + '" width="100px"></a>');
    //             $('#file').val(results.url);
    //         }else {
    //             alert('Upload File Lỗi');
    //         }
    //     }
    // });
//});
//var currentUrl = window.location.href;
    // var imgInp = document.getElementById("upload");
    // var blah = document.getElementById("blah");
    // var test = document.getElementById("test");

    // const [thumb] = imgInp.files
    // if (thumb) {
    //     blah.src = URL.createObjectURL(thumb);
    //     test.href = URL.createObjectURL(thumb);
    // }

$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);
    //console.log(currentUrl)
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: uploadRoute,
        success: function (results) {
            if (results.error === false) {
                $('#image_show').html('<a href="' +  results.url + '" target="_blank">' +
                    '<img src="' +  results.url + '" width="100px"></a>');

                $('#thumb').val(results.url);
            } else {
                alert('Upload File Lỗi');
            }
        }
    });
});
