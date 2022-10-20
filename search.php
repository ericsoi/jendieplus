<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<input type="search" class="form-control styled" id="term" name="term" placeholder="Make of your vehicle" required>
<script type="text/javascript">
  $(function() {
     $( "#term" ).autocomplete({
       source: 'dashboard/build/pages/processor/vehicle_search.php',
     });
  });
</script>