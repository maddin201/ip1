<?php
$q=$_GET["q"];
include("includes/conn.php");
if($q == "Lenses")
{
?>
<select name="ptype2" id="ptype2">
<option value="">Select</option>
  <option value="Acuvue">Acuvue</option>
  <option value="Fresh Look">Fresh Look</option>
  <option value="Air Optix">Air Optix</option>
  <option value="Dailies">Dailies</option>
  <option value="Proclear">Proclear</option>
  </select>
<?php
}
else if($q == "Glases")
{
	?>
<select name="ptype2" id="ptype2">
<option value="">Select</option>
  <option value="Rimless Frame">Rimless Frame</option>
  <option value="Plastic Frame">Plastic Frame</option>
  <option value="Metal Frame">Metal Frame</option>
</select>
<?php
}
?>