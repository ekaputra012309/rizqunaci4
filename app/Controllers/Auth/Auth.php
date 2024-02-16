<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $loginResponse;

    public function login()
    {
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if (is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $pwd_verify = password_verify($password, $user['password']);

        if (!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "user" => [ // Include user data in the payload
                "id" => $user['id'],
                "username" => $user['username'],
                "email" => $user['email'],
            ],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Succesful',
            'token' => $token,
            'user' => $user,
        ];
        $this->loginResponse = $response;
        return $this->respond($response, 200);
    }

    public function register()
    {
        $rules = [
            'username' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => ['label' => 'confirm password', 'rules' => 'matches[password]']
        ];


        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'username' => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);

            return $this->respond(['message' => 'Registered Successfully'], 200);
        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);
        }
    }

    public function user()
    {
        $users = new UserModel;
        return $this->respond(['users' => $users->findAll()], 200);
    }

    public function getUserByEmail()
    {
        $responseJson = $this->loginResponse;
        $responseData = json_decode($responseJson, true);
        $token = $responseData['token'];
        echo $token;
        // $userModel = new UserModel();
        // $user = $userModel->where('email', $email)->first();

        // if ($user === null) {
        //     return $this->respond(['error' => 'User not found.'], 404);
        // }

        // return $this->respond($user);
    }

    public function logout()
    {
        return $this->respond(['message' => 'Logout successful'], 200);
    }
}
