@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                      <!-- //Restaurant Section Icon -->
                      <div class="d-flex justify-content-around">
                      <div>
                        <a href="/admin/restaurant" class="text-decoration-none text-dark">
                            <img src="{{asset('admin_images/cooking.png')}}" width="100px " height="auto" />
                            <h4 class="text-center"> Setup </h4>
                        </a>
                    </div>

                     <!-- //pos Section Icon -->
                     <div>
                        <a href="/pos" class="text-decoration-none text-dark">
                            <img src="{{asset('admin_images/pos.png')}}" width="100px " height="auto"  />
                            <h4 class="text-center">Open POS</h4>
                        </a>
                    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
