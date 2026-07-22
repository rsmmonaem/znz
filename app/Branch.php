<?php
namespace App;
use Eloquent;

class Branch extends Eloquent
{

    protected $fillable = [
        'id',
        'name',
        'description',
    ];
    protected $primaryKey = 'id';
    protected $table = 'branchs';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('branch_permission', function (\Illuminate\Database\Eloquent\Builder $builder) {
            try {
                if (class_exists('\Auth') && \Auth::check()) {
                    $userId = \Auth::user()->id;
                    
                    // Directly check DB to avoid Entrust/Eloquent recursion
                    $isAdmin = \DB::table('role_user')
                        ->join('roles', 'roles.id', '=', 'role_user.role_id')
                        ->where('role_user.user_id', $userId)
                        ->where('roles.name', 'admin')
                        ->exists();

                    if (!$isAdmin) {
                        $branchIds = \DB::table('user_branches')
                            ->where('user_id', $userId)
                            ->pluck('branch_id');
                            
                        // Use array cast just in case pluck returns collection
                        $branchIds = is_object($branchIds) ? $branchIds->toArray() : (array) $branchIds;
                            
                        $builder->whereIn('branchs.id', $branchIds);
                    }
                }
            } catch (\Throwable $e) {
                // Ignore any DB exceptions during early bootstrapping
            }
        });
    }

    public function newEloquentBuilder($query)
    {
        if (is_null($query->wheres)) {
            $query->wheres = [];
        }
        return new \Illuminate\Database\Eloquent\Builder($query);
    }

}
