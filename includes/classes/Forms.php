<?php



class Forms {

  public function input_field($name, $value="", $id="", $class="", $placeholder="") {
    return '<input id="'.$id.'"class="'.$class.'"type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" spellcheck="false" required="true">';
  }

  public function email_field($name, $value="", $id="", $class="", $placeholder="") {
    return '<input id="'.$id.'"class="'.$class.'"type="email" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" spellcheck="false" required="true">';
  } 

  public function password_field($name, $value="", $id="", $class="", $placeholder="") {
    return '<input id="'.$id.'"class="'.$class.'"type="password" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" spellcheck="false" required="true">';
  } 

  public function textarea_field($name, $value="",$id="",$class="", $placeholder="") {
    return '<textarea id="'.$id.'"class="'.$class.'"name="'.$name.'" rows="8" cols="80" placeholder="'.$placeholder.'" spellcheck="false">'.$value.'</textarea>';
  } 

  public function integer_field($name, $value="",$id="",$class="", $placeholder="") {
    return '<input id="'.$id.'"class="'.$class.'"type="number" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" min="1">';
  } 

  public function color_field($name, $value="",$id="",$class="") {
    return '<input id="'.$id.'"class="'.$class.'"type="color" name="'.$name.'" value="'.$value.'">';
  } 

  public function select_field($name, $values=[],$selected="", $id="",$class="") {
      echo '<select class="$class", id="$id", name="$name">';
      echo '<option value="'.$selected.'" selected disabled hidden>'.$selected.'</option>';
      foreach($values as $value):
        echo '<option value="'.$value.'">'.$value.'</option>';
      endforeach;
      echo "</select>";
     } 

    

  public function submit_field($name, $value="Submit",$id="",$class="") {
    return '<input id="'.$id.'"class="'.$class.'"type="submit" name="'.$name.'" value="'.$value.'">';
  } 



} 







 ?>
