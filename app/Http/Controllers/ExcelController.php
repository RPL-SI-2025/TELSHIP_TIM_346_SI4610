<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    /**
     * Export data mitra ke Excel
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportMitraToExcel()
    {
        // Ambil data mitra dari database
        $mitras = DB::table('mitra')->get();
        
        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Mitra');

        // Set header column sesuai dengan kolom database
        $headers = [
            'No', 
            'ID Perusahaan', 
            'Nama Perusahaan', 
            'Deskripsi Perusahaan', 
            'Alamat', 
            'Email',
            'Telepon',
            'Website',
            'Tanggal Dibuat'
        ];
        
        // Style untuk header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'EC1D24'], // Menggunakan warna merah sesuai dengan tombol
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        // Atur lebar kolom
        $sheet->getColumnDimension('A')->setWidth(5);   // No
        $sheet->getColumnDimension('B')->setWidth(15);  // ID Perusahaan
        $sheet->getColumnDimension('C')->setWidth(30);  // Nama Perusahaan
        $sheet->getColumnDimension('D')->setWidth(40);  // Deskripsi Perusahaan
        $sheet->getColumnDimension('E')->setWidth(35);  // Alamat
        $sheet->getColumnDimension('F')->setWidth(25);  // Email
        $sheet->getColumnDimension('G')->setWidth(15);  // Telepon
        $sheet->getColumnDimension('H')->setWidth(25);  // Website
        $sheet->getColumnDimension('I')->setWidth(18);  // Tanggal Dibuat

        // Tambahkan header
        for ($i = 0; $i < count($headers); $i++) {
            $column = chr(65 + $i); // A, B, C, ...
            $sheet->setCellValue($column . '1', $headers[$i]);
        }
        
        // Atur style untuk header
        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);
        
        // Tambahkan data
        $row = 2;
        $no = 1;
        
        foreach ($mitras as $mitra) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $mitra->id_perusahaan);
            $sheet->setCellValue('C' . $row, $mitra->nama_perusahaan);
            
            // Untuk deskripsi perusahaan, kita atur agar bisa wrap text
            $sheet->setCellValue('D' . $row, $mitra->deskripsi_perusahaan);
            $sheet->getStyle('D' . $row)->getAlignment()->setWrapText(true);
            
            $sheet->setCellValue('E' . $row, $mitra->alamat);
            $sheet->setCellValue('F' . $row, $mitra->email);
            $sheet->setCellValue('G' . $row, $mitra->telepon);
            $sheet->setCellValue('H' . $row, $mitra->link_website);
            
            // Format tanggal
            $created_at = $mitra->created_at ? date('d-m-Y', strtotime($mitra->created_at)) : '-';
            $sheet->setCellValue('I' . $row, $created_at);
            
            // Tambahkan style untuk baris data
            $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            
            // Set tinggi baris berdasarkan konten
            $sheet->getRowDimension($row)->setRowHeight(-1);
            
            $row++;
        }
        
        // Buat file Excel
        $fileName = 'Data_Mitra_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        
        // Save file ke storage sementara
        $tempPath = storage_path('app/public/temp/' . $fileName);
        
        // Pastikan direktori ada
        if (!file_exists(storage_path('app/public/temp'))) {
            mkdir(storage_path('app/public/temp'), 0777, true);
        }
        
        $writer->save($tempPath);
        
        // Download file
        return response()->download($tempPath)->deleteFileAfterSend(true);
    }

   public function importMitraFromExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file_excel');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $errors = [];
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index == 1) continue; // skip header

            $data = [
                'nama_perusahaan'      => $row['C'],
                'deskripsi_perusahaan' => $row['D'],
                'alamat'               => $row['E'],
                'email'                => $row['F'],
                'telepon'              => $row['G'],
                'link_website'         => $row['H'],
            ];

            $validator = Validator::make($data, [
                'nama_perusahaan'      => 'required|string|max:255',
                'email'                => 'required|email|max:255',
                'telepon'              => 'required|string|max:20',
                'alamat'               => 'required|string|max:255',
                'deskripsi_perusahaan' => 'nullable|string',
                'link_website'         => 'nullable|url',
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'row' => $index,
                    'errors' => $validator->errors()->all(),
                    'data' => $data,
                ];
                continue;
            }

            try {
                DB::table('mitra')->insert(array_merge($data, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
                $imported++;
            } catch (\Exception $e) {
                $errors[] = [
                    'row' => $index,
                    'errors' => ['Database error: ' . $e->getMessage()],
                    'data' => $data,
                ];
            }
        }

        // Selalu kembalikan respons JSON dengan kode HTTP yang sesuai
        if (count($errors) > 0) {
            return response()->json([
                'status' => 'partial_success',
                'imported' => $imported,
                'errors' => $errors,
            ], 422);
        }

        return response()->json([
            'status' => 'success',
            'imported' => $imported,
            'message' => 'Data mitra berhasil diimport.',
        ], 200);
    }
}