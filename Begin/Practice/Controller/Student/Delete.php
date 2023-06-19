<?php

namespace Begin\Practice\Controller\Student;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Begin\Practice\Model\StudentFactory;
class Delete implements HttpGetActionInterface
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

        $id = $this->request->getParam('id');

        $student = $this->studentFactory->create();

        $student->load($id)->delete();

        $this->messageManager->addSuccess(__('Delete Student Success'));

        return $resultRedirect->setPath('*/*/index');
    }
}
