@extends('dashboard.layout.master')
@section('content')
<style>
    input.form-control.btn.btn-success.my-4 {
        margin-left: 14px;
    }

    .hover-btn:hover {
        color: white !important;
    }

    /* professional loader */
    .loader-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .loader-text {
        margin-left: 10px;
        font-size: 1rem;
        color: #0d6efd;
        /* Bootstrap primary color */
    }
</style>


<div class="content">
    <!-- Navbar Start -->
    @include('dashboard.layout.navbar')
    <!-- Navbar End -->

    <div class="container-fluid pt-4 px-4 form_width">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Customer Payment List</h6>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="pdmadatalist">
                        <!--Toolbar-->
                        <div class="toolbar">
                            <div class="filters-toolbar-wrapper">
                                <div class="row">
                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="first_name">Search By Cheque No</label>
                                        <input type="text" id="bill_no" class="form-control" placeholder="Cheque No">
                                    </div>
                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="first_name">Search By Customer Name</label>
                                        <input type="text" id="first_name" class="form-control" placeholder="Customer Name">
                                    </div>

                                  {{--  <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="last_name">Search By Product Name</label>
                                        <input type="text" id="product_name" class="form-control" placeholder="Product Name">
                                    </div>
                                    --}}


                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="sorting">Sort By</label>
                                        <select name="sorting" id="sorting" class="form-control">
                                            <option value="id">ID</option>
                                        </select>
                                    </div>

                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="direction">Direction</label>
                                        <select name="direction" id="direction" class="form-control">
                                            <option value="asc">ASC</option>
                                            <option value="desc" selected>DESC</option>
                                        </select>
                                    </div>

                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="qty">Quantity</label>
                                        <select name="qty" id="qty" class="form-control">
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                    {{-- <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="qty">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option>Select Status</option>
                                            <option value="Pending" >Pending</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Failed">Failed</option>
                                        </select>
                                    </div>
 --}}
                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>

                                    <div class="filters-toolbar__item mb-3 col-md-4">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--End Toolbar-->

                        <div class="filter_data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
</div>


@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        toast: true, // This enables the toast mode
        position: 'top-end', // Position of the toast
        showConfirmButton: false, // Hides the confirm button
        timer: 3000 // Time to show the toast in milliseconds
    });
</script>
@endif
@if(session('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "{{ session('success') }}"
    });
</script>
@endif

@endsection
@push('ayiscss')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<style>
    .pdmadatalist .form-group {
        margin-bottom: 15px;
    }

    .pdmadatalist label {
        display: block;
        text-align: left;
    }

    .pdmadatalist .select2-container {
        width: 100% !important;
        text-align: left;
    }
</style>
@endpush
@push('ayisscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    function toArray(csvString) {
        return csvString.split(',').map(item => item.trim());
    }

    $(document).ready(function() {
        $('.select2').select2();








    });

    $(document).ready(function() {
        filter_data();

        function filter_data(currentpage) {
            $('.filter_data').html('<div id="loading"></div>');
            var action = 'fetch_data';
            var sorting = $("#sorting").val();
            var trench = $("#trench").val();
            var bank_id = $("#bank_id").val();
            var direction = $("#direction").val();
            var status = $("#status").val();
            var qty = $("#qty").val();



            var district = $("#district").val();
            var tehsil_id = $("#tehsil_id").val();
            var uc_id = $("#uc_id").val();

            var beneficiary_name = $("#beneficiary_name").val();
            var bank_name = $("#bank_name").val();
            var bill_no = $("#bill_no").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var product_name = $("#product_name").val();
            var cnic = $("#cnic").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var is_cheque = $("#is_cheque").val();
            //var colors = get_filter('color');


            var ayis_page = currentpage ?? 1;

            $.ajax({
                type: 'POST',
                data: {
                    action: action,
                    district: district,
                    tehsil_id: tehsil_id,
                    uc_id: uc_id,
                    trench: trench,
                    bank_id: bank_id,
                    bill_no: bill_no,
                    first_name: first_name,
                    last_name: last_name,
                    product_name: product_name,
                    cnic: cnic,
                    sorting: sorting,
                    status: status,
                    direction: direction,
                    is_cheque: is_cheque,
                    end_date: end_date,
                    start_date: start_date,
                    qty: qty,
                    ayis_page: ayis_page,
                    _token: '{{csrf_token()}}'
                },
                url: "{{ route('payment.list') }}",
                beforeSend: function() {
                    $('.filter_data').html(`
                        <div class="loader-wrapper">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="loader-text">Loading...</span>
                        </div>
                    `);
                },

                success: function(data) {
                    $('.filter_data').html(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });

        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }





        $('.common_selector').click(function() {
            filter_data();
        });

        $("#bill_no,#first_name, #last_name, #product_name, #bank_name").on('keyup keydown', function() {
            filter_data();
        });



        $('body').on('change', '#sorting,#bank_id, #direction, #is_cheque, #qty, #status, #tehsil_id, #uc_id, #trench,#start_date,#end_date', function(e) {
            e.preventDefault();
            filter_data();
        });

        $('body').on('click', '.pagination a', function(f) {
            f.preventDefault();
            var url = $(this).attr('href');
            var currentpage = url.split('page=')[1];
            filter_data(currentpage);
        });







    });
</script>
@endpush