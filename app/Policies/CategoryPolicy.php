<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;


class CategoryPolicy
{
    /**
     * السماح بعرض كل الفئات
     */
public function viewAny(User $user)
{
    return in_array($user->role, ['admin', 'author']);
}
    
    /**
     * السماح بعرض فئة معينة
     */
    public function view(User $user, Category $category)
    {
        return $user->role === 'admin';
    }

    /**
     * السماح بإنشاء فئة
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * السماح بتحديث فئة
     */
    public function update(User $user, Category $category)
    {
        return $user->role === 'admin';
    }

    /**
     * السماح بحذف فئة
     */
    public function delete(User $user, Category $category)
    {
        return $user->role === 'admin';
    }
}
