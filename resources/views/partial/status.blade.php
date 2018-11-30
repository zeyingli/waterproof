@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
         {{ session('success') }}
         <br> Your current balance is: $ {{ Auth::user()->balance }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
@if(session()->has('overdued'))
    <div class="alert alert-warning" role="alert">
         {{ session('overdued') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
@if(session()->has('errors'))
    <div class="alert alert-danger" role="alert">
         {{ session('errors') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
@if(!$overdueCheck)
    <div class="alert alert-danger" role="alert">
        <i class="material-icons icon">report_problem</i> Your account has been locked due to an overdue order has not been paid off.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
@if(session()->has('notice'))
    <div class="alert alert-info" role="alert">
         {{ session('notice') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif