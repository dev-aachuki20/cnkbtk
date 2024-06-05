<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function refreshMessages(projectId){
        var url = "{{ route('admin.projects.readChat', ':projectId') }}";
        url = url.replace(':projectId', projectId);
        var isAjax = true;
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                isAjax: isAjax
            },
            dataType: 'json',
            beforeSend: function(response) {   
                showLoader();
            },
            success: function(response) {
                $('#messageBoxBg').html(response.html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {   
                hideLoader();
            }
        });
    }

    // Event listener for refresh button click
    $('#refresh-messages').click(function() {
        var projectId = $(this).data('project-id');
        refreshMessages(projectId);
    });
</script>