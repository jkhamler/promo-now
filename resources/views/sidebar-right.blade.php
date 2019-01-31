<div class="sidebar-nav-fixed pull-right affix">
    <div class="well">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-users"></i>
                    &nbsp;Think GDPR!<span class="sr-only">(current)</span>
                </a>
                <div class="border p-2 m-2">

                    @section('sidebar-right-gdpr')

                        @if(Route::current()->getName() == 'tickets.index')

                            <p>GDPR Info Ticket Dashboard

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.
                            </p>

                        @elseif(Route::current()->getName() == 'tickets.show')

                            <p>GDPR Info Ticket Overview

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.
                            </p>

                        @endif

                    @show
                </div>
                <a class="nav-link active" href="#">
                    <i class="fas fa-lightbulb"></i>
                    &nbsp;Useful Info <span class="sr-only">(current)</span>
                </a>

                <div class="border p-2 m-2">

                    @section('sidebar-right-useful-info')

                        @if(Route::current()->getName() == 'tickets.index')

                            <p>Useful Info Ticket Dashboard

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.
                            </p>

                        @elseif(Route::current()->getName() == 'tickets.show')

                            <p>Useful Info Ticket Overview

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.
                            </p>

                        @endif

                    @show

                </div>
            </li>
        </ul>
    </div>
</div>