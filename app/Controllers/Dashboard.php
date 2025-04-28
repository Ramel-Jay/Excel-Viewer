<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\Files\File;

class Dashboard extends BaseController
{
    

    public function index()
    {
        if (!session()->has('loggedInUser')) {
            return redirect()->to('auth/login');
        }

        // Fetch full user info by ID from session
        $userModel = new UserModel();
        $userId    = session()->get('loggedInUser');
        $userInfo  = $userModel->find($userId);

        return view('dashboard', ['userInfo' => $userInfo]);
    }

    public function excelUpload()
    {
        try {
            $file = $this->request->getFile('excel_file');

            if (!$file) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No file uploaded.']);
            }

            if (!$file->isValid()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Uploaded file is not valid.']);
            }

            if ($file->hasMoved()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'File has already been moved.']);
            }

            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/', $newName);

            $filePath = ROOTPATH . 'public/uploads/' . $newName;

            if (!file_exists($filePath)) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'File move failed.']);
            }

            
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = [];

            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $cells = [];
                foreach ($cellIterator as $cell) {
                    $cells[] = $cell->getValue();
                }
                $rows[] = $cells;
            }

            return $this->response->setJSON(['status' => 'success', 'data' => $rows]);

        } catch (\Throwable $e) {
           
            log_message('error', 'Excel Upload Error: ' . $e->getMessage());

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred. Check logs.',
                'error'   => $e->getMessage() 
            ])->setStatusCode(500);
        }
    }



    public function signOut()
    {
        session()->remove('loggedInUser'); 
        session()->setFlashData('success', 'Successfully signed out.');
        return redirect()->to('auth/login'); 
    }
}
