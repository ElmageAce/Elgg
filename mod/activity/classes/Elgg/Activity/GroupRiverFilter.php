<?php

namespace Elgg\Activity;

use Elgg\Database\QueryBuilder;

/**
 * Helper class to generate correct query parameters for selecting group activity
 */
class GroupRiverFilter {
	
	/**
	 * @var \ElggGroup
	 */
	protected $group;
	
	/**
	 * Create a new filter
	 *
	 * @param \ElggGroup $group the group to select activity from
	 */
	public function __construct(\ElggGroup $group) {
		$this->group = $group;
	}
	
	/**
	 * Called during query execution
	 *
	 * @param QueryBuilder $qb         a river query builder
	 * @param string       $main_alias main river alias
	 *
	 * @return \Doctrine\DBAL\Query\Expression\CompositeExpression|string
	 */
	public function __invoke(QueryBuilder $qb, $main_alias) {
		$wheres = [];
		$wheres[] = $qb->compare("{$main_alias}.object_guid", '=', $this->group->guid, ELGG_VALUE_GUID);
		$wheres[] = $qb->compare("{$main_alias}.target_guid", '=', $this->group->guid, ELGG_VALUE_GUID);
		
		$object = $qb->joinEntitiesTable($main_alias, 'object_guid');
		$wheres[] = $qb->compare("{$object}.container_guid", '=', $this->group->guid, ELGG_VALUE_GUID);
		
		$target = $qb->joinEntitiesTable($main_alias, 'target_guid', 'left');
		$wheres[] = $qb->compare("{$target}.container_guid", '=', $this->group->guid, ELGG_VALUE_GUID);
		
		return $qb->merge($wheres, 'OR');
	}
}
