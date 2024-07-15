<?php

namespace App\Controllers;

use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    protected $apiKey = "1y86a8m11z3v2taqs3ps";
    protected $user;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        $this->user = new UserModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
    public function monthly()
    {
        $data = [
            'query' => [],
            'results' => [],
            'status' => ["code" => 401, "description" => "Unauthorized"]
        ];

        $headers = $this->request->headers();
        $postData = $this->request->getPost();

        $data['query'] = $postData;

        array_walk($headers, function (&$value, $key) {
            $value = $value->getValue();
        });

        if ($headers["Key"] == $this->apiKey) {
            if ($postData['type'] == 'transaction') {
                $result = $this->transaction->select('COUNT(*) as jml')->like('created_at', '' . $postData['tahun'] . '-' . $postData['bulan'] . '', 'after')->first();
                $data['results'] = $result;
                $data['status'] = ["code" => 200, "description" => "OK"];
            } elseif ($postData['type'] == 'earning') {
                $result = $this->transaction->select('sum(total_harga) as jml')->like('created_at', '' . $postData['tahun'] . '-' . $postData['bulan'] . '', 'after')->first();
                $data['results'] = $result;
                $data['status'] = ["code" => 200, "description" => "OK"];
            } elseif ($postData['type'] == 'user') {
                $result = $this->user->select('COUNT(*) as jml')->like('created_at', '' . $postData['tahun'] . '-' . $postData['bulan'] . '', 'after')->first();
                $data['results'] = $result;
                $data['status'] = ["code" => 200, "description" => "OK"];
            }
        }

        return $this->respond($data);
    }
    public function yearly()
    {
        $data = [
            'query' => [],
            'results' => [],
            'status' => ["code" => 401, "description" => "Unauthorized"]
        ];

        $headers = $this->request->headers();
        $postData = $this->request->getPost();

        $data['query'] = $postData;

        array_walk($headers, function (&$value, $key) {
            $value = $value->getValue();
        });

        if ($headers["Key"] == $this->apiKey) {
            if ($postData['type'] == 'transaction') {
                $result = $this->transaction->select('COUNT(*) as jml')->like('created_at', '' . $postData['tahun'] . '-' . '', 'after')->first();
                $data['results'] = $result;
                $data['status'] = ["code" => 200, "description" => "OK"];
            } elseif ($postData['type'] == 'earning') {
                $result = $this->transaction->select('sum(total_harga) as jml')->like('created_at', '' . $postData['tahun'] . '-' . '', 'after')->first();
                $data['results'] = $result;
                $data['status'] = ["code" => 200, "description" => "OK"];
            } elseif ($postData['type'] == 'user') {
                $result = $this->user->select('COUNT(*) as jml')->like('created_at', '' . $postData['tahun'] . '-' . '', 'after')->first();
                $data['results'] = $result;
                $data['status'] = ["code" => 200, "description" => "OK"];
            }
        }

        return $this->respond($data);
    }
}
