<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <title>Zone01-Transport</title>
</head>

<body>
    @include('index/navbar')
    <div class="routes">
        @foreach ($routes as $route)
            <div class="route" data-route-id="{{ $route->id }}" data-toggle="modal" data-target="#passengerModal"
                data-passengers='@json($route->passengers)'>
                <div class="time">{{ $route->time }}</div>
                <div class="path">
                    <span class="start">{{ $route->start }}</span>
                    {{-- <span class="left-line"></span> --}}
                    <div class="bus-path">
                        <span class="bus-icon"><i class="fa-solid fa-van-shuttle"></i></span>
                        <span class="bus-line"></span>
                    </div>
                    <span class="end">{{ $route->end }}</span>
                </div>
                <div class="slots">
                    <span class="slots-nb">{{ $route->slots_left }}</span>
                    slot left
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="passengerModal" tabindex="-1" role="dialog" aria-labelledby="passengerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passengerModalLabel">Passengers List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="passengerList">
                            <!-- Passengers will be appended here -->
                        </tbody>
                    </table>
                    <form id="addPassengerForm">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                id="passengerLabel" name="label" required>
                            <button type="submit" class="btn btn-outline-primary">Add Passenger</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        var currentRouteId;

        $('#passengerModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var passengers = button.data('passengers');
            currentRouteId = button.data('route-id');
            var slotsLeft = button.find('.slots-nb').text().trim();
            var modal = $(this);
            var list = modal.find('#passengerList');
            list.empty();
            passengers.forEach(function(passenger, index) {
                var label = passenger.label;
                var displayLabel = label === "staff" ? "Reserved by the staff" : label;
                var rowClass = label === "staff" ? "table-warning" : "";
                list.append('<tr class="' + rowClass + '"><td>#' + (index + 1) + '</td><td>' +
                    displayLabel + '</td></tr>');
            });

            if (parseInt(slotsLeft) === 0) {
                $('#addPassengerForm').hide();
            } else {
                $('#addPassengerForm').show();
            }
        });

        $('#addPassengerForm').on('submit', function(event) {
            event.preventDefault();
            var label = $('#passengerLabel').val();
            $.ajax({
                url: '/routes/' + currentRouteId + '/passengers',
                method: 'POST',
                data: {
                    label: label,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message);
                    location.reload(); // Reload the page upon success
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        for (var error in errors) {
                            errorMessage += errors[error] + ' ';
                        }
                        toastr.error(errorMessage);
                    } else if (xhr.status === 404) {
                        toastr.error(`'${label}' doesn't exist !`);

                    } else {
                        toastr.error('Error adding passenger: ' + xhr.responseJSON.error);
                    }
                }
            });
        });
    </script>
</body>

</html>
