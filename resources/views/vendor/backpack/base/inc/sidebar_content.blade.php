<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('exchange-rate') }}"><i class="la la-usd nav-icon"></i> {{ trans('admin.exchange_rates') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="la la-group nav-icon"></i> {{ trans('admin.users') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('transaction') }}"><i class="la la-exchange nav-icon"></i> {{ trans('admin.transactions') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('coin-order') }}'><i class='nav-icon la la-diamond'></i> {{ trans('admin.coin_orders') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('support-request') }}"><i class="la la-life-ring nav-icon"></i> {{ trans('admin.support_request') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> {{ trans('admin.logs') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> {{ trans('admin.settings') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ url('') }}"><i class="la la-external-link nav-icon"></i> {{ trans('admin.landing_page') }}</a></li>
