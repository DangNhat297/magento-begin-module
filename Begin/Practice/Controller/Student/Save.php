<?php

namespace Begin\Practice\Controller\Student;

use Begin\Practice\Model\StudentFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

class Save implements HttpPostActionInterface
{
    public function __construct(
        protected RedirectFactory $redirectFactory,
        protected RequestInterface $request,
        protected StudentFactory $studentFactory,
        protected \Magento\Framework\Message\ManagerInterface $messageManager,
    )
    {}
    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $resultRedirect = $this->redirectFactory->create();

        $data = $this->request->getParams();

        $student = $this->studentFactory->create();

        $student->setData($data);

        $student->save();

        if (isset($data['id'])) {
            $this->messageManager->addSuccess(__('Update Student Success'));
        } else {
            $this->messageManager->addSuccess(__('Create Student Success'));
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
