@foreach ($trusted_by_list as $trusted_by)
    <div>
        <a href="#">
            <span>DELETE</span>
            <img class="trusted_logo" src="{{ $getImage('front/images/trusted_by/', $trusted_by->image) }}">
        </a>
    </div>
@endforeach