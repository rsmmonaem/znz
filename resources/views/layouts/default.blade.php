@include('layouts.head')

<div class="container">
    <div class="logo-brand header sidebar rows">
        <div class="logo" style="text-align: center">
            <style>
                .sidebar-inner .media {
                    margin: 10px -15px 0 -15px !important;
                }
            </style>
            <h1>Welcome to J & Z Group</h1>
            {{-- <h1><a href="{!! URL::to('/') !!}">{!! config('config.application_name').' '.config('code.version') !!}</a></h1> --}}
        </div>
    </div>
    @include('layouts.sidebar')
    <div class="right content-page">

        @include('layouts.header')

        <div class="body content rows scroll-y">
            @yield('breadcrumb')

            @include('message')

            @yield('content')

            @include('layouts.footer')
        </div>
    </div>
</div>
<div id="overlay"></div>
<div class="modal fade" id="myModal" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

@include('layouts.foot')
<script>
function HandleBranchWiseEmployees(branch_id, employee_id, employee_code) {
    $.ajax({
        url: '/branch-employees',  
        type: 'POST',
        data: {
            branch_id: branch_id,
            _token: $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(data) {
            // Reset the employee dropdown list
            $(employee_id).val('');
            $(employee_id).empty();
            
            // Add default option to the dropdown
            $(employee_id).append($('<option>', {
                value: '',
                text: 'Select Employee'
            }));
            
            // Loop through each employee and append them to the dropdown
            data.forEach(function(employee) {
                $(employee_id).append($('<option>', {
                    value: employee_code ? employee.employee_code : employee.id,
                    text: employee.employee_code + ' - ' + employee.employee_name
                }));
            });
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error); // Handle errors
            alert("Failed to load employee data. Please try again.");
        }
    });
}
</script>
@yield('javascript')
