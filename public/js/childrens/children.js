$(document).ready(function(){
    $("#exampleModalCenter").on("hidden.bs.modal", function () {
        let form = document.getElementById('addUpdateChildrenForm');
        
        form.querySelectorAll('input').forEach(el => {
            el.value = '';
        });
    });

    $(document).on('click', '#addUpdateChildrenBtn', function(e) {               
        e.preventDefault();

        let form = document.getElementById('addUpdateChildrenForm');
        let formData = new FormData(form);
        var url = $('#addUpdateChildrenForm').data('url');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#exampleModalCenter').modal('hide');
                $('#children_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.edit-children', function(){
        var childrenEditUrl = $(this).data('url');
        
        $.ajax({
            url: childrenEditUrl,
            type: "GET",
            success: function(response) {
                $('#addUpdateChildrenFormModal').html(response.data);
                let modal = new bootstrap.Modal('#exampleModalCenter');
                modal.show();
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.add-children', function(e){
        e.preventDefault();
        var childrenAddUrl = $(this).data('url');
        
        $.ajax({
            url: childrenAddUrl,
            type: "GET",
            success: function(response) {
                $('#addUpdateChildrenFormModal').html(response.data);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.delete-children', function(){
        var childrenDeleteUrl = $(this).data('url');

        $.ajax({
            url: childrenDeleteUrl,
            data: {
                "_token": csrfToken
            },
            type: "DELETE",
            success: function(response) {
                $('#children_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });
});