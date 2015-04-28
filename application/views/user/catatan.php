<div class="row">
	<form method="post" action="<?php echo base_url()?>catatan/search" style="margin-top:10px">
		<div class="col-md-6">
			<div class="col-md-8">
				<div class='col-md-8'>
		    		<input type="text" name="search" id="search_box" class='form-control search_box' placeholder="catatan/no voucher"/>
		    	</div>
		    	<div class="col-md-4">
		   			<input type="submit" value="Search" class="form-control search_button" /><br />
				</div>
			</div>
			<a class="col-md-4 btn btn-default back" href='<?php echo base_url()?>catatan' style="display:none">Back</a>

		</div>
	</form>
	<div style="clear:both"></div>
	<div class="col-md-6">
		<div id="result">
		<table class="table table-catatan">
			<thead>
				<tr>
					<th>No Jurnal</th><th>Catatan</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($catatan as $c) {?>
				<tr><td><?php echo $c->no_jurnal?></td><td><?php echo $c->catatan?></td></tr>	
			<?php
				}//foreach 
			?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<script>
$(function() {
 
    $(".search_button").click(function() {
        // getting the value that user typed
        var searchString    = $("#search_box").val();
        // forming the queryString
        var data            = 'search='+ searchString;
       	console.log(data);
        // if searchString is not empty
        if(searchString) {
            // ajax call
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>catatan/search",
                data: data,
                beforeSend: function(html) { // this happens before actual call
                    $("#result").html(''); 
                    $("#searchresults").show();
                    $(".word").html(searchString);
                    $(".back").show();
               },
               success: function(html){ // this happens after we get results
                    $("#result").show();
                    $("#result").append(html);
              }
            });    
        }
        return false;
    });
});
</script>