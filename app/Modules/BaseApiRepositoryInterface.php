<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules;


interface BaseApiRepositoryInterface
{
    public function index();
    public function create($form_data);
    public function show($resource_id);
    public function update($resource_id, $form_data);
    public function delete($resource_id);
}