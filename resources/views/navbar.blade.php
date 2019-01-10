<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">

    <div class="col-2">
        <a class="navbar-brand p-2" href="#">PromoNow™</a>

    </div>

    <div class="collapse navbar-collapse" id="exCollapsingNavbar">

        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="/" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="/" class="nav-link">Customer Service</a></li>
            <li class="nav-item"><a href="/" class="nav-link">Fulfilment</a></li>
            <li class="nav-item"><a href="/promotions" class="nav-link">Promotions</a></li>
            <li class="nav-item"><a href="/" class="nav-link">Reports</a></li>
            <li class="nav-item"><a href="/" class="nav-link">Partners</a></li>
            <li class="nav-item"><a href="/" class="nav-link">Brand Vault</a></li>
        </ul>

        <ul class="nav navbar-nav flex-row justify-content-between ml-auto">

            <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i
                            class="fa fa-cog fa-fw fa-lg"></i></a></li>

            <li class="dropdown order-1">

                <button type="button" id="dropdownMenu1" data-toggle="dropdown"
                        class="btn btn-outline-secondary dropdown-toggle">
                    @php
                        /** @var \App\User $authenticatable */
                            $authenticatable=\Illuminate\Support\Facades\Auth::user();
                            if($authenticatable){echo $authenticatable->getName();}
                    @endphp
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu dropdown-menu-right mt-2">
                    <li class="px-3 py-2">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div id="modalPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Forgot password</h3>
                <button type="button" class="close font-weight-light" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Reset your password..</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


