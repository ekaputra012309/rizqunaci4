<?php

namespace App\Controllers\Api;

use App\Models\Agent;
use CodeIgniter\RESTful\ResourceController;

class AgentController extends ResourceController
{
    protected $modelName = 'App\Models\Agent';
    protected $format = 'json';

    // Get all agents
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // Get single agent
    public function show($id = null)
    {
        $agent = $this->model->find($id);
        if ($agent === null) {
            return $this->failNotFound('Agent not found');
        }
        return $this->respond($agent);
    }

    // Create a new agent
    public function create()
    {
        $model = new Agent();
        $dataToInsert = $this->request->getVar(['nama_agent', 'alamat', 'contact_person', 'telepon']);
        $model->insert($dataToInsert);

        // Fetch the created data
        $createdData = $model->where($dataToInsert)->first();

        return $this->respondCreated([
            'status' => 201,
            'error' => null,
            'data' => $createdData, // Include the created data in the response
            'messages' => ['success' => 'Data agent berhasil ditambahkan.']
        ]);
    }

    // Update an existing agent
    public function update($id = null)
    {
        $model = new Agent();
        $model->update($id, $this->request->getVar(['nama_agent', 'alamat', 'contact_person', 'telepon']));

        return $this->respond([
            'status'   => 200,
            'error'    => null,
            'data'     => $model->find($id), // Fetch and include the updated data
            'messages' => ['success' => 'Data agent berhasil diubah.']
        ]);
    }

    // Delete an agent
    public function delete($id = null)
    {
        $model = new Agent();
        $data = $model->where('id_agent', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data agent berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
