@extends('admin.layouts.app', ['title' => 'Commission Report'])
@section('heads')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Commission Report</h4>
            </div>
            {{-- <a href="{{ route('members.create') }}">
            <button type="button" class="btn btn-primary bg-gradient waves-effect waves-light mb-3">Create</button>
        </a> --}}
            <div class="card">
                <div class="card-header">
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="text" name="from_date" id="from_date" class="form-control"
                                placeholder="From Date" readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                                readonly />
                        </div>
                        <div class="col-md-4">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="live-preview">

                        <div class="table-responsive">
                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                    <tr>




                                        <th>SrNo</th>
                                        <th>Policy ID</th>
                                        <th>Commission</th>
                                        <th>TDS</th>
                                        <th>After TDS</th>
                                        <th>PAN</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Emp Code</th>
                                        <th>Policy Type</th>
                                        <th>Date</th>
                                        <th>Coupon</th>
                                        <th>View</th>


                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                        <!-- end table responsive -->
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pay Commission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pay_commission') }}" method="POST">
                        @csrf



                        <div class="mb-3">
                            <label for="oldPasswordInput" class="form-label">Coupon / Code</label>
                            <input name="coupon" type="text" class="form-control " id="oldPasswordInput"
                                placeholder="Coupon">

                        </div>
                        <input name="id" type="hidden" class="form-control " id="data_id">


                        <div class="card-footer">
                            <button class="btn btn-success">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            load_data();

            function load_data(from_date = '', to_date = '') {

                $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    "aaSorting": [],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    dom: "Bfrtip",
                    buttons: ["pageLength", "excel"],
                    ajax: {
                        url: '{{ route('report.commission') }}',
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'policy',
                            name: 'policy'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'TDS',
                            name: 'TDS'
                        },
                        {
                            data: 'Final_amnt',
                            name: 'Final_amnt'
                        },
                        {
                            data: 'PAN',
                            name: 'users.PAN'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'uname',
                            name: 'user'
                        },
                        {
                            data: 'display_name',
                            name: 'user'
                        },
                        {
                            data: 'code',
                            name: 'users.user_id'
                        },
                        {
                            data: 'policytype',
                            name: 'id'
                        },
                        {
                            data: 'start_date',
                            name: 'id'
                        },
                        {
                            data: 'coupon',
                            name: 'coupon'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });
            }

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $('.yajra-datatable').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('.yajra-datatable').DataTable().destroy();
                load_data();
            });

        });


        $(document).on("click", ".paynow", function() {
            var idd = $(this).data("id");
            $('#data_id').val(idd);
        });
    </script>
@endsection
