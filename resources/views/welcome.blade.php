@foreach ($categories as $category)
    <div>
        {{$category->name}} ({{$category->id}})

        @foreach ($category->children as $child)
        <div style="margin-left: 20px;">
            {{$child->name}} ({{$child->id}})
        </div>

            <!-- @foreach ($child->children as $subChild)
            <div style="margin-left: 40px;">
                {{$subChild->name}} ({{$subChild->id}})
            </div>
            @endforeach -->
        @endforeach   
    </div>
@endforeach