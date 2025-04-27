<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|unique:companies,company_id',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Simpan file
        $logoPath = $request->file('company_logo')->store('logos', 'public');

        // Simpan ke database (jika sudah ada model)
        Perusahaan::create([
            'company_id' => $validated['company_id'],
            'company_name' => $validated['company_name'],
            'company_logo' => $logoPath,
            'company_description' => $validated['company_description'],
        ]);

        Company::create($validated);

        return redirect()->route('company.create')->with('success', 'ID Perusahaan berhasil ditambahkan!');
    }
}
