<?php
namespace App\Interfaces;

interface PersonInterface
{
    public function get_stage($data);
    public function check_for_email($data);
    public function update_person_details($data);
    public function person_details_stage1($data);
    public function person_details_stage2($data);
}
