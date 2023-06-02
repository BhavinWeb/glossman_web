@if($products->count() > 0)
<h4 class="mt-5">Products List</h4>
<ul class="list-group">

@forelse($products as $product)
 <a href="{{ route('product_details', ['id' => $product->id]) }}"><li class="list-group-item">{{$product->title}}</li></a>
@empty
<li class="list-group-item">Product not found!</li>
@endforelse
</ul>
@endif
@if($services->count() > 0)
<h4 class="mt-5">Service List</h4>
<ul class="list-group">

@forelse($services as $service)
 <a href="{{route('service_details',['service_id' => $service->id])}}"><li class="list-group-item">{{$service->name}}</li>
@empty
<li class="list-group-item">Service not found!</li>
@endforelse
</ul>
<h4 class="mt-5">Product categories List</h4>
<ul class="list-group">
@forelse($categories as $category)
 <a href="{{route('product_list',['category_id' => $category->id])}}"><li class="list-group-item">{{$category->name}}</li>
@empty
<li class="list-group-item">Product categories not found!</li>
@endforelse
</ul>
@endif
