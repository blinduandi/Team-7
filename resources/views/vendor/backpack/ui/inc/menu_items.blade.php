{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<x-backpack::menu-item title="Rooms" icon="la la-question" :link="backpack_url('room')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Languages" icon="la la-question" :link="backpack_url('language')" />
<x-backpack::menu-item title="Types" icon="la la-question" :link="backpack_url('type')" />
<x-backpack::menu-item title="Subjects" icon="la la-question" :link="backpack_url('subject')" />
<x-backpack::menu-item title="Profesors" icon="la la-question" :link="backpack_url('profesor')" />
<x-backpack::menu-item title="Groups" icon="la la-question" :link="backpack_url('group')" />