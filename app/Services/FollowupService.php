<?php

namespace App\Services;

interface FollowupService
{
    public function getAllFollowups();

    public function getLatestFollowup();

    public function getLatestFollowupByDate();

    public function storeFollowup(array $data);

    public function getFollowupById(int $id);

    public function updateFollowup(array $data, int $id);

    public function deleteFollowup(int $id);

    public function sendNotificationAuthor();
}