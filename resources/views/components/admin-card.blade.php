@foreach ($admins as $admin)


<div class="col-lg-3 col-md-6 col-12">
    <!-- Start Single Team -->
    <div class="single-team">
        <div class="image">
            <img src="https://via.placeholder.com/300x300" alt="#">
        </div>
        <div class="content">
            <div class="info">
                <h3>{{ $admin->name }}</h3>
                {{-- <h5>Founder, CEO</h5> --}}
                <ul class="social">
                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                    </li>
                    <li><a href="javascript:void(0)"><i class="lni lni-instagram-original"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Single Team -->
</div>
@endforeach
