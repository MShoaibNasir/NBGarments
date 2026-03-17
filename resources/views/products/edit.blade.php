@extends('dashboard.layout.master')
@section('content')
<style>
    /* Form styling */
    .form-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #000;
    }

    .form-control {
        border: 1px solid #000;
        border-radius: 8px;
        padding: 10px;
        color: #000;
    }

    .form-control:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }

    .btn-dark {
        background-color: #1edae8;
        border: none;
    }

    .btn-dark:hover {
        background-color: #1edae8;
    }

    .card-header {
        background-color: #1edae8;
        color: #fff;
    }

    /* Password toggle styles */
    .password-input-group {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: #000;
    }

    .password-toggle:focus {
        outline: none;
    }

    h4.mb-0 {
        color: white;
    }
</style>

<div class="content">
    @include('dashboard.layout.navbar')
    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> Update Product</h4>
                <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body bg-light">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">

                <div class="form-container mx-auto" style="max-width: 700px;">
                    <form method="POST" action="{{ route('products.update',[$product->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
                        </div>


                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-save me-1"></i> Update Product
                            </button>
                        </div>
                    </form>

                    <hr>
                    <br>
                    <div id="certificateContainer">
                        <div class="dynamic-section">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control">
                                </div>
                                <button type="button" class="btn btn-danger btn-sm" id="save_cost_of_product">Save Data</button>
                            </form>
                        </div>
                    </div>

                    <div id="showCertificate"></div>

                </div>
            </div>
        </div>
    </div>
</div>






















<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const toggleButtons = document.querySelectorAll('.password-toggle');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    });



    function showProductCostList() {

        const value = {
            product_id: $('#product_id').val()

        };


        $.ajax({
            url: "{{ route('list.product.cost') }}",
            method: 'POST',
            data: value,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                console.log(response);
                
                $('#showCertificate').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

    }
    showProductCostList();






    $('#save_cost_of_product').click(function() {
        const container = document.getElementById('certificateContainer');
        const lastSection = container.querySelector('.dynamic-section:last-of-type');
        let valid = true;

        // Required fields (checkboxes handled separately)
        const requiredFields = [
            '[name="description"]',
            '[name="amount"]'
        ];

        requiredFields.forEach(selector => {
            const input = lastSection.querySelector(selector);
            if (!input) return; // safety check

            if (input.type === 'checkbox') {
                if (!input.checked) {
                    valid = false;
                    input.closest('.checkbox-group').style.outline = '1px solid red';
                } else {
                    input.closest('.checkbox-group').style.outline = '';
                }
            } else {
                if (!input.value.trim()) {
                    valid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '';
                }
            }
        });

        if (!valid) {
            alert("⚠️ Please fill all required fields.");
            return;
        }

        // Collect data from the last dynamic section
        const experienceDetails = {
            description: lastSection.querySelector('[name="description"]').value,
            amount: lastSection.querySelector('[name="amount"]').value,
            product_id: $('#product_id').val()

        };

        $.ajax({

            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('save.product.cost') }}",
            data: experienceDetails,
            beforeSend: function() {
                Swal.fire({
                    title: 'Saving...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(response) {
                console.log(response);
                Swal.close();
                Swal.fire({
                    title: 'Save  Data',
                    text: 'Data added successfully!',
                    icon: 'success',
                    timer: 3000
                });

                // Clear the input fields in the last section
                lastSection.querySelectorAll('input, textarea').forEach(input => {
                    if (input.type === 'checkbox') {
                        input.checked = false;
                    } else {
                        input.value = '';
                    }
                });

                showProductCostList();
            },
            error: function(xhr, status, error) {
                Swal.close();
                console.error(error);
            }
        });

    });
</script>
@endsection