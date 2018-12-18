<ul class="nav nav-tabs" id="myTab" role="tablist">

    <li class="nav-item">
        <a class="nav-link active" id="mechanic-basics-tab" data-toggle="tab" href="#mechanicBasics" role="tab"
           aria-controls="home" aria-selected="true">Mechanic Basics</a>
    </li>

    @switch($mechanic->type)
        @case(\App\Models\Mechanic::MECHANIC_TYPE_WINNING_MOMENT)
        <li class="nav-item">
            <a class="nav-link" id="winning-moment-tab" data-toggle="tab" href="#winningMoment" role="tab"
               aria-controls="profile"
               aria-selected="false">Winning Moment Details</a>
        </li>
        @break
        @case(\App\Models\Mechanic::MECHANIC_TYPE_TIMED_DRAW)
        <li class="nav-item">
            <a class="nav-link" id="timed-draw-tab" data-toggle="tab" href="#timedDraw" role="tab" aria-controls="profile"
               aria-selected="false">Timed Draw Details</a>
        </li>
        @break
        @case(\App\Models\Mechanic::MECHANIC_TYPE_EVERYBODY_GETS)
        <li class="nav-item">
            <a class="nav-link" id="everybody-gets-tab" data-toggle="tab" href="#everybodyGets" role="tab" aria-controls="profile"
               aria-selected="false">Everybody Gets Details</a>
        </li>
        @break
        @case(\App\Models\Mechanic::MECHANIC_TYPE_ITEM_PRIZE_SEEDING)
        <li class="nav-item">
            <a class="nav-link" id="item-prize-seeding-tab" data-toggle="tab" href="#itemPrizeSeeding" role="tab"
               aria-controls="profile"
               aria-selected="false">Item/Prize Seeding Details</a>
        </li>
        @break

    @endswitch

    <li class="nav-item">
        <a class="nav-link" id="" data-toggle="tab" href="#prizeItem" role="tab"
           aria-controls="home" aria-selected="true">Prize Item</a>
    </li>



</ul>
<br/>