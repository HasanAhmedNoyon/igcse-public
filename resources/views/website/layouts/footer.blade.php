@php
    $system_info = system_info();
@endphp
<!--Footer Start-->
<div class="container-fluid mt-5 footer py-2">
    <div class="container row">
        <div class="col-md-6">
            <h1 class="text-light">Logo</h1>
            <p class="text-light">It is a long established fact that a reader will be distracted by the readable
                content of a page when looking at its layout.</p>
        </div>
        <div class="col-md-3">
            <ul class="list-group">
                <li>Menu 1</li>
                <li>Menu 2</li>
                <li>Menu 3</li>
                <li>Menu 4</li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="list-group icon-list">
                <li><a href="{{ $system_info->facebook_link }}" target="_blank" >Facebook</a></li>
                <li><a href="{{ $system_info->twitter_link }}" target="_blank" >Instagram</a></li>
                <li><a href="{{ $system_info->instagram_link }}" target="_blank" >twitter</a></li>
            </ul>
        </div>
    </div>
</div>
<!--Footer End-->