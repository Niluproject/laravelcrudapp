<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel 8 CRUD Tutorial From Scratch</title>
    <link rel="shortcut icon" href="./Companies/img.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            background-color: #C2CAD0;
        }
    </style>
</head>

<body>

    <div class="container mt-2" id='body'>

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 8 CRUD Example Tutorial</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('companies.create') }}"> Create Company</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>S.No</th>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Address</th>
                <th>Image</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->address }}</td>
                    <td> <img src="/image/{{ $company->image }}" width="100px"></td>
                    <td>
                        {{-- <form action="{{ route('companies.destroy',$company->id) }}" id="delete" method="Post"> --}}

                        <a class="btn btn-primary" href="{{ route('companies.edit', $company->id) }}">Edit</a>

                        {{-- @csrf
                    @method('DELETE') --}}

                        <button type="submit" class="btn btn-danger delete" id="{{ $company->id }}">Delete</button>
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $companies->links() !!}
        <footer class="page-footer font-small blue">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2022 Copyright:
                <a href="https://covrize.com/"> CovRize.com</a>
            </div>
            <!-- Copyright -->

        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

        <script>
            function loadlink() {
                currLoc = $(location).attr("href");
                $("#body").load(currLoc, function() {
                    $(this).unwrap();
                });
            }
            $('.delete').on('click', function(e) {
                // var form =  this.closest("form");
                // var form = $(this).parents('form');
                var id = $(this).attr('id');
                //alert(id);
                e.preventDefault();
                swal({
                        title: `Are you sure you want to delete this record?`,
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ url('companies') }}" + '/' + id,
                                type: "POST",
                                data: {
                                    '_method': 'DELETE',
                                    '_token': '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    swal(
                                        "Deleted!",
                                        "Your record has been deleted.",
                                        "success"
                                    ).then(() => {
                                        loadlink();
                                    });
                                },
                                // error: function() {
                                //     swal({
                                //         title: 'Opps...',
                                //         //text : data.message,
                                //         type: 'error',
                                //         timer: '1500'
                                //     })
                                // }
                            })
                            //$('#delete').submit();
                        }
                    });
            });
        </script>
</body>

</html>
