@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li><a href="/salary-bank-part">{!! trans('messages.Salary_BankPart') !!}</a></li>
    <li class="active">{!! trans('messages.edit') !!} {!! trans('messages.Salary_BankPart') !!}</li>
</ul>
@stop

@section('content')
<style>
    .flex-form-group {
        display: flex;
        align-items: center;
    }

    .flex-form-group label {
        margin-bottom: 0;
        margin-right: 10px;
        min-width: 120px;
        flex-shrink: 0;
    }

    .flex-form-group .form-control {
        flex-grow: 1;
    }

    .employee-info {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .action-buttons {
        text-align: center;
        margin-top: 30px;
    }

    .alert {
        margin-bottom: 20px;
    }

    .loading {
        opacity: 0.6;
        pointer-events: none;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info full">
            <div class="user-profile-content-wm">
                <h2>{!! trans('messages.edit') !!} {!! trans('messages.Salary_BankPart') !!}</h2>
                
                <!-- Employee Information -->
                <div class="employee-info">
                    <h4>Employee Information</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Employee ID:</strong> <span id="employee-id">{{ isset($bankPart->employee_code) ? $bankPart->employee_code : 'N/A' }}</span>
                        </div>
                        <div class="col-sm-6">
                            <strong>Employee Name:</strong> <span id="employee-name">{{ isset($bankPart->first_name) ? $bankPart->first_name : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div id="alert-container"></div>

                <!-- Edit Form -->
                <form id="editBankPartForm">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="gross">{!! trans('messages.gross') !!} {!! trans('messages.salary') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="gross" name="gross"
                                    value="{{ isset($bankPart->gross) ? $bankPart->gross : '' }}" required step="0.01" min="0">
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="cash_amount">{!! trans('messages.cash') !!} {!! trans('messages.amount') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="cash_amount" name="cash_amount"
                                    value="{{ isset($bankPart->cash_amount) ? $bankPart->cash_amount : '' }}" required step="0.01" min="0">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="effective_date">{!! trans('messages.effective') !!} {!! trans('messages.date') !!} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="effective_date" name="effective_date"
                                    value="{{ isset($bankPart->effective_date) ? $bankPart->effective_date : '' }}" required>
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="bank_amount">{!! trans('messages.bank') !!} {!! trans('messages.amount') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="bank_amount" name="bank_amount"
                                    value="{{ isset($bankPart->bank_amount) ? $bankPart->bank_amount : '' }}" required step="0.01" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-success" id="updateBtn">
                            <i class="fa fa-save"></i> {!! trans('messages.update') !!}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
$(document).ready(function() {
    var bankPartId = {{ $bankPart->id }};
    var isSubmitting = false;

    // Show alert function
    function showAlert(message, type) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible">' +
                       '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                       message + '</div>';
        $('#alert-container').html(alertHtml);
        
        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        }
    }

    // Auto-calculate cash amount when gross or bank amount changes
    $('#gross, #bank_amount').on('input', function() {
        var gross = parseFloat($('#gross').val()) || 0;
        var bankAmount = parseFloat($('#bank_amount').val()) || 0;
        var cashAmount = gross - bankAmount;
        
        if (cashAmount >= 0) {
            $('#cash_amount').val(cashAmount.toFixed(2));
        }
    });

    // Form validation
    function validateForm() {
        var gross = parseFloat($('#gross').val()) || 0;
        var bankAmount = parseFloat($('#bank_amount').val()) || 0;
        var cashAmount = parseFloat($('#cash_amount').val()) || 0;
        var effectiveDate = $('#effective_date').val();
        
        // Clear previous alerts
        $('#alert-container').empty();
        
        // Validate required fields
        if (!effectiveDate) {
            showAlert('Effective date is required', 'error');
            return false;
        }
        
        if (gross <= 0) {
            showAlert('Gross salary must be greater than 0', 'error');
            return false;
        }
        
        if (bankAmount < 0) {
            showAlert('Bank amount cannot be negative', 'error');
            return false;
        }
        
        if (cashAmount < 0) {
            showAlert('Cash amount cannot be negative', 'error');
            return false;
        }
        
        // Validate that bank amount + cash amount equals gross
        if (Math.abs((bankAmount + cashAmount) - gross) > 0.01) {
            showAlert('Bank Amount + Cash Amount must equal Gross Salary', 'error');
            return false;
        }
        
        return true;
    }

    // Form submission
    $('#editBankPartForm').on('submit', function(e) {
        e.preventDefault();
        
        if (isSubmitting) return;
        
        if (!validateForm()) return;
        
        isSubmitting = true;
        $('#updateBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
        $('body').addClass('loading');
        
        // Prepare form data
        var formData = {
            id: bankPartId,
            gross: $('#gross').val(),
            bank_amount: $('#bank_amount').val(),
            cash_amount: $('#cash_amount').val(),
            effective_date: $('#effective_date').val(),
            action: 'update'
        };
        
        // AJAX request
        $.ajax({
            url: '/update-bank-part/' + bankPartId,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                showAlert('Salary bank part updated successfully!', 'success');
                
                // Optional: Redirect after successful update
                setTimeout(function() {
                    window.location.href = '/salary-bank-part';
                }, 2000);
            },
            error: function(xhr, status, error) {
                var errorMessage = 'An error occurred while updating the record.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            errorMessage = response.message;
                        }
                    } catch (e) {
                        errorMessage = 'Server error occurred. Please try again.';
                    }
                }
                
                showAlert(errorMessage, 'error');
            },
            complete: function() {
                isSubmitting = false;
                $('#updateBtn').prop('disabled', false).html('<i class="fa fa-save"></i> {!! trans("messages.update") !!}');
                $('body').removeClass('loading');
            }
        });
    });

    // Cancel button
    $('#cancelBtn').on('click', function() {
        if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
            window.location.href = '/salary-bank-part';
        }
    });

    // Warn user if they try to leave with unsaved changes
    var formChanged = false;
    $('input, select, textarea').on('change', function() {
        formChanged = true;
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged && !isSubmitting) {
            e.preventDefault();
            e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        }
    });

    // Clear the warning when form is submitted
    $('#editBankPartForm').on('submit', function() {
        formChanged = false;
    });
});
</script>
@endsection