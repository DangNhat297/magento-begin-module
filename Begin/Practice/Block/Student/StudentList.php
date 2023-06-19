<?php

namespace Begin\Practice\Block\Student;

use Begin\Practice\Helper\Data;
use Magento\Framework\View\Element\Template;
use Begin\Practice\Model\Student;
use Begin\Practice\Model\ResourceModel\Student\CollectionFactory;

class StudentList extends Template
{
    public function __construct(
        Template\Context            $context,
        protected Student           $student,
        public Data                 $helper,
        protected CollectionFactory $collectionFactory,
        array                       $data = [],
    )
    {
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getStudentCollection()) {
            $pager = $this->getLayout()
                ->createBlock('Magento\Theme\Block\Html\Pager', 'custom.history.pager')
                ->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)
                ->setCollection($this->getStudentCollection());

            $this->setChild('pager', $pager);
            $this->getStudentCollection()->load();
        }

        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getStudentCollection()
    {
        $page = $this->getRequest()->getParam('p') ?? 1;
        $per_page = $this->getRequest()->getParam('limit') ?? 5;

        $collection = $this->collectionFactory->create();

        $sortField = $this->getRequest()->getParam('sort');
        $sortOrder = $this->getRequest()->getParam('order');

        $collection->setOrder('id', 'DESC');

        if ($sortField && $sortOrder) {
            $collection->addOrder($sortField, $sortOrder);
        }
        $entityIdFilter = $this->getRequest()->getParam('student_id');
        if ($entityIdFilter) {
            $collection->addFieldToFilter('id', ['eq' => $entityIdFilter]);
        }
        $nameFilter = $this->getRequest()->getParam('name');
        if ($nameFilter) {
            $collection->addFieldToFilter('name', ['like' => '%' . $nameFilter . '%']);
        }
        $genderFilter = $this->getRequest()->getParam('gender');
        if ($genderFilter) {
            $genderFilter = $genderFilter == 'male' ? 1 : ($genderFilter == 'female' ? 0 : '');
            $collection->addFieldToFilter('gender', ['eq' => $genderFilter]);
        }
        $ageFromFilter = $this->getRequest()->getParam('age_from');
        $ageToFilter = $this->getRequest()->getParam('age_to');
        if ($ageFromFilter && $ageToFilter) {
            $currentDate = new \DateTime();
            $currentDate->sub(new \DateInterval('P' . $ageFromFilter . 'Y'));
            $startDate = $currentDate->format('Y-m-d');
            $currentDate = new \DateTime();
            $currentDate->sub(new \DateInterval('P' . $ageToFilter . 'Y'));
            $endDate = $currentDate->format('Y-m-d');
            $collection->addFieldToFilter('dob', ['from' => $endDate, 'to' => $startDate]);
        }

//        $collection = $this->student->getCollection();
        $collection->setPageSize($per_page);
        $collection->setCurPage($page);

        return $collection;
    }

    public function getDeleteAction()
    {
        return $this->getUrl('student/student/delete', ['_secure' => true]);
    }

    public function getEditAction($id)
    {
        return $this->getUrl('student/student/edit/id/' . $id);
    }
}
