<?php
class add_form_filter_widget extends WP_Widget
{
	public function __construct()
	{
	    parent::__construct('form_filter', 'Form Filter', array('description' => 'Un formulaire de filtre .'));
	}

	public function widget($args, $instance)
	{
	    echo $args['before_widget'];
	    echo $args['before_title'];
	    echo apply_filters('widget_title', $instance['title']);
	    echo $args['after_title'];

		$html="";
		$html .="<form method='post' class='switcher' name='add_form_filter'>";
		$html.='<label for="c52e22404e0df08b420af080ce558d6a">Prix min: </label> <input type="text" id="c52e22404e0df08b420af080ce558d6a" name="add_form_filter[prix][]" value="" />'
			    . '<label for="c52e22404e0df08b420af080ce558d6a">Prix max: </label> <input type="text" id="c52e22404e0df08b420af080ce558d6a" name="add_form_filter[prix][]" value="" />'
			    . '<label for="6c7927b138d292985b7e1dae123da288">ville: </label> <input type="text" id="6c7927b138d292985b7e1dae123da288" name="add_form_filter[ville][]" value="" />';
		$html.='<label for="f04fb51d518fd323411b4593193d9031">Surface min</label> <input type="text" id="f04fb51d518fd323411b4593193d9031" name="add_form_filter[surface][]" class="datepicker" value="" />
		    <label for="df51cccbacbaf45d76e1a785f145fd03">Surface max</label> <input type="text" id="df51cccbacbaf45d76e1a785f145fd03" name="add_form_filter[surface][]" class="datepicker" value="" />';
		$html.='<input type="submit" value="Filtrer" />';
		$html.="</form>";
	    
	    echo $html;
	    
	    echo $args['after_widget'];
	}
  
	public function form($instance)
	{
	    $title = isset($instance['title']) ? $instance['title'] : '';
	    ?>
	    <p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo  $title; ?>" />
	    </p>
	    <?php
	}
	
	
	
}
