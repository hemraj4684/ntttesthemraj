<?php

namespace App\Http\Controllers;

use App\Router;
use Illuminate\Http\Request;

class RouterController extends Controller
{
    /**
     * Get all router informaion.
     * 
     * @return array
     */
    public function index(): array
    {
        return ['success' => true, 'data' => Router::where('is_deleted', 0)->orderBy('id', 'DESC')->get()];
    }

    /**
     * Soft Delete a router item.
     * 
     * @param  int    $id
     * @return array
     */
    public function delete(int $id): array
    {
        if (Router::where('id', $id)->update(['is_deleted' => 1])){
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
        }
        if (empty($request->loopback)) {
            $errors[] = 'Loopback is required.';
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
            'macaddress' => $request->macaddress
        ]);

        return ['success' => true, 'msg' => 'Data added successfully!'];
    }

    /**
     * Edit an item.
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
        }
        if (empty($request->loopback)) {
            $errors[] = 'Loopback is required.';
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
            'loopback' => $request->loopback,
            'macaddress' => $request->macaddress
        ]);

        return ['success' => true, 'msg' => 'Data updated successfully!'];
    }

    /**
     * Get one router informaion.
     * 
     * @return array
     */
    public function get(int $id): array
    {
        return ['success' => true, 'data' => Router::where('id', $id)->first()];
    }
}
