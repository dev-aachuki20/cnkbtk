<script>
    $(document).ready(function() {
        $(document).on("click", "#addBidBtn", function(e) {
            var projectId = $(this).data('project-id');
            var userId = $(this).data('user-id');
            var creatorId = $(this).data('creator-id');
            var bid = $(this).data('bid');

            $('#project_id').val(projectId);
            $('#user_id').val(userId);
            $('#auth_id').val(creatorId);
            if (bid != 0) {
                $('#budget').val(bid);
            } else {
                $('#budget').val(null);
            }

            $('#addBidModal').modal('show');
        });

        // add bid
        $(document).on("submit", "#addBidForm", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var project_id = $('#project_id').val();
            var auth_id = $('#auth_id').val();
            var user_id = $('#user_id').val();

            formData.append("auth_id", auth_id);
            formData.append("project_id", project_id);
            formData.append("user_id", user_id);

            var url = $(this).attr('action');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(response) {
                    showLoader();
                    $(".text-danger.errors").remove();
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                },
                error: function(response) {
                    if (response.responseJSON.errors && response.responseJSON.errors
                        .budget) {
                        var errorMessage = response.responseJSON.errors.budget[0];
                        $('#budget').after(
                            '<div id="budget-error" class="text-danger mt-2">' +
                            errorMessage + '</div>');
                    } else {
                        // toastr.error(jqXHR.responseJSON.message, '{{ trans('global.alert.error') }}');
                        // location.reload();
                        var errorMessage = response.responseJSON.message ||
                            'An error occurred. Please try again.';
                        $('#budget').after(
                            '<div id="budget-error" class="text-danger mt-2">' +
                            errorMessage + '</div>');
                    }
                },
                complete: function() {
                    hideLoader();
                }
            });
        });

        // Reset form values when the modal is hidden
        $('#addBidModal').on('hidden.bs.modal', function() {
            $('#addBidForm')[0].reset();
            $('#budget-error').remove();
        });

        // confirm project by creator
        $(document).on("click", "#confirm", function(e) {
            e.preventDefault();

            var projectId = $(this).data('project-id');
            var userId = $(this).data('user-id');
            var creatorId = $(this).data('creator-id');

            var url = "{{ route('user.creator.project.confirm') }}";

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content')
                },
                type: 'GET',
                url: url,
                data: {
                    projectId: projectId,
                    userId: userId,
                    creatorId: creatorId,
                },
                beforeSend: function(response) {
                    showLoader();
                    $(".text-danger.errors").remove();
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function(){
                        location.reload();
                    },2000);
                },
                error: function(xhr, creatorStatus, error) {
                    toastr.error("Error occurred while confirming project: " + error);
                },
                complete: function() {
                    hideLoader();
                }
            });
        });
    });

    // <!-- Description More and less content js -->
    class ReadMoreToggle {
        constructor(container) {
            this.content = container.querySelector('.content');
            this.button = container.querySelector('.read-more-btn');
            this.button.addEventListener('click', () => this.toggleReadMore());
        }

        toggleReadMore() {
            if (this.content.classList.contains('show-more')) {
                this.content.classList.remove('show-more');
                this.button.innerText = 'Read More';
            } else {
                this.content.classList.add('show-more');
                this.button.innerText = 'Read Less';
            }
        }
    }

    // Initialize the ReadMoreToggle class for all description content sections
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.main-title.description-content').forEach(container => {
            new ReadMoreToggle(container);
        });
    });
</script>
