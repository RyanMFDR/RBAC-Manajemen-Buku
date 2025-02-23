<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        return Buku::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Buku::class);
        return Buku::create($request->all());
    }

    public function update(Request $request, Buku $buku)
    {
        $this->authorize('update', $buku);
        $buku->update($request->all());
        return $buku;
    }

    public function destroy(Buku $buku)
    {
        $this->authorize('delete', $buku);
        $buku->delete();
        return response()->json(['message' => 'Buku dihapus']);
    }
}
