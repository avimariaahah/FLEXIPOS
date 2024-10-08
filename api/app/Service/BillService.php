<?php

namespace App\Service;

use App\Http\Resources\BillResource;
use App\Interface\Repository\BillRepositoryInterface;
use App\Interface\Service\BillServiceInterface;

class BillService implements BillServiceInterface
{
    private $billRepository;

    public function __construct(BillRepositoryInterface $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    public function findBills()
    {
        $bills = $this->billRepository->findMany();

        return BillResource::collection($bills);
    }

    public function findBillById(int $id)
    {
        $bill = $this->billRepository->findOneById($id);

        return new BillResource($bill);
    }

    public function createBills(object $payload)
    {
        $bill = $this->billRepository->create($payload);

        return new BillResource($bill);
    }

    public function updateBills(object $payload, int $id)
    {
        $bill = $this->billRepository->update($payload, $id);

        return new BillResource($bill);
    }

    public function removeBills(int $id)
    {
        return $this->billRepository->delete($id);
    }
}
