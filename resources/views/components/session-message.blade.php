@if ( session()->has( 'message' ) )
<div class="flex border border-green-400 bg-green-100 rounded-lg mb-3">
    <div class="p-3">
        <i class="lar la-check-circle text-2xl text-green-700"></i>
    </div>
    <div class="flex-auto items-center flex">
        <p class="text-green-700 py-1">{!! session()->get( 'message' ) !!}</p>
    </div>
</div>
@endif