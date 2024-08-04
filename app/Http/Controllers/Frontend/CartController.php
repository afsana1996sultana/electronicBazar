<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Carbon\Carbon;
use App\Models\PcCart;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        // Header Category Start
        $categories = Category::orderBy('name_en', 'DESC')->where('status', '=', 1)->limit(5)->get();
        $carts = Cart::content();
        //dd($carts);
        return view('frontend.cart.index', compact('categories'));
    }

    /* ============ Start AddToCart Methoed ============ */
    public function AddToCart(Request $request, $id)
    {
        $options = json_decode(stripslashes($request->get('options')));
        //dd($request->product_varient,$request->quantity );
        $attribute_ids = array();
        $attribute_names = array();
        $attribute_values = array();
        $product = Product::findOrFail($id);
        if($product->is_varient==0){
            if($request->quantity > $product->stock_qty){
                return response()->json(['error'=> 'Not enough stock']);
            }
        }else if($product->is_varient==1){
            $stock = ProductStock::where('product_id', $id)->where('varient', $request->product_varient)->first();
            if ($stock && $request->quantity > $stock->qty) {
                return response()->json(['error' => 'Not enough stock']);
            }
        }
        if ($product->is_varient) {
            foreach ($options as $option) {
                if ($option->name == 'attribute_ids[]') {
                    $item = $option->value;
                    array_push($attribute_ids, $item);
                } else if ($option->name == 'attribute_names[]') {
                    $item = $option->value;
                    array_push($attribute_names, $item);
                } else if ($option->name == 'attribute_options[]') {
                    $item = $option->value;
                    array_push($attribute_values, $item);
                }
            }
        }
        if ($request->product_price) {
            $price = $request->product_price;
        } else {
            if ($product->discount_price > 0) {
                if ($product->discount_type == 1) {
                    $price = $product->regular_price - $product->discount_price;
                } else {
                    $price = $product->regular_price - ($product->discount_price * $product->regular_price / 100);
                }
            } else {
                $price = $product->regular_price;
            }
        }
        if ($product->is_varient) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'slug' => $product->slug,
                    'is_varient' => 1,
                    'varient' => $request->product_varient,
                    'attribute_ids' => $attribute_ids,
                    'attribute_names' => $attribute_names,
                    'attribute_values' => $attribute_values,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'slug' => $product->slug,
                    'is_varient' => 0,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    }
    /* ============ End AddToCart Methoed =========== */

    /*=================== Start Mini Cart  Methoed ===================*/
    public function AddMiniCart()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    } // end method

    /*=================== End Mini Cart  Methoed ===================*/

    /*=========== Start Remove Mini Cart  Methoed ============*/
    public function RemoveMiniCart($rowId)
    {

        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed from Cart']);
    }

    /*============== End Remove Mini Cart  Methoed =============*/

    /* ================= Start GetCartProduct Method =================== */
    public function getCartProduct()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    } //end method
    /* ================= End GetCartProduct Method =================== */

    /* ================= Start CartIncrement Method =================== */
    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        $id = $row->id;
        $product = Product::findOrFail($id);
        if (!$product->is_varient) {
            $prev_cart_qty = 1;
            $carts = Cart::content();
            foreach ($carts as $cart) {
                if ($cart->id == $id) {
                    $prev_cart_qty += $cart->qty;
                }
            }
            $qty = $prev_cart_qty;

            if ($qty > $product->stock_qty) {
                return response()->json(['error' => 'Not enough stock']);
            }

            if ($product->is_wholesell == 1) {
                if ($product->wholesell_minimum_qty == $qty + 1 || $product->wholesell_minimum_qty < $qty + 1) {
                    $Price = $product->wholesell_price;
                } elseif ($product->wholesell_minimum_qty > $qty + 1) {
                    if ($product->discount_type == 1) {
                        $discount = $product->discount_price;
                        $Price = $product->regular_price - $discount;
                    } else if ($product->discount_type == 2) {
                        $discount = $product->regular_price * $product->discount_price / 100;
                        $Price = $product->regular_price - $discount;
                    } else {
                        $Price = $product->regular_price;
                    }
                }
            } else {
                if ($product->discount_type == 1) {
                    $discount = $product->discount_price;
                    $Price = $product->regular_price - $discount;
                } else if ($product->discount_type == 2) {
                    $discount = $product->regular_price * $product->discount_price / 100;
                    $Price = $product->regular_price - $discount;
                } else {
                    $Price = $product->regular_price;
                }
            }
        } else {
            $prev_cart_qty = 1;
            $carts = Cart::content();
            foreach ($carts as $cart) {
                if ($cart->id == $id) {
                    if ($cart->options->varient == $row->product_varient) {
                        $prev_cart_qty += $cart->qty;
                    }
                }
            }
            $qty = $prev_cart_qty + $row->qty;
            $stock = ProductStock::where('product_id', $id)->where('varient', $row->options->varient)->first();
            if ($qty > $stock->qty) {
                return response()->json(['error' => 'Not enough stock']);
            }
            if ($product->is_wholesell == 1) {
                if ($product->wholesell_minimum_qty == $qty + 1 || $product->wholesell_minimum_qty < $qty + 1) {
                    $Price = $product->wholesell_price;
                } elseif ($product->wholesell_minimum_qty > $qty + 1) {
                    if ($product->discount_type == 1) {
                        $discount = $product->discount_price;
                        $Price = $stock->price - $discount;
                    } else if ($product->discount_type == 2) {
                        $discount = $stock->price * $product->discount_price / 100;
                        $Price = $stock->price - $discount;
                    } else {
                        $Price = $stock->price;
                    }
                }
            } else {
                if ($product->discount_type == 1) {
                    $discount = $product->discount_price;
                    $Price = $stock->price - $discount;
                } else if ($product->discount_type == 2) {
                    $discount = $stock->price * $product->discount_price / 100;
                    $Price = $stock->price - $discount;
                } else {
                    $Price = $stock->price;
                }
            }
        }
        Cart::update($rowId, [
            'qty' => $row->qty + 1,
            'price' => $Price,
        ]);

        return response()->json(['success' => 'Successfully Change Quantity']);
    } // end mehtod

    /* ================= End CartIncrement Method =================== */

    /* ================= Start CartDecrement Method =================== */
    public function cartDecrement($rowId)
    {

        $row = Cart::get($rowId);
        $id = $row->id;
        $product = Product::findOrFail($id);
        if (!$product->is_varient) {
            $prev_cart_qty = 0;
            $qty = $prev_cart_qty + $row->qty;
            if ($product->is_wholesell == 1) {
                if ($product->wholesell_minimum_qty == $qty - 1 || $product->wholesell_minimum_qty < $qty - 1) {
                    $Price = $product->wholesell_price;
                } elseif ($product->wholesell_minimum_qty > $qty - 1) {
                    if ($product->discount_type == 1) {
                        $discount = $product->discount_price;
                        $Price = $product->regular_price - $discount;
                    } else if ($product->discount_type == 2) {
                        $discount = $product->regular_price * $product->discount_price / 100;
                        $Price = $product->regular_price - $discount;
                    } else {
                        $Price = $product->regular_price;
                    }
                }
            } else {
                if ($product->discount_type == 1) {
                    $discount = $product->discount_price;
                    $Price = $product->regular_price - $discount;
                } else if ($product->discount_type == 2) {
                    $discount = $product->regular_price * $product->discount_price / 100;
                    $Price = $product->regular_price - $discount;
                } else {
                    $Price = $product->regular_price;
                }
            }
        } else {
            $prev_cart_qty = 0;
            $qty = $prev_cart_qty + $row->qty;
            $stock = ProductStock::where('product_id', $id)->where('varient', $row->options->varient)->first();
            if ($product->is_wholesell == 1) {
                if ($product->wholesell_minimum_qty == $qty - 1 || $product->wholesell_minimum_qty < $qty - 1) {
                    $Price = $product->wholesell_price;
                } elseif ($product->wholesell_minimum_qty > $qty - 1) {
                    if ($product->discount_type == 1) {
                        $discount = $product->discount_price;
                        $Price = $stock->price - $discount;
                    } else if ($product->discount_type == 2) {
                        $discount = $stock->price * $product->discount_price / 100;
                        $Price = $stock->price - $discount;
                    } else {
                        $Price = $stock->price;
                    }
                }
            } else {
                if ($product->discount_type == 1) {
                    $discount = $product->discount_price;
                    $Price = $stock->price - $discount;
                } else if ($product->discount_type == 2) {
                    $discount = $stock->price * $product->discount_price / 100;
                    $Price = $stock->price - $discount;
                } else {
                    $Price = $stock->price;
                }
            }
        }
        // Cart::update($rowId, $row->qty - 1);
        Cart::update($rowId, [
            'qty' => $row->qty - 1,
            'price' => $Price,
        ]);
        return response()->json($row->qty);
    } // end method

    /* ================= End CartDecrement Method =================== */

    /* ================= Start RemoveCartProduct Method ============== */
    public function removeCartProduct($rowId)
    {

        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);
    } // end method

    /* =============== Start RemoveCartProduct Method ============= */

    /* ================= Start Destroy Method ============== */
    public function destroy()
    {
        Cart::destroy();
        Session::flash('success', 'Cart Permanently Deleted Successfully.');
        return back();
    } // end method

    /* ================= Start Destroy Method ============== */

    /* ============ Start Pc Cart Methoed ============ */
    public function PcAddToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $s_id = session()->get('session_id');
        if ($s_id == null) {
            session()->put('session_id', uniqid());
            $s_id = session()->get('session_id');
        }
        $user_id = auth()->user()->id ?? null;
        if (PcCart::where('product_id', $product->id)->where('session_id', $s_id)->exists()) {
            return response()->json(['error' => 'Already Added on Your Cart']);
        } else {
            PcCart::create([
                'product_id' => $product->id,
                'qty' => $request->quantity,
                'user_id' => $user_id,
                'session_id' => $s_id,
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    }
    public function PcgetCart()
    {
        $s_id = session()->get('session_id');
        $pc_Cart = PcCart::where('session_id', $s_id)->get();
        $totalPrice = 0;

        foreach ($pc_Cart as $data) {
            if ($data->product->discount_type == 1) {
                $price_after_discount = $data->product->regular_price - $data->product->discount_price;
            } elseif ($data->product->discount_type == 2) {
                $price_after_discount = $data->product->regular_price - ($data->product->regular_price * $data->product->discount_price / 100);
            }
            if ($data->product->discount_price > 0) {
                $subtotal = $price_after_discount * $data->qty;
            } else {
                $subtotal = $data->product->regular_price * $data->qty;
            }
            $totalPrice += $subtotal;
        }
        return response()->json([
            'cart_data' => view('frontend.product.pcCart', compact('pc_Cart'))->render(),
            'totalPrice' => $totalPrice,
        ]);
    }
    public function PcCartdelete($id)
    {
        PcCart::find($id)->delete();
        return response()->json([
            'success' => "Product delete successfully",
        ]);
    }
    public function PcUpdateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $type = $request->input('type');
        $s_id       = session()->get('session_id');
        $prod_check = Product::where('id', $product_id)->first();
        $cart = PcCart::where('product_id', $product_id)->where('session_id', $s_id)->first();
        if ($cart) {
            if ($type == '+') {
                if ($prod_check->stock == $cart->qty) {
                    return response()->json(['error' => 'Product stock limited']);
                }
                $cart->qty += 1;
            } else {
                if ($cart->qty == 1) {
                    return response()->json(['error' => "Minimum 1 item required"]);
                }
                $cart->qty -= 1;
            }
        }
        $cart->save();
        return response()->json([
            'success' => "Quantity update successfully",
        ]);
    }

    public function addPcMainCart()
    {
        $s_id = session()->get('session_id');
        $pc_Cart = PcCart::where('session_id', $s_id)->get();
        if ($pc_Cart->count() == 0) {
            return redirect()->back();
        }
        if ($pc_Cart) {
            foreach ($pc_Cart as $cart) {
                if ($cart->product->discount_price > 0) {
                    if ($cart->product->discount_type == 1) {
                        $price = $cart->product->regular_price - $cart->product->discount_price;
                    } else {
                        $price = $cart->product->regular_price - ($cart->product->discount_price * $cart->product->regular_price / 100);
                    }
                } else {
                    $price = $cart->product->regular_price;
                }
                Cart::add([
                    'id' => $cart->product_id,
                    'name' => $cart->product->name_en,
                    'qty' => $cart->qty,
                    'price' => $price,
                    'weight' => 1,
                    'options' => [
                        'image' => $cart->product->product_thumbnail,
                        'slug' => $cart->product->slug,
                        'is_varient' => 0,
                    ],
                ]);
            }
            foreach ($pc_Cart as $item) {
                if (Product::where('id', $item->product_id)->exists()) {
                    $removeItem = PcCart::where('session_id', $s_id)->where('product_id', $item->product_id)->first();
                    $removeItem->delete();
                }
            }
            return redirect()->route('checkout');
        }
    }
    /* ============ End Pc Cart Methoed ============ */
}