<div class="sidebar-nav-fixed affix">
    <div class="well">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/">
                    <i class="fas fa-home"></i>
                    &nbsp;Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>

            @hasanyrole('marketing|super-admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('promotionIndex') }}">
                    <i class="fas fa-envelope-square"></i>
                    &nbsp;Promotions
                </a>
            </li>
            @endrole

            @hasanyrole('customer-service')
            <li class="nav-item">
                <a class="nav-link" href="/tickets">
                    <i class="fas fa-sms"></i>
                    &nbsp;Customer Services
                </a>
            </li>
            @endrole

            @hasanyrole('super-admin')
            <li class="nav-item">
                <a class="nav-link" href="/tickets">
                    <i class="fas fa-sms"></i>
                    &nbsp;Support Tasks
                </a>
            </li>
            @endrole

            @hasanyrole('fulfillment')
            <li class="nav-item">
                <a class="nav-link" href="/tickets">
                    <i class="fas fa-calendar-alt"></i>
                    &nbsp;Fulfillment
                </a>
            </li>
            @endrole

            @hasanyrole('marketing')
            <li class="nav-item">
                <a class="nav-link" href="/tickets">
                    <i class="fas fa-calendar-alt"></i>
                    My Tickets
                </a>
            </li>
            @endrole

            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports') }}">
                    <i class="fas fa-money-bill-alt"></i>
                    &nbsp;Reports
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('requestServices') }}">
                    <i class="fas fa-phone"></i>
                    &nbsp;Request Services
                </a>
            </li>
        </ul>
    </div>

    <br/>

    <div style="background-color: rgb(43,43,43); color: white; text-align: center;">
        <div class="img-gradient" style="margin-bottom: 0;">
            <img src="/images/brunette.jpg" width="100%"/>
        </div>

        <div style="background-color: rgb(43,43,43); color: white;">
            <div class="m-3">
                <h3>We've got you covered</h3>
                PromoNow™<br/>
                <p class="small"><b>Secure, fast and agile</b> solutions for promotional deployments and consumer data
                    safeguarding</p>

            </div>
        </div>
    </div>

</div>