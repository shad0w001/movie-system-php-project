{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Genres" icon="la la-bookmark" :link="backpack_url('genre')" />
<x-backpack::menu-item title="Producers" icon="la la-female" :link="backpack_url('producer')" />
<x-backpack::menu-item title="Movies" icon="la la-film" :link="backpack_url('movie')" />