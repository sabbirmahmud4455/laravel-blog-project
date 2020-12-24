
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




//===================== START CATEGORY ======================


//show category  
function all_category() {
    $.ajax({
        type: "GET",
        url: "/dashboard/category/create",
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
        url: "/dashboard/category",
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
        url: "/dashboard/category/"+id+"/edit",
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
        url: "/dashboard/category/"+id,
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
        url: "/dashboard/category/"+id,
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


//===================== END CATEGORY ======================



//===================== START TAG ======================

//all tag
function all_tag() {
    $.ajax({
        type: "GET",
        url: "/dashboard/tag/create",
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
                data = data + "<button class='btn btn-link' onclick='edit_tag_data(" + v.id + ")' data-toggle='modal' data-target='#edit_tag_form_model'>"
                data = data + "<i class='fas fa-pencil-alt text-info' aria-hidden='true'></i>"
                data = data + "</button>"
                data = data + "</span>"


                data = data + "<span>"
                data = data + "<button class='btn btn-link' onclick='delete_tag_data(" + v.id + ")'>"
                data = data + "<i class='fa fa-trash text-danger' aria-hidden='true'></i>"
                data = data + "</button>"
                data = data + "</span>"

                data = data + "</td>"


                data = data + "</tr>"

            });

            $("#tag_list_tbody").html(data);

        },

        error: function (error) {
            console.log(error);
        }


    });
}
all_tag();




//creat tag
$('#add_tags_form').submit(function (e) {
    e.preventDefault();


    var form_data = {
        'name': $('#add_tags_form #tag_name').val(),
        'slag': $('#add_tags_form #tag_slag').val(),
        'description': $('#add_tags_form  #tag_description').val()
    };
    $.ajax({
        type: "POST",
        url: "/dashboard/tag",
        data: form_data,
        dataType: "json",
        success: function (response) {

            $('#add_tags_form #tag_name').val('');
            $('#add_tags_form #tag_slag').val('');
            $('#add_tags_form  #tag_description').val('');

            toastr["success"]("Tag Added Successfully");
            toastr_option();
            

            all_tag();
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
function edit_tag_data(id){
    $.ajax({
        type: "GET",
        url: "/dashboard/tag/"+id+"/edit",
        dataType: "json",
        success: function (response) {
            $('#edit_tags_form #tag_id').val(response.id);
            $('#edit_tags_form #tag_name').val(response.name);
            $('#edit_tags_form #tag_slag').val(response.slag);
            $('#edit_tags_form  #tag_description').val(response.description);
        }
    });
}


//update
$('#edit_tags_form').submit(function (e) { 
    e.preventDefault();
    var id= $('#edit_tags_form #tag_id').val();
    var form_data={
        'name': $('#edit_tags_form #tag_name').val(),
        'slag': $('#edit_tags_form #tag_slag').val(),
        'description': $('#edit_tags_form #tag_description').val(),
    };
    $.ajax({
        type: "PUT",
        url: "/dashboard/tag/"+id,
        data: form_data,
        dataType: "json",
        success: function (response) {
            $('#edit_tags_form #tag_name').val('');
            $('#edit_tags_form #tag_slag').val('');
            $('#edit_tags_form  #tag_description').val('');

            toastr["success"]("Tag Update Successfully");
            toastr_option();

            all_tag();
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

//delete
function delete_tag_data(id){
    $.ajax({
        type: "DELETE",
        url: "/dashboard/tag/"+id,
        dataType: "json",
        success: function (response) {
            toastr["success"]("Tag Delete Successfully");
            toastr_option();

            all_tag();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//===================== END TAG ======================