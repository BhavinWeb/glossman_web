<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\Coupon\Entities\Coupon;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\CartCondition;
use Modules\Attribute\Entities\AttributeValue;
use Modules\Product\Entities\Product;

class CartController extends Controller
{
    public function cart()
    {
        $cart_items = \Cart::getContent();
        $total = \Cart::getTotal();
        $subtotal = \Cart::getSubTotal();
        $coupon_condition = \Cart::getCondition('Coupon');

        return view('website.pages.shop.cart', compact('cart_items', 'total', 'subtotal', 'coupon_condition'));
    }

    public function couponApply(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $code = Coupon::where('code', $request->code)
            ->where('expire_date', '>=', date('Y-m-d'))
            ->where('max_use', '>', 'total_uses')
            ->whereStatus(1)
            ->first();


        if ($code) {
            $discount_value = $code->discount;
            $value = $code->type == 'Percentage' ? $discount_value . '%' : $discount_value;

            $coupon = new CartCondition(array(
                'name' => 'Coupon',
                'type' => $code->type,
                'target' => 'total',
                'value' => '-' . $value,
                'attributes' => array( // attributes field is optional
                    'code' => $code->code,
                )
            ));

            \Cart::condition($coupon);

            if ($code->type == 'Percentage') {
                flashSuccess("You have got $code->discount% discount");
                return back();
            } else {
                flashSuccess("You have got $$code->discount discount");
                return back();
            }
        } else {
            flashError('Invalid coupon code or Expired !');
            return back();
        }
    }

    public function couponClear()
    {
        \Cart::removeCartCondition('Coupon');

        flashSuccess('Coupon discount has been removed');
        return back();
    }

    public function buyNow(Product $product)
    {
        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->sale_price ? $product->sale_price : $product->price,
            'quantity' => 1,
            'attributes' => array(
                'sale_price' => $product->sale_price,
                'price' => $product->price,
                'image' => asset($product->image),
            ),
            'associatedModel' => $product
        ]);

        return redirect()->route('website.checkout');
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);

            \Cart::add([
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => 1,
                'attributes' => array(
                    'sale_price' => $product->sale_price,
                    'price' => $product->price,
                    'image' => asset($product->image),
                ),
                'associatedModel' => $product
            ]);

            return response()->json(['success' => true, 'message' => 'Product added to cart']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Product not added to cart']);
        }
    }

    public function removeFromCart($cart_id)
    {
        try {
            \Cart::remove($cart_id);

            return back()->with('success', 'Product removed from cart');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Product not removed from cart']);
        }
    }

    public function removeFromCartAjax(Request $request)
    {
        try {
            \Cart::remove($request->cart_id);
            $cart_count = \Cart::getTotalQuantity();

            return response()->json(['success' => true, 'message' => 'Product removed from cart', 'count' => $cart_count]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Product not removed from cart']);
        }
    }

    public function countCart()
    {
        try {
            $cart_count = \Cart::getTotalQuantity();

            return response()->json(['success' => true, 'count' => $cart_count]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }

    public function fetchCartSubtotal()
    {
        try {
            $subTotal = \Cart::getSubTotal();

            return response()->json(['success' => true, 'subtotal' => $subTotal]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }

    public function fetchCartItems()
    {
        try {
            $cart_items = \Cart::getContent();

            return response()->json(['success' => true, 'items' => $cart_items]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }

    public function updateCart(Request $request)
    {
        $ids = $request->ids;
        $quantities = $request->quantities;

        foreach ($ids as $key => $id) {
            \Cart::update($id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantities[$key]
                ),
            ));
        }

        return back()->with('success', 'Product quantity updated successfully');
    }

    public function updateSingleCart(Request $request)
    {
        $values = $request->value_id;
        $attributes = [];

        if ($request->value_id) {
            foreach ($values as $value) {
                $attribute = AttributeValue::with('attribute')->find($value);
                array_push($attributes, [
                    'attribute' => $attribute->attribute->name,
                    'value' => $attribute->value
                ]);
            }
        }

        $id = $request->id;
        $quantity = $request->quantity;
        $product = Product::findOrFail($id);

        if (!\Cart::isEmpty()) {
            $item = \Cart::get($product->id);
            if ($item) {
                \Cart::update($id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $quantity
                    ),
                    'attributes' => array(
                        'sale_price' => $product->sale_price,
                        'price' => $product->price,
                        'image' => asset($product->image),
                        'attribute' => $attributes ?? '',
                    ),
                ));
            } else {
                \Cart::add([
                    'id' => $product->id,
                    'name' => $product->title,
                    'price' => $product->sale_price ? $product->sale_price : $product->price,
                    'quantity' => $quantity,
                    'attributes' => array(
                        'sale_price' => $product->sale_price,
                        'price' => $product->price,
                        'image' => asset($product->image),
                        'attribute' => $attributes ?? '',
                    ),
                    'associatedModel' => $product
                ]);
            }
        } else {
            \Cart::add([
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => $quantity,
                'attributes' => array(
                    'sale_price' => $product->sale_price,
                    'price' => $product->price,
                    'image' => asset($product->image),
                    'attribute' => $attributes ?? '',
                ),
                'associatedModel' => $product
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }
}
