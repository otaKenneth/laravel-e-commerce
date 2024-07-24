@foreach ($trusted_by_list as $trusted_by)
    <div>
        <a href="#" class="delete-trusted-by" data-id="{{$trusted_by->id}}">
            <span>DELETE</span>
            <img class="trusted_logo" src="{{ $getImage('front/images/trusted_by/', $trusted_by->image) }}">
        </a>
    </div>
@endforeach

<script>
    $(document).ready(() => {
        $('a.delete-trusted-by').on('click', function(event) {
            event.preventDefault(); // Prevent the default action of the anchor tag

            // Get the ID from the data attribute
            var id = $(this).data('id');
            var url = '/admin/platform-management/trusted_by/' + id;

            // Confirm the action with the user
            if (confirm('Are you sure you want to delete this item?')) {
                // Send the DELETE request via AJAX
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
                    },
                    success: function(resp) {
                        if (resp && resp.success) {
                            $('.trusted_by_list_of_images').html(resp.view);
                            $('.trusted_by_images .alert.alert-success .alert-message').html(resp.message);
                            $('.trusted_by_images .alert.alert-success').toggleClass('d-none');
                            setTimeout(() => {
                                $('.trusted_by_images .alert.alert-success').toggleClass('d-none');
                            }, 1500);
                        } else {
                            $('.trusted_by_images .alert.alert-danger .alert-message').html(resp.message);
                            $('.trusted_by_images .alert.alert-danger').toggleClass('d-none');
                            setTimeout(() => {
                                $('.trusted_by_images .alert.alert-danger').toggleClass('d-none');
                            }, 1500);
                        }
                    }
                });
            }
        });
    })
</script>