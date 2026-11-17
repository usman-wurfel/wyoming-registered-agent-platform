<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' )}}" class="btn btn-sm  <?=(empty(request()->type)) ? 'us_custom_active' : '' ?> " >Home </a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'order_page' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'order_page') ? 'us_custom_active' : '' ?> " >Order </a>
</h3>


<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'renew_llc' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'renew_llc') ? 'us_custom_active' : '' ?> " >Renew llC </a>
</h3>


<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'service_page' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'service_page') ? 'us_custom_active' : '' ?> " >Service </a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'wy_register_page' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'wy_register_page') ? 'us_custom_active' : '' ?> " >WY Registered Agent </a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'contact_page' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'contact_page') ? 'us_custom_active' : '' ?> " >Contact Us </a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'faqs_page' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'faqs_page') ? 'us_custom_active' : '' ?> " >Faqs </a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'choose_wyoming_llc_page' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'choose_wyoming_llc_page') ? 'us_custom_active' : '' ?> " >Choose Wyoming llc </a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'how_to_file_your_wy_llc' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'how_to_file_your_wy_llc') ? 'us_custom_active' : '' ?> " >How to file your wy llc</a>
</h3>

<h3 class="card-label" style="margin:0px;">
<a href="{{route('admin.page.data' , ['type' => 'term_n_condition' ])}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'term_n_condition') ? 'us_custom_active' : '' ?> " >Terms & Conditions</a>
</h3>

