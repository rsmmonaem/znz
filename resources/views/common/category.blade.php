@php
    $categories = DB::table('category')->get();
@endphp
<select class="form-control" id="category" name="category">
    <option value="">Select Category</option>
    @foreach ($categories as $c)
        <option value="{{ $c->name }}">{{ $c->name }}</option>
    @endforeach
</select>
