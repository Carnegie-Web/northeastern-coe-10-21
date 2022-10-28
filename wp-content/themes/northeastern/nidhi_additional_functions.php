// Writing a script for read only fields (for gravity forms)

add_filter( 'gform_pre_render', 'add_readonly_script' );

function add_readonly_script( $form ) {

    ?>

<script type="text/javascript">

   jQuery(document).ready(function(){

/* apply only to a input with a class of gf_readonly */

   jQuery(".gf_readonly input").attr("readonly","readonly");

});

</script>

     <?php
          return $form;
}
add_filter("gform_field_value_rand_number", "populate_rand_number");

function populate_rand_number(){ return uniqid(); }
