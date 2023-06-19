<?php

namespace Begin\Practice\Block\Student;

use Magento\Framework\View\Element\Template;

class Create extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->pageConfig
            ->getTitle()
            ->set(__('Create Student'));

        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');

        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle(__("Create Student"));
        }

        return $this;
    }

    public function getActionForm()
    {
        return $this->getUrl('student/student/save', ['_secure' => true]);
    }
}
