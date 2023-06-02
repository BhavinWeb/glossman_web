<?php

namespace Modules\Coupon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('coupon.view'), 403);

        $coupons = Coupon::latest()->paginate(15);
        return view('coupon::index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!userCan('coupon.create'), 403);

        return view('coupon::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CouponRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        abort_if(!userCan('coupon.create'), 403);

        Coupon::create([
            'code' => $request->code,
            'max_use' => $request->max_use,
            'type' => $request->type,
            'discount' => $request->discount,
            'expire_date' => formatDate($request->expire_date, 'Y-m-d H:i:s')
        ]);

        flashSuccess('Coupon Created Successfully!');
        return redirect()->route('coupon.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        abort_if(!userCan('coupon.update'), 403);

        return view('coupon::edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        abort_if(!userCan('coupon.update'), 403);

        $coupon->update([
            'code' => $request->code,
            'max_use' => $request->max_use,
            'type' => $request->type,
            'discount' => $request->discount,
            'expire_date' => formatDate($request->expire_date, 'Y-m-d H:i:s')
        ]);

        flashSuccess('Coupon Updated Successfully!');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        abort_if(!userCan('coupon.delete'), 403);

        try {
            $coupon->delete();

            flashSuccess('Coupon Deleted Successfully!');
            return back();
        } catch (\Exception $e) {
            flashError();
            return back();
        }
    }

    /**
     * Status change list from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        abort_if(!userCan('coupon.update'), 403);

        try {
            Coupon::findOrFail($request->id)->update(['status' => $request->status]);

            if ($request->status == 1) {
                return responseSuccess('Coupon Activated Successfully');
            } else {
                return responseSuccess('Coupon Inactivated Successfully');
            }
        } catch (\Exception $e) {
            return responseError();
        }
    }
}
