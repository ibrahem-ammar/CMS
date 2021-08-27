@if (session('message'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert" id="alert_message">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('resent'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert_message">
        {{ __('A fresh verification link has been sent to your email address.') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" role="alert" id="alert_message">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
