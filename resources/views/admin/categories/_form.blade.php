<div>
    <x-form.input type="text" value="{{ $category->name }}" id="name" name="name" lable="category Name" />

        <div>
            <x-form.input type="file" value="{{ $category->image }}" id="image" name="image" lable="category Image" />
            <a href="{{ $category->image_url }}">
                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" srcset="" high=120 width=100>
            </a>
        </div>
        <br>

    <button type="submit" class="btn btn-success">{{ $btn_submit ?? 'SAVE' }}</button>
</div>
