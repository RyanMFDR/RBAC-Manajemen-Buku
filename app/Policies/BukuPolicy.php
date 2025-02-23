<?php

namespace App\Policies;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BukuPolicy
{
    use HandlesAuthorization;

    /**
     * Admin memiliki semua akses.
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * Viewer dan Editor bisa melihat buku.
     */
    public function viewAny(User $user)
    {
        return in_array($user->role, ['viewer', 'editor']);
    }

    public function view(User $user, Buku $buku)
    {
        return in_array($user->role, ['viewer', 'editor']);
    }

    /**
     * Hanya Admin dan Editor yang bisa menambah buku.
     */
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * Hanya Admin dan Editor yang bisa mengedit buku.
     */
    public function update(User $user, Buku $buku)
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * Hanya Admin yang bisa menghapus buku.
     */
    public function delete(User $user, Buku $buku)
    {
        return $user->role === 'admin';
    }
}
