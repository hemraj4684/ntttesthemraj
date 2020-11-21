<?php

namespace App\Http\Controllers;

use App\Router;
use Illuminate\Http\Request;

class RestController extends Controller
{
    /**
     * Get all router informaion.
     *
     * @param  Request    $request
     * @return array
     */
    public function index(Request $request): array
    {
        $data = Router::orderBy('id', 'DESC');
        if ($request->has('type') && !empty(trim($request->get('type')))) {
            $data->where('routertype', $request->get('type'));
        }
        if ($request->has('ipstart') && $request->has('ipend') && !empty(trim($request->get('ipstart'))) && !empty(trim($request->get('ipend')))) {
            $data->whereBetween('loopback', [$request->get('ipstart'), $request->get('ipend')]);
        }

        return ['success' => true, 'data' => $data->get()];
    }

    /**
     * Delete a router item.
     * 
     * @param  Request    $request
     * @return array
     */
    public function delete(Request $request): array
    {
        if (Router::where('loopback', $request->ip)->delete()){
            return ['success' => true, 'msg' => 'Deleted successfully!'];
        }

        return ['success' => false, 'msg' => 'Something went wrong!'];
    }

    /**
     * Creates a new entry.
     * 
     * @param  Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        $errors = [];
        if (empty($request->sapid)) {
            $errors[] = 'Sapid is required.';
        }
        if (empty($request->hostname)) {
            $errors[] = 'Hostname is required.';
        } else {
            if (!empty(Router::where('hostname', $request->hostname)->first())) {
                $errors[] = 'Hostname is exists.';
            }
        }
        if (empty($request->loopback)) {
            $errors[] = 'Loopback is required.';
        } else {
            if (!empty(Router::where('loopback', $request->loopback)->first())) {
                $errors[] = 'Loopback is exists.';
            }
        }
        if (empty($request->macaddress)) {
            $errors[] = 'Macaddress is required.';
        }

        if (!empty($errors)) {
            return ['error' => true, 'validate' => $errors];
        }

        Router::insert([
            'sapid' => $request->sapid,
            'hostname' => $request->hostname,
            'loopback' => $request->loopback,
            'mac_address' => $request->macaddress
        ]);

        return ['success' => true, 'msg' => 'Data added successfully!'];
    }

    /**
     * Get one router informaion.
     *
     * @param  Request $request
     * @return array
     */
    public function get(Request $request): array
    {
        return ['success' => true, 'data' => Router::where('loopback', $request->ip)->first()];
    }

    /**
     * Update.
     * 
     * @param  Request $request
     * @return array
     */
    public function edit(Request $request): array
    {
        $errors = [];
        if (empty($request->sapid)) {
            $errors[] = 'Sapid is required.';
        }
        if (empty($request->hostname)) {
            $errors[] = 'Hostname is required.';
        } else {
            if (!empty(Router::where('hostname', $request->hostname)->where('loopback', '!=', $request->loopback)->first())) {
                $errors[] = 'Hostname is exists.';
            }
        }
        if (empty($request->macaddress)) {
            $errors[] = 'Macaddress is required.';
        }

        if (!empty($errors)) {
            return ['error' => true, 'validate' => $errors];
        }

        Router::where('id', $request->id)->update([
            'sapid' => $request->sapid,
            'hostname' => $request->hostname,
            'macaddress' => $request->macaddress
        ]);

        return ['success' => true, 'msg' => 'Data updated successfully!'];
    }
}
