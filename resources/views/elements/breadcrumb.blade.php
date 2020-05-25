

<ol class="breadcrumb">
    @foreach ($breadcrumb as $k => $item)  
        @if ($item['url'] == "#")
        <li class="breadcrumb-item">
            {{ $item['name']}}
          </li>  
        @else
        <li class="breadcrumb-item">
        <a href="{{$item['url']}}" class="" slot="item-title">{{$item['name']}}</a></li> 
        @endif
    @endforeach      
  </li>
</ol>