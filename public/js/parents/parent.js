$(document).ready(function(){
    $("#exampleModalCenter").on("hidden.bs.modal", function () {
        let form = document.getElementById('addUpdateParentForm');
        
        form.querySelectorAll('input').forEach(el => {
            el.value = '';
        });
    });

    $(document).on('click', '#addUpdateParentBtn', function(e) {               
        e.preventDefault();

        let form = document.getElementById('addUpdateParentForm');
        let formData = new FormData(form);
        var url = $('#addUpdateParentForm').data('url');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#exampleModalCenter').modal('hide');
                $('#parent_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.edit-parent', function(){
        var parentEditUrl = $(this).data('url');
        
        $.ajax({
            url: parentEditUrl,
            type: "GET",
            success: function(response) {
                $('#addUpdateParentFormModal').html(response.data);
                let modal = new bootstrap.Modal('#exampleModalCenter');
                modal.show();
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.add-parent', function(e){
        e.preventDefault();
        var parentAddUrl = $(this).data('url');
        
        $.ajax({
            url: parentAddUrl,
            type: "GET",
            success: function(response) {
                $('#addUpdateParentFormModal').html(response.data);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.delete-parent', function(){
        var parentDeleteUrl = $(this).data('url');

        $.ajax({
            url: parentDeleteUrl,
            data: {
                "_token": csrfToken
            },
            type: "DELETE",
            success: function(response) {
                $('#parent_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });
});