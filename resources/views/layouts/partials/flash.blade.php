@if (session('masssage'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show" id="alert_massage">
        {{session('massage')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
