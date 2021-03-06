<?php

namespace pool;
use \silk\orm\ActiveRecord;

class Game extends ActiveRecord {
	var $table = "games";

	function __construct()
    {
        parent::__construct();
    }

    function setup()
    {
    	$this->create_has_one_association( "hometeam", "pool\Team", "home_id");
    	$this->create_has_one_association( "awayteam", "pool\Team", "away_id");
    	$this->create_has_one_association( "winner", "pool\Team", "winner_id");
    	$this->create_has_one_association( "loser", "pool\Team", "loser_id");
    	$this->create_has_one_association( "status", "pool\Team", "status_id");
//    	$this->has_association("stages", "stage_id");
//      $this->create_belongs_to_association('author', 'CmsUser', 'author_id');
//      $this->create_has_and_belongs_to_many_association('categories', 'BlogCategory', 'blog_post_categories', 'category_id', 'post_id', array('order' => 'name ASC'));
    }
    
    public function get_team( $team_id ) {
    	return \pool\Team::find_by_query( "select * from silk_teams where id=$team_id" );
    }

	public function validate() {
//		if( empty($this->params["name"]) ) $this->add_validation_error("Seasons must have a name.");
//		if( intval($this->params["startYear"] < date("yyyy"))) $this->add_validation_error("Season cannot exist in the past.");
	}
}
?>