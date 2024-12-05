<?php

declare(strict_types=1);

namespace App\Services;

 use App\Models\User;
 use App\Services\Contracts\CrmIntegrationInterface;
 use App\Services\Contracts\CrudInterface;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Support\Facades\Hash;

 final class UserService implements CrudInterface
 {
     public function __construct(public CrmIntegrationInterface $crmIntegration)
     {
     }

     public function create(array $data): Model
     {
         $user = new User();
         $user->name = $data['name'];
         $user->email = $data['email'];
         $user->password = Hash::make($data['password']);

         $user->save();

         // send to CRM
         $this->crmIntegration->sendData($user);

         return $user;
     }

     public function update(Model $model, array $data): Model
     {
         $model->name = $data['name'];
         $model->email = $data['email'];

         $model->save();

         // send to CRM
         $this->crmIntegration->sendData($model);

         return $model;
     }

     public function delete(Model $model): bool
     {
         try {
             // send to CRM
             $this->crmIntegration->sendData($model);
             return (bool) $model->delete();
         } catch(\Throwable $exception) {
             return false;
         }
     }
 }

