<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">

    <div class="col-2">
        <a class="navbar-brand p-2" href="#">PromoNow™</a>

    </div>

    <div class="collapse navbar-collapse" id="exCollapsingNavbar">


        <ul class="nav navbar-nav flex-row justify-content-between ml-auto">

            <li class="nav-item"><a href="{{ route('auditIndex') }}" class="nav-link">Audit</a></li>
            <li class="nav-item"><a href="{{ route('partnerIndex') }}" class="nav-link">Partners</a></li>
            <li class="nav-item"><a href="{{ route('brandVault') }}" class="nav-link">Brand Vault</a></li>

            <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i
                            class="fa fa-cog fa-fw fa-lg"></i></a></li>

            <li class="dropdown order-1">

                <button type="button" id="dropdownMenu1" data-toggle="dropdown"
                        class="btn btn-outline-secondary dropdown-toggle">
                    @php
                        /** @var \App\User $authenticatable */
                            $authenticatable=\Illuminate\Support\Facades\Auth::user();
                            if($authenticatable){echo $authenticatable->getFullName();}
                    @endphp

                    @switch($authenticatable->getGDPRCertificationStatus())
                        @case(\App\User::GDPR_CERTIFIED)
                        <span>&nbsp;<i class="fas fa-shield-alt" style="color:darkgreen"></i></span>
                        @break
                        @case(\App\User::GDPR_NOT_CERTIFIED)
                        <span>&nbsp;<i class="fas fa-exclamation-triangle" style="color:darkred"></i></span>
                        @break
                        @case(\App\User::GDPR_EXPIRES_SOON)
                        <span>&nbsp;<i class="fas fa fa-hourglass" style="color:darkred"></i></span>
                        @break
                        @case(\App\User::GDPR_EXPIRED)
                        <span>&nbsp;<i class="fas fa-history" style="color:darkred"></i></span>
                        @break
                    @endswitch

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

                    <li class="px-3 py-2">
                        <a class="dropdown-item" href="{{ route('gdprQuiz') }}">
                            GDPR Quiz
                        </a>

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


