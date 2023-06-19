<?php

namespace Begin\Practice\Model\ResourceModel\Student;

use Begin\Practice\Model\ResourceModel\Student as ResourceModel;
use Begin\Practice\Model\Student as Model;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'students_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
