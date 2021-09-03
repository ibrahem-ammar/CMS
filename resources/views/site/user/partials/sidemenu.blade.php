<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
    <div class="wn__sidebar">
        <aside class="widget recent_widget">
            <ul>
                <li class="list-group-item">

                    <div class="row">
                        <div class="col-12">
                                <div style="
                                height: 150px;
                                width: 150px;
                                border: 1px solid rgba(0, 0, 0, 0.3);
                                border-radius: 50%;
                                margin: auto;
                                background-image:  url('{{ asset('assets/users/'. (auth()->user()->image != null ? auth()->user()->image : '1.jpeg') ) }}');
                                background-size: cover;
                                background-position: center;
                                background-repeat:no-repeat;

                            " />
                        </div>
                    </div>


                    {{-- @if (auth()->user()->image != null)
                        <img src="" height="300" width="300" alt="{{ auth()->user()->name }}">
                    @else
                        <img src="{{ asset('assets/users/1.jpeg') }}" height="300" width="300" alt="{{ auth()->user()->name }}">
                    @endif --}}
                </li>

                <li class="list-group-item">
                    <a href="{{ route('dashboard') }}">My Posts</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('posts.create') }}">Create Post</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('dashboard.comments') }}">Manage Comments</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('dashboard.edit_info') }}">Update Information</a>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
        </aside>
    </div>
</div>
