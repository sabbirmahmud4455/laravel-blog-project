
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

//toaster alert options
function toastr_option(){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn"
      }
}


//show category  
function all_category() {
    $.ajax({
        type: "GET",
        url: "/category/create",
        dataType: "json",
        success: function (response) {

            var data = "";

            var sl = 1;
            $.each(response, function (k, v) {

                data = data + "<tr>"


                data = data + "<th scope='row'>" + (sl++) + "</th>"
                data = data + "<td>" + v.name + "</td>"
                data = data + "<td>" + v.slag + "</td>"
                data = data + "<td>" + v.description + "</td>"

                data = data + "<td class='d-flex'>"

                data = data + "<span>"
                data = data + "<button class='btn btn-link' onclick='edit_Cat_data(" + v.id + ")' data-toggle='modal' data-target='#edit_category_form_model'>"
                data = data + "<i class='fas fa-pencil-alt text-info' aria-hidden='true'></i>"
                data = data + "</button>"
                data = data + "</span>"


                data = data + "<span>"
                data = data + "<button class='btn btn-link' onclick='delete_cat_data(" + v.id + ")'>"
                data = data + "<i class='fa fa-trash text-danger' aria-hidden='true'></i>"
                data = data + "</button>"
                data = data + "</span>"

                data = data + "</td>"


                data = data + "</tr>"

            });

            $("#catagory_list_tbody").html(data);

        },

        error: function (error) {
            console.log(error);
        }


    });
}
all_category();





//creat category
$('#add_categorys_form').submit(function (e) {
    e.preventDefault();


    var form_data = {
        'name': $('#add_categorys_form #catagory_name').val(),
        'slag': $('#add_categorys_form #catagory_slag').val(),
        'description': $('#add_categorys_form  #catagory_description').val(),
    };

    $.ajax({
        type: "post",
        url: "category",
        data: form_data,
        dataType: "json",
        success: function (response) {

            $('#add_categorys_form #catagory_name').val('');
            $('#add_categorys_form #catagory_slag').val('');
            $('#add_categorys_form  #catagory_description').val('');

            toastr["success"]("Category Added Successfully");
            toastr_option();
            

            all_category();
        },
        error: function (error) {
            
            if (error.responseJSON.errors.name) {
                toastr["error"](error.responseJSON.errors.name);
            toastr_option();
            };
            if (error.responseJSON.errors.slag) {
                toastr["error"](error.responseJSON.errors.slag);
            toastr_option();
            }
        }
    });
});

//edit 
function edit_Cat_data(id){
    $.ajax({
        type: "GET",
        url: "category/"+id+"/edit",
        dataType: "json",
        success: function (response) {
            $('#edit_categorys_form #catagory_id').val(response.id);
            $('#edit_categorys_form #catagory_name').val(response.name);
            $('#edit_categorys_form #catagory_slag').val(response.slag);
            $('#edit_categorys_form  #catagory_description').val(response.description);
        }
    });
}

//update
$('#edit_categorys_form').submit(function (e) { 
    e.preventDefault();
    var id= $('#edit_categorys_form #catagory_id').val();
    var form_data={
        'name': $('#edit_categorys_form #catagory_name').val(),
        'slag': $('#edit_categorys_form #catagory_slag').val(),
        'description': $('#edit_categorys_form #catagory_description').val(),
    };
    $.ajax({
        type: "PUT",
        url: "category/"+id,
        data: form_data,
        dataType: "json",
        success: function (response) {
            $('#edit_categorys_form #catagory_name').val('');
            $('#edit_categorys_form #catagory_slag').val('');
            $('#edit_categorys_form  #catagory_description').val('');

            toastr["success"]("Category Update Successfully");
            toastr_option();

            all_category();
        },
        error: function (error) {
            
            if (error.responseJSON.errors.name) {
                toastr["error"](error.responseJSON.errors.name);
            toastr_option();
            };
            if (error.responseJSON.errors.slag) {
                toastr["error"](error.responseJSON.errors.slag);
            toastr_option();
            }
        }
    });

    
});

//deleteData
function delete_cat_data(id){
    $.ajax({
        type: "DELETE",
        url: "category/"+id,
        dataType: "json",
        success: function (response) {
            toastr["success"]("Category Delete Successfully");
            toastr_option();

            all_category();
        },
        error: function (error) {
            console.log(error);
        }
    });
}