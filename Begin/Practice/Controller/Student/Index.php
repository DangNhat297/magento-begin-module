<?php

namespace Begin\Practice\Controller\Student;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    public function __construct(
        protected PageFactory $pageFactory
    )
    {
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $result = $this->pageFactory->create();
        $result->getConfig()
            ->getTitle()
            ->set(__('Student List'));

        return $result;
    }
}
