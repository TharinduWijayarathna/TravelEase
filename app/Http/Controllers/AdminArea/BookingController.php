<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookingController extends Controller
{
    public function index(){
        return Inertia::render('AdminArea/Bookings/index');
    }

    public function all()
    {
        $query = Booking::query();

        if(request('code')){
            $code = request('code');
            $query->where('code', 'like', "%{$code}%");
        }

        if(request('status')){

            $status = request('status');
            if($status == "1"){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        if(request('status')){

            $status = request('status');
            if($status == "1"){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value){
                    $query->orWhere('id', 'like', "%{$value}%");
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('name', 'like', "%{$value}%");
                    $query->orWhere('status', $value);
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }

    public function allUserBookings()
    {
        $query = Booking::query();

        if(request('code')){
            $code = request('code');
            $query->where('code', 'like', "%{$code}%");
        }

        if(request('status')){

            $status = request('status');
            if($status == "1"){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        if(request('status')){

            $status = request('status');
            if($status == "1"){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        $query->where('user_id', auth()->user()->id);

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value){
                    $query->orWhere('id', 'like', "%{$value}%");
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('name', 'like', "%{$value}%");
                    $query->orWhere('status', $value);
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }
}
