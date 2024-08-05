<?php

namespace App\ServicesImpl;

use App\Services\FollowupService;
use App\Repositories\FollowupRepository;

class FollowupServiceImpl implements FollowupService
{
    protected $followupRepository;

    public function __construct(FollowupRepository $followupRepository)
    {
        $this->followupRepository = $followupRepository;
    }

    public function getAllFollowups()
    {
        return $this->followupRepository->getAll();
    }

    public function getLatestFollowup()
    {
        return $this->followupRepository->getLatest();
    }

    public function getLatestFollowupByDate()
    {
        return $this->followupRepository->getLatestByDate();
    }

    public function storeFollowup(array $data)
    {
        return $this->followupRepository->store($data);
    }

    public function getFollowupById(int $id)
    {
        return $this->followupRepository->getById($id);
    }

    public function updateFollowup(array $data, int $id)
    {
        return $this->followupRepository->update($data, $id);
    }

    public function deleteFollowup(int $id)
    {
        $this->followupRepository->delete($id);
    }

    public function sendNotificationAuthor()
    {
        return $this->followupRepository->sendNotificationAuthor();
    }
}