<?php


namespace Modules\Exchanger1C\Entities;


use Bigperson\Exchange1C\Interfaces\GroupInterface;
use Illuminate\Database\Eloquent\Model;

class Group extends Model implements GroupInterface
{
    protected $table = 'altrp_exchanger1c_groups';

    /**
     * Создаём группу по модели группы CommerceML
     * проверяем все дерево родителей группы, если родителя нет в базе - создаём
     *
     * @param \Zenwalker\CommerceML\Model\Group $group
     * @return Group|array|null
     */
    public static function createByML(\Zenwalker\CommerceML\Model\Group $group)
    {
        /**
         * @var \Zenwalker\CommerceML\Model\Group $parent
         */
        if (!$model = Group::where('accounting_id', $group->id)->first()) {
            $model = new self;
            $model->accounting_id = $group->id;
        }
        $model->name = $group->name;
        if ($parent = $group->getParent()) {
            $parentModel = self::createByML($parent);
            $model->parent_id = $parentModel->id;
            unset($parentModel);
        } else {
            $model->parent_id = null;
        }
        $model->save();
        return $model;
    }

    /**
     * @param \Zenwalker\CommerceML\Model\Group[] $groups
     */
    public static function createTree1c($groups)
    {
        foreach ($groups as $group) {
            self::createByML($group);
            if ($children = $group->getChildren()) {
                self::createTree1c($children);
            }
        }
    }

    public function offers()
    {
        return Offer::with('products')->where('product.group_id', $this->id)->get();
    }

    /**
     * @return string
     */
    public static function getIdFieldName1c()
    {
        return 'accounting_id';
    }

    /**
     * @return int|string
     */
    public function getPrimaryKey()
    {
        return 'id';
    }
}
