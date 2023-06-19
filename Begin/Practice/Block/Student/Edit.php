<?php

namespace Begin\Practice\Block\Student;

use Magento\Framework\View\Element\Template;
use Begin\Practice\Model\StudentFactory;

class Edit extends Template
{
    public function __construct(
        Template\Context         $context,
        protected StudentFactory $studentFactory,
        array                    $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getStudent()
    {
        $id = $this->getRequest()->getParam('id');

        $student = $this->studentFactory->create()->load($id);

        return $student;
    }

    public function getActionForm($id)
    {
        return $this->getUrl('student/student/save/id/' . $id, ['_secure' => true]);
    }
}
